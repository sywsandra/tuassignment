{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

<!-- jQuery library -->
<link rel="stylesheet"
	href="{{ asset('css/jquery.dataTables.min.css') }}" />
<script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>



<!-- Latest compiled JavaScript -->
<script
	src="{{ asset('js/bootstrap.min.js') }}"></script>

<script
	src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600"
	rel="stylesheet" type="text/css">

<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script>
$(document).ready(function(){$.noConflict();  $('.dataTable').DataTable(); });
</script>

<title>Online Movie Ticket</title>

<!-- Fonts -->

<link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" />
<link href="{{ asset('css/bootstrap-social.css') }}" rel="stylesheet" />


<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!-- Scripts -->

        <script>
  
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        
         
    </script>
<script src="https://use.fontawesome.com/9712be8772.js"></script>

</head>
<body>

 <div id="app">
 	<div class="col-sm-12">
		<div id="loginModal" class="modal fade" >
		<div class="modal-dialog modal-md">
		  <div  class="modal-content">
                   	@yield('auth.login')
                    </div>
                    </div>
                    </div>
                    <div id="registerModal" class="modal fade" >
                    <div class="modal-dialog modal-md">
		  <div  class="modal-content">
                   	@yield('auth.register')
                    </div>
                    </div>
                    </div></div>
	
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                       Home&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </a>
                   
                </div>
	
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                     <a class="navbar-brand" href="#">
                       @yield('subtitle')
                    </a>
                  
                   
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                    
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}" data-toggle="modal" data-target="#loginModal">Login</a></li>
                            <li><a href="{{ route('register') }}" data-toggle="modal" data-target="#registerModal">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        @role('Admin') {{-- Laravel-permission blade helper --}}
                                        <a href="#"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;Admin</a>
                                        @endrole
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="glyphicon glyphicon-log-out"></i>&nbsp;&nbsp;
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
              
                @yield('header')
              
                </div>
            </div>
        </nav>

	<div class="row">
	<div class="col-md-2">
	
		<!-- The sidebar -->
		<nav class="navbar navbar-default sidebar" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse"
						data-target="#bs-sidebar-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span> <span
							class="icon-bar"></span> <span class="icon-bar"></span> <span
							class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse"
					id="bs-sidebar-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active"><a href="{{ url('/home') }}">Dashboard<span style="font-size: 16px;"
								class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
					
							 	<li><a href="{{  url('/nowshowingmovies') }}">Now Showing<span style="font-size: 16px;"
								class="pull-right hidden-xs showopacity glyphicon glyphicon-film"></span></a></li>
						
						<li><a href="{{url('/reservation/index')}}">Bookings<span style="font-size: 16px;"
								class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>
						<li><a href="{{route('movies.index')}}">Movies<span style="font-size: 16px;"
								class="pull-right hidden-xs showopacity fa fa-file-movie-o"></span></a></li>
						<li><a href="{{route('halls.index')}}">Cinema Halls<span style="font-size: 16px;"
								class="pull-right hidden-xs showopacity glyphicon glyphicon-tower"></span></a></li>
						<li><a href="{{route('users.index')}}">Users<span style="font-size: 16px;"
								class="pull-right hidden-xs showopacity fa fa-users"></span></a></li>
						<li><a href="{{route('roles.index')}}">Roles<span style="font-size: 16px;"
								class="pull-right hidden-xs showopacity fa fa-key"></span></a></li>
								
						<li><a href="{{route('permissions.index')}}">Permissions<span style="font-size: 16px;"
								class="pull-right hidden-xs showopacity fa fa-key"></span></a></li>
				 @if (!Auth::guest())
						<li>
						   <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout<span style="font-size: 16px;"
								class="pull-right hidden-xs showopacity glyphicon glyphicon-log-out"></span>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                        <span style="font-size: 16px;"
								class="pull-right hidden-xs showopacity glyphicon glyphicon-"></span>
						</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>
	</div>
	
	<div class="col-md-10">
		@if(Session::has('flash_message'))
		<div class="col-md-12">
			<div class="alert alert-success">
				<em> {!! session('flash_message') !!}</em>
			</div>
		</div>
		@endif
		<div class="col-md-12">@include ('errors.list') {{-- Including error
			file --}}</div>
		<div class="col-md-12">
		@yield('content')
		</div>
	</div>
	</div>
	
	</div>
	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>