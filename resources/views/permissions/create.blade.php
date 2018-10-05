@extends('layouts.app')

@section('title', '| Create Permission')

@section('subtitle') 
User Administration

@endsection

@section('header')
 
  <ul class="nav nav-tabs navbar-nav navbar-right">
  	<li class="active"><a href="{{ route('permissions.create') }}">Add Permission</a></li>
  <li > <a href="{{ route('permissions.index') }}" >Permissions</a> </li>
   <li> <a href="{{ route('roles.index') }}">Roles</a></li>  
  <li ><a href="{{route('users.index')}}"> Users</a></li>  

 
</ul>
@endsection
@section('content')

<div >

    <h1><i class='fa fa-key'></i> Add Permission</h1>
     <hr>
    <br>

    {{ Form::open(array('url' => 'permissions')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div><br>
    @if(!$roles->isEmpty()) 
        <h4>Assign Permission to Roles</h4>

        @foreach ($roles as $role) 
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    @endif
    <br>
    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection