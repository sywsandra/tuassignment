<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    protected $table = 'showtimes';
    protected $fillable = [
        'movie_id', 'hall_id', 'show_time','hall_name'
    ];
    
    
    public function movie()
    {
        return $this->belongsTo('App\Movie', 'movie_id','id');
    }
    public function tickets()
    {
        return $this->hasMany('App\Ticket', 'showtime_id', 'id');
    }
}

