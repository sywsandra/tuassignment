@extends('layouts.app')

@section('title', '| Edit Role')

@section('subtitle') 
Role Administration

@endsection

@section('header')
 
  <ul class="nav nav-tabs navbar-nav navbar-right">
  <li> <a href="{{ route('roles.create') }}">Add Role</a></li>
  <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i> Users</a></li>
   <li class="active"> <a href="{{ route('roles.index') }}">Roles</a></li>
	<li><a href="{{ route('permissions.index') }}" >Permissions</a></li>
 
</ul>
@endsection
@section('content')

<div>
    <h1><i class='fa fa-key'></i> Edit Role: "{{$role->name}}"</h1>
    <hr>

    {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Role Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Assign Permissions</b></h5>
    @foreach ($permissions as $permission)

        {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
        {{Form::label($permission->name, ucfirst($permission->name)) }}<br>

    @endforeach
    <br>
    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}    
</div>

@endsection