@extends('layouts.app')

@section('title', '| Permissions')

@section('subtitle') 
 <i class="fa fa-key"></i>Available Permissions

@endsection

@section('header')
 
  <ul class="nav nav-tabs navbar-nav navbar-right">
  	<li class="active"><a href="{{ route('permissions.index') }}" >Permissions</a></li>
  <li > <a href="{{ route('permissions.create') }}">Add Permission</a></li>
   <li> <a href="{{ route('roles.index') }}">Roles</a></li>  
  <li ><a href="{{route('users.index')}}"> Users</a></li>  

 
</ul>
@endsection
@section('content')

<div>
   

    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Permissions</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td> 
                    <td>
                    <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ URL::to('permissions/create') }}" class="btn btn-success">Add Permission</a>

</div>

@endsection