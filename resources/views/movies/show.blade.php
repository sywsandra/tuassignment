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
 <div>
            
    <div class="jumbotron text-center">
        <h2>{{ $movie->name }}</h2>
        <p>
          
            <strong>Now Showing:</strong> {{ $movie->nowshowing }}
                   <strong>Category:</strong> {{ $movie->category }}
        </p>
    </div>
    @if ($movie -> poster !== null)
    <img src="{{URL::to('/uploads/'. $movie -> poster)}}">
     @endif       
     <br />
   
      <a class="btn btn-small btn-info pull-right" href="{{ URL::to('movies/'.$movie->id.'/edit') }}">Edit</a>
        {!! Form::open(['method' => 'DELETE', 
        'onsubmit' => "if (!confirm('Confirmed to delete?')) return false;",
        'route' => ['movies.destroy', $movie->id] ]) !!}
    {!! Form::submit('Delete', ['class' => 'btn btn-danger pull-right']) !!}
    {!! Form::close() !!}
    </div>
</div>
@endsection