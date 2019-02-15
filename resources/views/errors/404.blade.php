<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Page Not Found </title>
 
    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css') }}">


    <!--Nifty Stylesheet [ REQUIRED ]-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/nifty.min.css') }}">

    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/demo/nifty-demo-icons.min.css') }}">
 

    <!--Pace - Page Load Progress Par [OPTIONAL]-->
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/pace/pace.min.css') }}">
	<script src="{{ asset('plugins/pace/pace.min.js') }}" type="text/javascript"></script> 

            
   
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
    <div id="container" class="cls-container">
        
		<!-- HEADER -->
		<!--===================================================-->
		<div class="cls-header">
		    <div class="cls-brand">
		        <a class="box-inline" href="index.html">
		            <!--<img alt="Nifty Admin" src="img/logo.png" class="brand-icon">-->
		             <span class="brand-title">RequestTracker<span class="text-thin">Pro</span></span>
		        </a>
		    </div>
		</div>
		
		<!-- CONTENT -->
		<!--===================================================-->
		<div class="cls-content">
		    <h1 class="error-code text-info">404</h1>
		    <p class="h4 text-uppercase text-bold">Page Not Found!</p>
		    <div class="pad-btm">
		        Sorry, but the page you are looking for has not been found on our server.
		    </div>
		   
		    <hr class="new-section-sm bord-no">
		    <div class="pad-top"><a class="btn btn-primary" href="{{ route('home') }}">Return Home</a></div>  
		</div>
		
		
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->

 
	<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script> 
	<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script> 
	<script src="{{ asset('js/nifty.min.js') }}" type="text/javascript"></script> 
 
    </body>
</html>

