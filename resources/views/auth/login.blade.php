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

<script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>



<!-- Latest compiled JavaScript -->
<script
	src="{{ asset('js/bootstrap.min.js') }}"></script>


<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600"
	rel="stylesheet" type="text/css">

<title>Online Movie Ticket</title>

<!-- Fonts -->

<link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" />
<link href="{{ asset('css/bootstrap-social.css') }}" rel="stylesheet" />


<!-- Styles -->

<!-- Scripts -->

        <script>
  
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        
         
    </script>
<script src="https://use.fontawesome.com/9712be8772.js"></script>
<style>
.col-form-label, .form
{
	
font-family:tahoma;

font-size: 10pt;
	
}
</style>
</head>
<body>
 <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle
                                "></span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    
                    <div class="modal-body">
                    
                    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="panel panel-default form">
                <div class="panel-heading"><h4>Sign in</h4></div>
			
			
                <div class="panel-body">
                
                                 <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                   @csrf
                    <div class="form-group">
                            <label for="email" class="col-sm-12 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                  <br />
                            </div>
                        </div>
                      

                        <div class="form-group">
                            <label for="password" class="col-md-12 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                    <br />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>    <br />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                 <br />
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="col-md-12 offset-md-4">
                                <br />
                             <span style="color:#000;font-size:14pt;">Don't have an account? <a href="{{ route('register') }}"  data-toggle="modal" data-target="#registerModal" data-dismiss="modal">Sign up!</a> 
                             </span> | 
                                 <span style="color:#000;font-size:14pt;"><a href="{{ url('/') }}" >Home</a> 
                             </span> 
                                <br />     <br />                          
                            </div>
                        </div>
                      	   <div class="form-group">
                             <div class="col-md-12 offset-md-4">
                        <a class="btn btn-block btn-social btn-facebook" href="{{url('/redirect')}}" >
                                <span class="fa fa-facebook"></span> Sign in with Facebook
                              </a>
 				 </div></div>
 			        
   <br />
                       
                    </form>
                </div>
            </div>
        </div>
                    
                    </div>
    </div>
</div>
</html>
</body>