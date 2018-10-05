@extends('layouts.app')

@section('content')
<div class="container">


    <div class="justify-content-center col-md-11 panel panel-default">
    
    <div class="panel-body">
  		<div class="row">
             
            <div class="col-md-4">
                <div class="card" style="width: 100%">
            <div class="row">
            <div class="col-md-5">
            <center><span style="font-size: 50px; color: #ccc;padding-top:20px" class="fa fa-file-movie-o"></span></center>
            </div>
            <div class="col-md-5">
                <span><h1>{{ $now_showing->unique('movie_name')->count() }}</h1> movie(s) showing today</span>
            </div>
            </div>            
            </div>
            </div>
            
             <div class="col-md-4">
                <div class="card" style="width: 100%">
            <div class="row">
             <div class="col-md-5">
            <center><span style="font-size: 50px; color: #ccc;padding-top:20px" class="glyphicon glyphicon-list"></span></center>
            </div>
        
            <div class="col-md-5">
               <span><h1>{{ $latest_bookings->count()}}</h1> booking(s) made today</span>
            </div>
            </div>            
            </div>
            </div>
            
             <div class="col-md-4">
                <div class="card" style="width: 100%">
            <div class="row">
            <div class="col-md-5">
             <center><span style="font-size: 50px; color: #ccc;padding-top:20px" class="glyphicon glyphicon-film"></span></center>
            </div>
           
            <div class="col-md-5">
                <span><h1>{{ $now_showing->unique('hall_name')->count()}}</h1> halls</span>
            </div>
            </div>            
            </div>
            </div>
               
        </div>
        
      	<br /><br />
        
          <div class="row">
       
       
       <div class="col-md-4">
        <div class="card" style="width: 100%;min-height:300px;">
  
  <ul class="list-group list-group-flush">
  <li class="list-group-item header">Next movies</li>
  @foreach ($next_movies as $showtime)
      <li class="list-group-item">
      	<span style="color: #8942bd">{{$showtime->movie_name}}</span><br />
      	<span style="color: #ccc"><small>{{date('l j F Y h:i A', strtotime($showtime->show_time))}}</small></span><br />
      	<span>{{$showtime->hall_name}}</span>
      </li>
  @endforeach
   
  </ul>
</div>
</div>

 <div class="col-md-4">
        <div class="card" style="width: 100%;min-height:300px;">
  
  <ul class="list-group list-group-flush">
  <li class="list-group-item header">Latest bookings</li>
  @foreach ($latest_bookings as $booking)
      <li class="list-group-item">
      	<span style="color: #8942bd">{{$booking->booking_name}}</span><br />
      	<span style="color: #ccc"><small>{{date('l j F Y h:i A', strtotime($booking->showtime->show_time))}}</small></span><br />
      	<span>{{$booking->tickets()->count()}} tickets</span>
      </li>
  @endforeach
   
  </ul>
</div>
</div>


  <div class="col-md-4">
 <div class="card" style="width:100;min-height:300px">
  
  <ul class="list-group list-group-flush">
   <li class="list-group-item header">Now showing</li>
  @foreach ($now_showing as $showtime)
      <li class="list-group-item">
     	<span>{{$showtime->hall_name}}</span><br />
      	<span style="color: #8942bd">{{$showtime->movie_name}}</span><br />
      		<span style="color: #ccc"><small>{{date('l j F Y h:i A', strtotime($showtime->show_time))}}</small></span><br />
      
      	<span style="color: #ccc"><small>{{$showtime->tickets()->count()}} tickets sold.</small></span><br />
      	
      </li>
  @endforeach
  </ul>
</div></div>
       </div>
    
    </div>
    
       

</div>
  
        
</div>
   <div class="footer">
    <table width="100%">
    <tr style="vertical-align: bottom">
    
    <td>Last login : @if (!Auth::guest()) {{Auth::user()->last_logged_in_at}} @endif </td>
    <td align="right">
     <ul>
        <li><h1>{{ date('h:i A') }} <span style="color:#ccc">|</span></h1>
        </li>
        <li><strong><span style="color:#ccc">{{ date('l') }}</span></strong><br />{{ date('j F Y') }}
        </li>
        </ul>
    
    </td>
    </tr>
    </table>
       
        </div>
@endsection
