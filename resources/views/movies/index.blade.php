@extends('layouts.app') @section('title', '| Movies')

@section('subtitle')
<i class="fa fa-file-movie-o"></i>
&nbsp;Movies @endsection @section('header')

<ul class="nav nav-tabs navbar-nav navbar-right">

	<li @if ($selected== 'all') class="active" @endif><a
		href="{{ route('movies.index') }}">All Movies</a></li>
	<li @if ($selected== 'nowshowing') class="active" @endif><a
		href="{{ url('/nowshowingmovies') }}">Now Showing</a></li>
	<li @if ($selected== 'latest') class="active" @endif><a
		href="{{ url('latestmovies') }}">Latest</a></li>
	<li @if ($selected== 'coming') class="active" @endif><a
		href="{{ url('comingmovies') }}">Coming</a></li>
	<li><a href="{{ route('movies.create') }}">Add Movie</a></li>

</ul>
@endsection
 @section('content')


<div>


	<!-- will be used to show any messages -->
	@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif
	
	<div class="table-responsive">
		<table class="table table-striped table-bordered dataTable">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Now Showing</th>
					<th>Category</th>
					<th></th>
					
				</tr>
			</thead>
			<tbody>
				@foreach($movies as $value)
				<tr>
					<td>{{ $value->id }}</td>
					<td>{{ $value->name}}</td>
					<td>
					<center>
						@if ($value->nowshowing == '1')
							
						<span class="glyphicon glyphicon-ok" style="font-size:large;color:#abc;"></span>
							
							@else
							<span class="glyphicon glyphicon-remove" style="font-size:large;color:#cba;"></span>
							
							@endif
							</center>
					</td>
					<td>{{ $value->category }}</td>
				

					<td>
						
						<a class="btn btn-small btn-success"
						href="{{ URL::to('movies/'.$value->id.'/show') }}">Show</a>
									<a class="btn btn-small btn-info"
						href="{{ URL::to('movies/'.$value->id.'/edit') }}">Edit</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
