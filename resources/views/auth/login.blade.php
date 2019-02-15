<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <title>Login</title> 
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'> 
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"> 
	<link rel="stylesheet" type="text/css" href="{{ asset('css/nifty.min.css') }}"> 
	<link rel="stylesheet" type="text/css" href="{{ asset('css/demo/nifty-demo-icons.min.css') }}"> 
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/pace/pace.min.css') }}">
	<script src="{{  asset('plugins/pace/pace.min.js') }}" type="text/javascript"></script>  
    <link rel="stylesheet" type="text/css" href="{{ asset('css/demo/nifty-demo.min.css') }}"> 
</head>
 
<body>
    <div id="container" class="cls-container">
        
		<div id="bg-overlay"></div>
		 
		<div class="cls-content">
		    <div class="cls-content-sm panel">
		        <div class="panel-body">
		            <div class="mar-ver pad-btm">
		                <h1 class="h3">Account Login</h1>
		                <p>Sign In to your account</p>
		            </div>
					
					@if(Session::has('message'))
						<div class="alert alert-success">
							{!!Session::get('message')!!}
						</div>
					@endif
		
					 <form class="form-horizontal" method="POST" action="{{ route('login')}}">    
						{{ csrf_field() }}
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
		                <div class="checkbox pad-btm text-left">
		                    <input id="demo-form-checkbox" class="magic-checkbox" name = "remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
		                    <label for="demo-form-checkbox">Remember me</label> 
		                </div>
		                <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
		            </form>
		        </div>              
		    </div>
		</div>
    </div> 
    <script src="{{  asset('js/jquery.min.js') }}" type="text/javascript"></script> 
	<script src="{{  asset('js/bootstrap.min.js') }}" type="text/javascript"></script> 
	<script src="{{  asset('js/nifty.min.js') }}" type="text/javascript"></script> 
	<script src="{{  asset('js/demo/bg-images.js') }}" type="text/javascript"></script>  
	<script src = "{{ asset('js/idlerefresh.js') }}"> </script>
	
</body>
</html>



