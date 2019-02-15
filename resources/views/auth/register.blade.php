
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Register</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">


    <!--Nifty Stylesheet [ REQUIRED ]-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/nifty.min.css') }}">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/demo/nifty-demo-icons.min.css') }}">

    <!--=================================================-->



    <!--Pace - Page Load Progress Par [OPTIONAL]-->
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/pace/pace.min.css') }}">
	<script src="{{  asset('plugins/pace/pace.min.js') }}" type="text/javascript"></script> 


        
    <!--Demo [ DEMONSTRATION ]-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/demo/nifty-demo.min.css') }}">
     
        
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
    <div id="container" class="cls-container">
        
		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay"></div>
		
		
		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
		    <div class="cls-content-sm panel">
		        <div class="panel-body">
		            <div class="mar-ver pad-btm">
		                <h1 class="h3">Account Register</h1>
		                <p>Sign In to your account</p>
		            </div>
					 <form class="form-horizontal" method="POST" action="{{  secure_url(route('register', [] , false))  }}">  
						{{ csrf_field() }}
						
						<div class="form-group">
							<input id="name" type="text" class="form-control" placeholder="name" name="name" value="{{ old('name') }}" required autofocus>
							@if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
		                </div>
						 
						
		                <div class="form-group">
							
							<input id="email" type="email" class="form-control" placeholder="email" name="email" value="{{ old('email') }}" required autofocus>

							@if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
						
		                </div>
		                <div class="form-group">
							<input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
		                </div>
						
						<div class="form-group">
							<input id="password" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
		                </div>
						  
		                <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
		            </form>
		        </div>
		
		        <div class="pad-all">
		           Already Have account? then  <a href="{{ secure_url(route('login',[], false)) }}" class="btn-link mar-rgt">  Log In </a>  
		        </div>
		    </div>
		</div>
		<!--===================================================-->
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->

    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    <script src="{{  asset('js/jquery.min.js') }}" type="text/javascript"></script> 

    <!--BootstrapJS [ RECOMMENDED ]-->
	<script src="{{  asset('js/bootstrap.min.js') }}" type="text/javascript"></script> 

    <!--NiftyJS [ RECOMMENDED ]-->
	<script src="{{  asset('js/nifty.min.js') }}" type="text/javascript"></script> 
    <!--=================================================-->
    <!--Background Image [ DEMONSTRATION ]-->
	<script src="{{  asset('js/demo/bg-images.js') }}" type="text/javascript"></script> 
	
	<script src = "{{ asset('js/idlerefresh.js') }}"> </script>
</body>
</html>
