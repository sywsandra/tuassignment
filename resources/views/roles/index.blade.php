@extends('layouts.app')

@section('title', '| Roles')

@section('subtitle') 
Role Administration

@endsection

@section('header')
 
  <ul class="nav nav-tabs navbar-nav navbar-right">
  <li  class="active"> <a href="{{ route('roles.index') }}">Roles</a></li>	
  <li> <a href="{{ route('roles.create') }}">Add Role</a></li>
  <li><a href="{{route('users.index')}}">Users</a></li>
   
	<li><a href="{{ route('permissions.index') }}" >Permissions</a></li>
 
</ul>

@endsection
@section('content')

<div>
   
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Operation</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                <tr>

                    <td>{{ $role->name }}</td>

                    <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>
                    <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ URL::to('roles/create') }}" class="btn btn-success">Add Role</a>

</div>

@endsection
