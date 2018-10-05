@extends('layouts.app') @section('title', '| Movies')

@section('subtitle')
<i class="fa fa-file-movie-o"></i>
&nbsp;Movies @endsection @section('header')

<ul class="nav nav-tabs navbar-nav navbar-right">

	<li><a
		href="{{ route('movies.index') }}">Movies</a></li>
	<li ><a
		href="{{ url('/nowshowingmovies') }}">Now Showing</a></li>
	<li ><a
		href="{{ url('latestmovies') }}">Latest</a></li>
	<li><a
		href="{{ url('comingmovies') }}">Coming</a></li>
	<li class="active"><a href="{{ route('movies.create') }}">Add Movie</a></li>

</ul>
@endsection


 @section('content')
 <div>
<h1>Add Movie</h1>
<hr>
<!-- if there are creation errors, they will show here -->

{{Form::open(['action'=>'MovieController@store','method' => 'post',
    'enctype' => 'multipart/form-data'])}}
    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
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
        {{ Form::label('nowshowing', 'Now Showing') }}
         {{ Form::checkbox('nowshowing',1, array('class' => 'form-control')) }}
    
    </div>

   <div class="form-group">
   @foreach($categories as $key => $value)
    <label class="checkbox-inline">
            {{Form::checkbox('category[]',$value->name)}}{{$value->name}}
         </label>
        @endforeach
   
 
</div>

 <div class="form-group">
        Poster:
    <br />
    <input type="file" name="poster" id="poster" />
    
    </div>

    {{ Form::submit('Create New Movie!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
@endsection