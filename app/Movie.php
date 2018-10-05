<?php 

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Showtime;
class Movie extends Model
{
   
    /*
    protected $table = 'movie';
    protected $primaryKey = 'ID';
    */
    protected $table = 'movie';
    protected $fillable = [
    'name', 'nowshowing', 'coming','category'
    ];
  
    public function showtimes()
    {
        return $this->hasMany('App\Showtime', 'movie_id', 'id');
    }
   
    
}