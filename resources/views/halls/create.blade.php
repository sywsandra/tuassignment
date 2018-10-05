@extends('layouts.app')

@section('title', '| Create New Cinema Hall')

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
 
    <div>
        <div >

        <h1>Create New Cinema Hall</h1>
        <hr>

    {{-- Using the Laravel HTML Form Collective to create our form --}}
        {{ Form::open(array('route' => 'halls.store')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::label('active', 'Active') }}  <br>
            <input type="checkbox" name="active" id="active" data-on="Active" data-off="Not Active" checked data-toggle="toggle" data-onstyle="info" data-offstyle="warning">
     
            <br>
            <br />
  </div>
            {{ Form::submit('Create Hall', array('class' => 'btn btn-primary')) }}
             <a href="{{ route('halls.index') }}" class="btn btn-default">Back</a>
            {{ Form::close() }}
      
        </div>
    </div>

@endsection