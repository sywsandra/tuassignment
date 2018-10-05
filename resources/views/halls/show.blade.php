@extends('layouts.app')

@section('title', '| View Post')

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

    <h1>{{ $hall->name }}</h1>
    <hr>
    <p class="lead">{{ $hall->name }} </p>
    
    @if ($hall->active==='1')
							
							<input type="checkbox" name="active"
								data-on="Active" data-off="Not Active" checked
								data-toggle="toggle" data-onstyle="info" data-offstyle="warning" />
							
							@else
							<input type="checkbox" name="active" data-on="Active"
								data-off="Not Active" data-toggle="toggle"
								data-onstyle="info" data-offstyle="warning" /> 
							
							@endif
							
    <hr>
    {!! Form::open(['method' => 'DELETE',
    'onsubmit' => 'if (!confirm("Are you sure to delete this?") ? return false;',
     'route' => ['halls.destroy', $hall->id] ]) !!}
    <a href="{{ route('halls.index') }}" class="btn btn-primary">Back</a>
    @can('Edit')
    <a href="{{ route('halls.edit', $hall->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}

</div>

@endsection