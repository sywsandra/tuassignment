<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Ticket extends Model
{
    protected $table = "tickets";
    public function reservation()
    {
        
        return $this->belongsTo('App\Reservation','reservation_id','id');
    }
}