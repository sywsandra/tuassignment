@extends('layouts.app')

@section('title', '| Edit User')

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

    <h1><i class='fa fa-user-plus'></i> Edit :"{{$user->name}}"</h1>
    <hr>

    {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with user data --}}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Give Role</b></h5>

    <div class='form-group'>
        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
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

    {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection