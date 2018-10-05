<?php
namespace App\Http\Controllers;

use App\Movie;
use App\Hall;
use App\Category;
use App\Http\Controllers\Controller;
use Validator;
use Input;
use Session;
use Redirect;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Showtime;
use App\Reservation;
class MovieController extends Controller
{    
    public function __construct() {
        $this->middleware(['auth', 'isAdmin'])->except('index', 'show','search','browse','welcome','buyticket');
    }
    
   
    public function dashboard()
    {
        $today = \Carbon\Carbon::today();
        $date = \Carbon\Carbon::today()->addDays(1);
        
        $latest_bookings = Reservation::where('created_at','>=', $today)
        ->where('created_at', '<=', $date)->get();
        
        $next_movies = Showtime::where('show_time', '>', $date)->get();
        $now_showing = Showtime::where('show_time', '>=', $today)
        ->where('show_time', '<=', $date)->get();
        
       
        return view('home',
            ['next_movies' => $next_movies,
                'now_showing' => $now_showing,
                'latest_bookings' => $latest_bookings
            ] );
    }
    public function browse()
    {
        $moviesList = Movie::all();
        return view('movies.list', ['movies' => $moviesList] );
    }
    public function welcome()
    {
        $today = \Carbon\Carbon::today();
        $tomorrow =  \Carbon\Carbon::today()->addDays(1);
        $date = \Carbon\Carbon::today()->addDays(7);
        
        $showtimes = Showtime::where('show_time', '>=', $today)
        ->where('show_time', '<=', $date)->get()->pluck('id');
        
        $movies = Movie::orderBy('updated_at', 'desc')->get();
        
        $thriller = Movie::orderBy('updated_at', 'desc')
        ->where('category','like','%thriller%')->take(3)->get();
        
        $romance = Movie::orderBy('updated_at', 'desc')
        ->where('category','like','%romance%')->take(3)->get();
        
        
        $action = Movie::orderBy('updated_at', 'desc')
        ->where('category','like','%action%')->take(3)->get();
        
        $fantasy = Movie::orderBy('updated_at', 'desc')
        ->where('category','like','%fantasy%')->take(3)->get();
        
        $next_movies = Showtime::where('show_time', '>', $tomorrow)->take(3)->get();
        
        $now_showing = Showtime::where('show_time', '>=', $today)
        ->where('show_time', '<=', $tomorrow)->get();
        
        $topmovies = array();
        foreach($movies as $movie)
        {
            foreach($movie->showtimes as $showtime)
            {
                if (in_array($showtime->id, $showtimes->toArray()))
                {
                    array_push($topmovies, $movie);
                    break;
                }
            }   
        }
        
        return view('welcome', ['topmovies' => $topmovies,
            'thriller' => $thriller,
            'romance' => $romance,
            'action' => $action,
            'fantasy' => $fantasy,
            'next_movies' => $next_movies,
            'now_showing' => $now_showing,
            
        ] );
    }
    public function search(Request $request)
    {
        $search = $request["search_term"];
          
        $movies = Movie::where('name','like','%'.$search.'%')           
            ->orWhere('category','like','%'.$search.'%')->get();
            /*
        $today = \Carbon\Carbon::today();
        $date = \Carbon\Carbon::today()->addDays(7);
        $showtimes = Showtime::where('show_time', '>=', $today)
        ->where('show_time', '<=', $date)->get();
        $moviesList = $movies->filter(function($collection) use($showtimes){
                return in_array($showtimes, $collection->showtimes->toArray());             
        });
        */
        return view('search', ['movies' => $movies, 'search_term' => $search] );
    }
    public function index()
    {
        $movies = Movie::orderBy('updated_at', 'desc')->get();       
       
        return view('movies.index', ['movies' => $movies, 'selected' => 'all'] );
    }
    public function nowshowing()
    {
        $movies = Movie::where('nowshowing','1')->get();
        
        return view('movies.index', ['movies' => $movies, 'selected' => 'nowshowing'] );
    }
    public function latest()
    {
        $date = \Carbon\Carbon::today()->subDays(7);
        $movies = Movie::where('created_at', '>=', $date)->get();
        
        return view('movies.index', ['movies' => $movies, 'selected' => 'latest'] );
    }
    public function coming()
    {
        $movies = Movie::where('coming','1')->get();
        
        return view('movies.index', ['movies' => $movies, 'selected' => 'coming'] );
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::all('name', 'id');
        return view('movies.create',['categories' => $categories]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
   
    public function store(Request $request)
    {
        $rules = array(
            'name'       => 'required',           
          
        );
        $validator = Validator::make(Input::all(), $rules);
        
        // process the login
        if ($validator->fails()) {
            return Redirect::to('movieadd')
            ->withErrors($validator);
            
        } else {
            // store
            $movie = new Movie;
            $movie->name       = Input::get('name');
            $movie->nowshowing     =  (Input::get('nowshowing') == 'on') ? 1 : 0;;
            
            $movie->desc    = $request["desc"];
            $movie->cast    = $request["cast"];
            $movie->running_time    = $request["running_time"];
            
            if (Input::get('category')!==null)         
            $movie->category = implode(",", Input::get('category'));
            $movie->active = 1;
            
            if ($request->has(['poster'])) {
                
                $file = $request->poster;
                
                //Display File Name
                echo 'File Name: '.$file->getClientOriginalName();
                echo '<br>';
                
                //Display File Extension
                echo 'File Extension: '.$file->getClientOriginalExtension();
                echo '<br>';
                
                //Display File Real Path
                echo 'File Real Path: '.$file->getRealPath();
                echo '<br>';
                
                //Display File Size
                echo 'File Size: '.$file->getSize();
                echo '<br>';
                
                //Display File Mime Type
                echo 'File Mime Type: '.$file->getMimeType();
                
                $movie -> poster = $file->getClientOriginalName();
                //Move Uploaded File
                $destinationPath = 'uploads';
                $file->move($destinationPath,$file->getClientOriginalName());
            }
            
            
            $movie->save();
            
            // redirect
            Session::flash('message', 'Successfully created movie!');
            return redirect()->route('movies.index');
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $movie = Movie::find($id);
        
     
        // show the view and pass the nerd to it
        return view('movies.show')
        ->with('movie', $movie);
        
    }
    public function buyticket($id)
    {
        $movie = Movie::find($id);
        $today = \Carbon\Carbon::today();
        $date = \Carbon\Carbon::today()->addDays(7);
        $showtimes = Showtime::where('movie_id', $id)
             ->where('show_time', '>=', $today)
             ->where('show_time', '<=', $date)->get();
      
        $halls = Hall::all();
        
        
        return view('movies.buyticket')
        ->with('movie', $movie)
        ->with('showtimes', $showtimes)
        ->with('halls', $halls);
        
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    
    public function storeshowtime(Request $request)
    {
        if (empty($request["showtime"]))
        {
            echo "Showtime necessary";
            exit;
        }
                
      
        $dt = \DateTime::createFromFormat('m/d/Y h:i a', $request["showtime"]);
     
        
        $showtime = new Showtime;
        $hall = Hall::findorFail($request["hall_id"]);
        $movie = Movie::findOrFail($request["movie_id"]);
        
        $showtime -> movie_id     = $request["movie_id"];
        $showtime -> hall_id   = $request["hall_id"];
        $showtime -> show_time      = $dt;
        $showtime -> hall_name = $hall -> name;
        $showtime -> movie_name = $movie -> name;
        $showtime -> save();
        return redirect()->route('movies.edit', ['id' => $request['movie_id']]);
        
    }
    public function deleteshowtime(Request $request)
    {
        // delete
        
        $showtime = Showtime::findOrFail($request['showtime_id']);
        $showtime->delete();
        
        // redirect
        
        return redirect()->route('movies.edit', ['id' => $request['movie_id']]);
    }
    
    public function edit($id)
    {
        $categories = Category::all('name', 'id');
        $halls = Hall::all('name', 'id');
        $showtimes = Showtime::where('movie_id',$id)->get();
        $movie = Movie::find($id);
        
        // show the view and pass the nerd to it
        return view('movies.edit')
        ->with('movie', $movie)
        ->with('halls', $halls)
        ->with('showtimes', $showtimes)
        ->with('categories', $categories);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    
  
    public function update(Request $request,$id)
    {        
       
        $rules = array(
            'name'       => 'required',
            
        );
        $validator = Validator::make(Input::all(), $rules);
        
        // process the login
        if ($validator->fails()) {
            return Redirect::to('movieedit/'. $id)
            ->withErrors($validator)        
            ->withInput(Input::except('password'));;
            
        } else {
            // store
            
            $movie = Movie::findorFail($id);          
          
            $movie->name       = Input::get('name');
            $movie->nowshowing     =  Input::get('nowshowing')!=null ? 1 : 0;
            
            $movie->desc    =$request["desc"];
            $movie->cast    = $request["cast"];
            $movie->running_time    = $request["running_time"];
            
            if ($request['category']!=null)
                $movie->category = implode(",",Input::get('category'));
            else 
                $movie ->category = null;
            
                if ($request->has(['poster'])) {
                    
                    $file = $request->poster;
                    
                    //Display File Name
                    echo 'File Name: '.$file->getClientOriginalName();
                    echo '<br>';
                    
                    //Display File Extension
                    echo 'File Extension: '.$file->getClientOriginalExtension();
                    echo '<br>';
                    
                    //Display File Real Path
                    echo 'File Real Path: '.$file->getRealPath();
                    echo '<br>';
                    
                    //Display File Size
                    echo 'File Size: '.$file->getSize();
                    echo '<br>';
                    
                    //Display File Mime Type
                    echo 'File Mime Type: '.$file->getMimeType();
                    
                    $movie -> poster = $file->getClientOriginalName();
                    //Move Uploaded File
                    $destinationPath = 'uploads';
                    $file->move($destinationPath,$file->getClientOriginalName());
                }
            
                
         //   $request->logo->store('logos');
        
           // $img = Image::make(storage_path('app/logos/1.png'))->resize(300, 200);
            
            $movie->active = 1;
          
            $movie->save();
           
          
            // redirect
            
            return redirect()->route('movies.index')
            ->with('flash_message',
                'Movie successfully updated.');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete
        $movie = Movie::findOrFail($id);
        $movie->delete();
        
        // redirect
    
        return redirect()->route('movies.index')
        ->with('flash_message',
            'Movie successfully deleted.');
    }
    
}