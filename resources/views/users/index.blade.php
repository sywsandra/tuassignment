
@extends('layouts.app')

@section('subtitle') 
<i class="fa fa-users"></i> User Administration

@endsection

@section('header')
 
  <ul class="nav nav-tabs navbar-nav navbar-right">
 
  <li class="active"><a href="{{route('users.index')}}"><i class="fa fa-users"></i> Users</a></li>
  <li> <a href="{{ route('users.create') }}">Add User</a></li>
  <li> <a href="{{ route('roles.index') }}">Roles</a></li>
	<li><a href="{{ route('permissions.index') }}" >Permissions</a></li>
 
</ul>

@endsection

@section('content')

<div>
 
<div class="table-responsive">
<table class="table table-bordered table-striped">

<thead>
<tr>
<th>Name</th>
<th>Email</th>
<th>Date/Time Added</th>
<th>User Roles</th>
<th>Operations</th>
</tr>
</thead>

<tbody>
@foreach ($users as $user)
    <tr>
    
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
    <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
    <td>
    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
    
    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
    
    </td>
    </tr>
    @endforeach
    </tbody>
    
    </table>
    </div>
    
    <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>
    
    </div>
    
    @endsection