@extends('layouts.app') @section('title', '| Movies')

@section('subtitle')

<i class="fa fa-file-movie-o"></i>
&nbsp;Movies @endsection @section('header')

<ul class="nav nav-tabs navbar-nav navbar-right">

	<li><a
		href="{{ route('movies.index') }}">All Movies</a></li>
	<li ><a
		href="{{ url('/nowshowingmovies') }}">Now Showing</a></li>
	<li ><a
		href="{{ url('latestmovies') }}">Latest</a></li>
	<li><a
		href="{{ url('comingmovies') }}">Coming</a></li>
	<li><a href="{{ route('movies.create') }}">Add Movie</a></li>
	<li class="active"> <a href="{{ URL::to('movies/'.$movie->id.'/edit') }}">Edit</a></li>

</ul>
@endsection


 @section('content')
 <link rel="stylesheet"
	href="{{ asset('css/bootstrap-datetimepicker.css') }}" />
	
<script src="{{ asset('js/moment.js') }}"></script>

<script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
<!--  
<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
  
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
        
        
        <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
-->
<h1>Edit {{ $movie->name }}</h1>
<hr>
<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}
    {{ Form::model($movie, array('route' => array('movies.update', $movie->id),
	'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name',null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('nowshowing', 'Now Showing') }}
      
           @if($movie->nowshowing!=null && $movie->nowshowing=='1')
           
           {{Form::checkbox('nowshowing',null, "checked") }}
           
      @else
        {{ Form::checkbox('nowshowing',null, array('class' => 'form-control')) }}
       @endif
       
    
    </div>
	<div class="form-group">
        {{ Form::label('cast', 'Cast') }}
        {{ Form::text('cast', null, array('class' => 'form-control')) }}
    </div>
    
     <div class="form-group">
        {{ Form::label('running_time', 'Running Time') }}
        {{ Form::text('running_time', null, array('class' => 'form-control')) }}
    </div>
     <div class="form-group">
        {{ Form::label('desc', 'Synopsis') }}
        {{ Form::textarea('desc', null, array('class' => 'form-control')) }}
    </div>
   <div class="form-group">
  
   @foreach($categories as $key => $value)
     <label class="checkbox-inline">
    
     @if($movie->category!=null  && str_contains($movie->category, $value->name) )
            {{Form::checkbox('category[]',$value->name, true) }}{{$value->name}}
      @else
      	{{Form::checkbox('category[]',$value->name,false)  }}{{$value->name}}
   
       @endif
         </label>
  
  
        @endforeach
        </div>
        
   <div class="form-group">
        Poster:
    <br />
    <input type="file" name="poster" id="poster" />
    
    </div>
    <div class="row">
     {{ Form::submit('Update Movie!', array('class' => 'btn btn-primary pull-left')) }}
 {{ Form::close() }}
 {!! Form::open(['method' => 'DELETE',
 'onsubmit' => "if (!confirm('Confirmed to delete?')) return false;",
  'route' => ['movies.destroy', $movie->id] ]) !!}
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
{{ Form::close() }}
</div>
<br />
    <div class="row">
    <div class="col-md-5">
      @if ($movie -> poster !== null)	
    <img src="{{URL::to('/uploads/'. $movie -> poster)}}">
     @endif 
     </div>
     <div class="col-md-6">
       <h5><b>Configure Show times</b></h5>

   	<table class="table">
   	<thead>
   	<tr><th>Hall</th><th>Showtime</th><th>Operation</tr>
   	
   	
   	</thead>
   	
   	<tbody>
   	@foreach($showtimes as $showtime)
   	<tr>
   	<td>{{$showtime->hall_name}}
   	</td>
   	<td>{{$showtime->show_time}}
   	</td>
   	<td>
   	   	<form action="{{ route('movies.deleteshowtime') }}" method="post"
   	   	onsubmit= "if (!confirm('Confirmed to delete?')) return false;">
   <input name="showtime_id" type="hidden" value="{{$showtime->id}}" />
   <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
   <input name="movie_id" type="hidden" value="{{$movie->id}}" />
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

   	</td>
   	</tr>
   	@endforeach
   		</tbody>
   	</table>
   	
   	<form action="{{ route('movies.storeshowtime') }}" method="post">

 <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
 <input name="movie_id" type="hidden" value="{{$movie->id}}" />
 	<table class="table">
 	<tbody>
   	<tr>
   	<td>
   	<select  class="form-control" name="hall_id" id="hall_id">
   	@foreach($halls as $hall)
   	<option value="{{$hall->id}}">{{$hall->name}}</option>
  
   	@endforeach
   	</select>
   	</td>
   	<td>
   	   <div class="row">
        <div class='col-md-10'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker'>
                    <input type='text' class="form-control" name="showtime" id="showtime" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
            //$.noConflict();  
                $('#datetimepicker').datetimepicker();
            });
        </script>
    </div>
   	</td>
   	<td>
   	{{ Form::submit('Add Showtime', array('class' => 'btn btn-primary')) }}
   	</td>
   	</tr>
   	  	
   	</tbody>
   	</table>
   	
  </form>
     </div>
     </div>
    <br />
  
</div>
@endsection