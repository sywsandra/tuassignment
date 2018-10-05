<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Reservation extends Model
{
    protected $table = "reservations";
    
    public function showtime()
    {
        return $this->belongsTo('App\Showtime', 'showtime_id', 'id');
    }
    public function tickets()
    {
        return $this->hasMany('App\Ticket', 'reservation_id', 'id');
    }
    public function print_tickets()
    {
    
        $tickets = $this->tickets;
        $normal = 0; $normal_price=0; $priority_price=0;
        $priority = 0;
        foreach($tickets as $ticket)
        {
            if ($ticket->seat_class[0]=='N')
            {
             $normal += 1;   
             $normal_price = $ticket -> ticket_price;
            }
            else if ($ticket->seat_class[0]=='P')
            {
                $priority += 1;
                $priority_price = $ticket -> ticket_price;
            }
        }
        $str = '';
        if ($normal > 0)
        {
            $str .= 'Normal Seat ('.number_format($normal_price,0) .' Ks) x '.$normal.'<br />';       
        
        }
        if ($priority > 0)
        {
            $str .= 'Priority Seat ('.number_format($priority_price,0) .' Ks) x '.$priority;      
        }    
        return $str;
    }
}