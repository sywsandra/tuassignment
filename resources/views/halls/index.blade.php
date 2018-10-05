@extends('layouts.app')
@section('subtitle')
<i class="glyphicon glyphicon-tower"></i>
&nbsp;Cinema Halls @endsection
@section('header')

<ul class="nav nav-tabs navbar-nav navbar-right">

	<li class="active"><a
		href="{{ route('halls.index') }}">All Cinema Halls</a></li>
	
	<li><a href="{{ route('halls.create') }}">Add Cinema Hall</a></li>

</ul>
@endsection
 @section('content')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>
<div class="container">
	<div >
<h1><i class="fa fa-users"></i> Cinema Halls </h1>

<div class="table-responsive">
<table class="table table-bordered table-striped">
			
			
					<thead>
						<tr>
							<th>Name</th>
							<th>Active</th>
							<th>Created</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						 @foreach ($halls as $hall)
						<tr>

							<td>
							<a href="{{ route('halls.show', $hall->id) }}">{{ $hall->name }}</a>
							</td>

							<td>
							<center>
							@if ($hall->active=='1')
							
						<span class="glyphicon glyphicon-ok" style="font-size:large;color:#abc;"></span>
							
							@else
							<span class="glyphicon glyphicon-remove" style="font-size:large;color:#cba;"></span>
							
							@endif
						</center>
							</td>
							<td>{{ $hall->created_at->format('F d, Y h:ia') }}</td>
							<td><a href="{{ URL::to('halls/'.$hall->id.'/edit') }}"
								class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

								{!! Form::open(['method' => 'DELETE',
							  'onsubmit' => "if (!confirm('Confirmed to delete?')) return false;",
								 'route' =>
								['halls.destroy', $hall->id] ]) !!} 
								
								{!! Form::submit('Delete',
								['class' => 'btn btn-danger']) !!}
							</td>

						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			   <a href="{{ route('halls.create') }}" class="btn btn-success">Add Cinema Hall</a>
					
			<div class="text-center">{!! $halls->links() !!}</div>
			<div class="text-center panel-heading">Hall {{ $halls->currentPage() }} of {{ $halls->lastPage() }}</div>
					
		</div>
	</div>
</div>
@endsection
