{{-- resources/views/welcome.blade.php --}}
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
<link href="{{ asset('css/public.css') }}" rel="stylesheet">
<link href="{{ asset('css/bookseat.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

<!-- jQuery library -->
<link rel="stylesheet"
	href="{{ asset('css/jquery.dataTables.min.css') }}" />
<script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>



<!-- Latest compiled JavaScript -->
<script
	src="{{ asset('js/bootstrap.min.js') }}"></script>
<title>Online Movie Tickets</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600"
	rel="stylesheet" type="text/css">
<link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" />
<link href="{{ asset('css/bootstrap-social.css') }}" rel="stylesheet" />

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
		<div class="header">

			<div class="banner">
				<div class="container">
					<div class="followus pull-right">
						<span>Follow Us: </span> <a class="btn btn-facebook"> <span
							class="fa fa-facebook"></span>
						</a> <a class="btn btn-google"> <span class="fa fa-google"></span>
						</a> <a class="btn btn-twitter"> <span class="fa fa-twitter"></span>
						</a> <a class="btn btn-yahoo"> <span class="fa fa-yahoo"></span>
						</a>
					</div>
					
					<div class="brand pull-left">
					
						<h2>BUY MOVIE TICKETS</h2>
						<span>A HUGE COLLECTION OF TICKETS ONLINE</span>
						

					</div>

				</div>
			</div>



			<div class="container">

				<div class="navbar navbar-inverse navbar-static-top"
					role="navigation">

					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse"
							data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span> <span
								class="icon-bar"></span> <span class="icon-bar"></span> <span
								class="icon-bar"></span>
							<!-- 
          <a class="navbar-brand" rel="home" href="/" title="My homepage">
<img style="background:transparent"
						src="{{URL::to('/img/buyticket.png')}}"
						> 
</a> -->
						</button>

					</div>
					
					<div class="collapse navbar-collapse navbar-ex1-collapse">

						<ul class="nav navbar-nav">
							<li><a href="{{ url('/') }}">Movies</a></li>
							<li><a href="{{ url('/') }}">Events</a></li>
							<li><a href="{{ url('/') }}">Plays</a></li>
							<li><a href="{{ url('/') }}">Sports</a></li>
							<li><a href="{{ url('/') }}">Bookmarks</a></li>
							<li><a href="{{ url('/') }}">International</a></li>
						</ul>

						<div class="col-sm-3 col-md-3 pull-right">
							<form class="navbar-form" role="search" action="{{ route('movies.search') }}" method="post">
							 <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search"
										name="search_term" id="search_term">
									<div class="input-group-btn">
										<button class="btn btn-default" type="submit">
											<i class="glyphicon glyphicon-search"></i>
										</button>
									</div>
								</div>
							</form>
						</div>

					</div>
				</div>

			</div>
		</div>
	
		<div class="col-sm-5">
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
	
		
		<header id="masthead" class="site-header">
	<div class="top-header top-header-bg">
		<div class="container">
		
			<div class="row">
				<div class="top-left">
					<ul>
						<li><a href="#"> <i class="fa fa-phone"></i> +62274 889767
						</a></li>
						<li><a href="mailto:hello@myticket.com"> <i
								class="fa fa-envelope-o"></i> hello@myticket.com
						</a></li>
					</ul>
				</div>
					
				<div class="top-right">
				
					<ul>
					  @if (Auth::guest())
						<li><a href="{{ route('login') }}" data-toggle="modal" data-target="#loginModal">Sign In</a></li>
						<li><a href="{{ route('register') }}" data-toggle="modal" data-target="#registerModal">Sign Up</a></li>
					@else
					   <li>
                                <a href="#">
                                    {{ Auth::user()->name }}
                                </a>

                          </li>
                           @if (Auth::user()->isAdmin())
                           		 <li>
                                <a href="{{ route('admin.dashboard') }}">
                                   Admin Panel
                                </a>
                           		</li>
                           @endif
                          <li>
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
					@endif
					</ul>
				</div>
			</div>
		</div>
	</div>

</header>
	
		@yield('content')
	

		<!-- here -->
		
  </div>
</div>
	</div>
	<div class="footer">
		<div class="container">
			<div class="pull-left">
				<h1>ONLINE TICKETS</h1>
				<span>© 2015 All Rights Reserved | Privacy Policy</span>
			</div>

			<div class="pull-right">
				<h2>Questions? Call Us Toll Free: (012) 123-456-7890</h2>
				<ul>
					<li>Home |</li>
					<li>Terms & Condition |</li>
					<li>Privacy Policy |</li>
					<li>Contacts</li>
				</ul>
			</div>
		</div>
	</div>
	
</body>
</html>