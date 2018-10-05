@extends('layouts.app')

@section('title', '| Edit Permission')

@section('subtitle') 
Permission Administration

@endsection

@section('header')
 
  <ul class="nav nav-tabs navbar-nav navbar-right">
  <li class="active" > <a href="{{ route('permissions.index') }}">Permissions</a></li>
  <li > <a href="{{ route('permissions.create') }}">Add Permission</a></li>
   <li> <a href="{{ route('roles.index') }}">Roles</a></li>  
  <li ><a href="{{route('users.index')}}"> Users</a></li>  

 
</ul>
@endsection
@section('content')

<div>

    <h1><i class='fa fa-key'></i> Edit :"{{$permission->name}}"</h1>
     <hr>
    <br>
    {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with permission data --}}

    <div class="form-group">
        {{ Form::label('name', 'Permission Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <br>
    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection