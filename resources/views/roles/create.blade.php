@extends('layouts.app')

@section('title', '| Add Role')

@section('subtitle') 
Role Administration

@endsection

@section('header')
 
  <ul class="nav nav-tabs navbar-nav navbar-right">
  <li class="active"> <a href="{{ route('roles.create') }}">Add Role</a></li>
   <li> <a href="{{ route('roles.index') }}">Roles</a></li>  
  <li ><a href="{{route('users.index')}}"> Users</a></li>  
	<li><a href="{{ route('permissions.index') }}" >Permissions</a></li>
 
</ul>
@endsection
@section('content')

<div>

    <h1><i class='fa fa-key'></i> Add Role</h1>
    <hr>

    {{ Form::open(array('url' => 'roles')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Assign Permissions</b></h5>

    <div class='form-group'>
        @foreach ($permissions as $permission)
            {{ Form::checkbox('permissions[]',  $permission->id ) }}
            {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>

        @endforeach
    </div>

    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

   
    {{ Form::close() }}    
</div>

@endsection