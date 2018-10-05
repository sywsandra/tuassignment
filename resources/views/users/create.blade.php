@extends('layouts.app')

@section('title', '| Add User')

@section('subtitle') 
<i class="fa fa-users"></i> User Administration

@endsection

@section('header')
 
  <ul class="nav nav-tabs navbar-nav navbar-right">
 
  <li class="active"><a href="{{route('users.index')}}"><i class="fa fa-users"></i> Users</a></li>
   <li> <a href="{{ route('roles.index') }}">Roles</a></li>
	<li><a href="{{ route('permissions.index') }}" >Permissions</a></li>
 
</ul>

@endsection
@section('content')

<div>

    <h1><i class='fa fa-user-plus'></i> Add User</h1>
    <hr>

    {{ Form::open(array('url' => 'users')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', '', array('class' => 'form-control')) }}
    </div>

    <div class='form-group'>
        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    </div>

    <div class="form-group">
        {{ Form::label('password', 'Password') }}<br>
        {{ Form::password('password', array('class' => 'form-control')) }}

    </div>

    <div class="form-group">
        {{ Form::label('password', 'Confirm Password') }}<br>
        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

    </div>

    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection