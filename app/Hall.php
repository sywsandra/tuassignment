<?php 

namespace App;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    
  //  protected $table = 'hall';
    protected $fillable = [
        'name', 'active'
    ];
}