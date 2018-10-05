<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Support\Facades\DB;
use Redirect;
use Session;
use App\Showtime;
use App\Ticket;
use App\Reservation;

class ReservationController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'isAdmin'])->except('bookseat','show','final','create','addReservation');
    }
    
    public function index()
	{
        
	    $reservations = Reservation::orderbydesc('id')->paginate(15);
	    return view('reservations.index',compact('reservations'));
	}
	public function bookseat($showtime_id)
	{
	    $normal_rows = array("A","B", "C","D","E","F","G","H");
	    $priority_rows = array("A","B","C","D","E");
	    
	    $showtime = Showtime::findOrFail($showtime_id);
	    $movie_id = $showtime -> movie_id;
	    $movie = Movie::findOrFail($movie_id);
	    
	    $occupedSeats = DB::table('tickets')->where('showtime_id', $showtime_id)->pluck('place_id');
	    
	    $priority_left =  $occupedSeats->filter(function ($place_id) {
	        return substr($place_id,0,1) == 'P';
	    })->count();
	        
	    $normal_left =  $occupedSeats->filter(function ($place_id) {
	        return substr($place_id,0,1) == 'N';
	    })->count();
	    
	    return view('reservations.bookseat', ['movie_id' => $movie_id,
	        'showtime' => $showtime,
	        'occupedSeats' => $occupedSeats,
	        'movie' => $movie,
	        'priority_left' => 80-$priority_left,
	        'normal_left' => 128-$normal_left,
	        'priority_rows' => $priority_rows,
	        'normal_rows' => $normal_rows
	        
	    ]);
	}
	public function show($reservation_id)
	{	 
	    $reservation = Reservation::findOrFail($reservation_id);
	    $showtime = Showtime::findOrFail($reservation->showtime_id);
	    $tickets = Ticket::where('reservation_id' , $reservation_id)->get();
	   
	    return view('reservations.show', ['reservation' => $reservation,
	        'showtime' => $showtime,
	        'tickets' => $tickets]);
	   /* $returnHTML = view('reservations.show', ['reservation' => $reservation,
	        'showtime' => $showtime,   
	        'tickets' => $tickets])->render();
	    return response()->json(['html'=>$returnHTML]);
	    */
	}
	public function final($reservation_id)
	{
	    $reservation = Reservation::findOrFail($reservation_id);
	    $showtime = Showtime::findOrFail($reservation->showtime_id);
	    $tickets = Ticket::where('reservation_id' , $reservation_id)->get();
	    
	    return view('reservations.final', ['reservation' => $reservation,
	        'showtime' => $showtime,
	        'tickets' => $tickets]);
	  
	}
    public function create(Request $request)
        {
                $seats = $request->input('seat');             
                $movie_id =  $request->input('movie');
                $tickets_no = $request['tickets_no'];
                $showtime_id = $request['showtime_id'];
                $showtime = Showtime::findOrFail($showtime_id);
                $movie = Movie::findOrFail($movie_id);
                if (!empty($seats)) {
                    return view('reservations.form', ['seats' => $seats,
                        'movie_id' => $movie_id,
                        'tickets_no' => $tickets_no, 
                        'total'=> 0,
                        'error'=> null,
                        'message' => '',
                        'showtime' => $showtime,
                        'movie' => $movie,
                    ]);
                    
                } else {
                    return 
                    redirect()->action('ReservationController@bookseat',
                        ['showtime_id' => $showtime_id]);                    
                }
        }

    public function addReservation(Request $request)
        {
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $movie_id = $request->input('movie_id');
            $seats = $request->input('seat');
            $tickets_no = $request->input('tickets_no');
            $showtime_id = $request['showtime_id'];
            $showtime = Showtime::findOrFail($showtime_id);
            $movie = Movie::findOrFail($movie_id);
            
            if($name != null && $phone != null && $email != null && $movie_id != null && !empty($seats)) {
              

                $string = "SELECT count(id) as cid FROM tickets WHERE showtime_id =".$showtime_id.' AND (';
                $first = true;
                foreach($seats as $seat) {
                    if(!$first)
                        $string .= " OR ";
                    $string .= " place_id = '".$seat."'";
                    $first = false;
                }
                $string .= ')';
                $result = DB::select($string);
                if($result[0]->cid > 0) {
                    
                 
                    return view('reservations.form', ['seats' => $seats,
                        'movie_id' => $movie_id,
                        'tickets_no' => $tickets_no,
                        'total'=> 0,       
                        'error' => true,
                        'message'=> "Seats already taken.",
                        'showtime' => $showtime,
                        'movie' => $movie,
                        
                    ])->with('flash_message',
                        'Seats already taken.');
                } else {
                 
                    $reservation = new Reservation;
                    $reservation->name = $name;
                    $reservation->email = $email;
                    $reservation->phone = $phone;
                    $reservation->total_paid = $request["total"];
                    $reservation->booking_name = $name;
                    $reservation->no_of_tickets = $tickets_no;
                    $reservation->showtime_id= $showtime_id;
                    $reservation->status = 'Confirmed';
                    
                    if($reservation->save()) {
                        $reservation_id = $reservation->id;

                        foreach($seats as $seat) {
                            $ticket = new Ticket;
                            $ticket->showtime_id = $showtime_id;
                            $ticket->place_id = $seat;
                            $ticket->reservation_id = $reservation_id;
                            $ticket->seat_class = substr($seat,0,1);
                            $ticket->seat_no = substr($seat,1);
                            $ticket->status = 'paid';
                            if ($seat[0]='P')
                            {
                                $ticket->ticket_price=4000;
                            }
                            else  if ($seat[0]='N')
                            {
                                $ticket->ticket_price=2000;
                            }
                            $ticket->save();
                        }
                        
                        
                       // $reservation = Reservation::findOrFail($reservation_id);
                       // $showtime = Showtime::findOrFail($reservation->showtime_id);
                        $tickets = Ticket::where('reservation_id' , $reservation_id)->get();
                        
                        return view('reservations.final', ['reservation' => $reservation,
                            'showtime' => $showtime,
                            'tickets' => $tickets]);
                      

                    }
                }
            } else {
                return view('reservations.form', [
                    
                    'seats' => $seats,
                    'tickets_no' => $tickets_no, 
                    'movie_id' => $movie_id,
                    'total'=> 0,
                    'error' => true,
                    'message' => "Fill all information",
                    'showtime' => $showtime,
                    'movie' => $movie,
                ])->with('flash_message',
                    'Fill all information.');
            }
        }
}
