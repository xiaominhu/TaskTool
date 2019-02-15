<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('title') </title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/nifty.min.css') }}">
	<style>
		.scroll-bottom.in{
			display: block;
			background-color: #6a7f95;;
			color: #fff;
			cursor: pointer;
			position: fixed;
			top: 65px;
			right: 15px;
			z-index: 999;
			opacity: 1;
			padding: 10px;
			font-size: 1.5em;
			border-radius: 100%; 
			box-shadow: none;
			transition: all 0.15s;
		}
		star{  
			color: #EB5E28;     
			padding-left: 3px;
		}
		@media (max-width: 992px){
			.table-responsive .table th, .table-responsive .table td{
				font-size: 12px !important;
			} 
		}
		.nomargin{
			margin: 0;
		}
		#form-gallery{
			margin:0 auto;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/demo/nifty-demo-icons.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/pace/pace.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/unitegallery/css/unitegallery.min.css') }}"> 
	<script src="{{ asset('plugins/pace/pace.min.js') }}" type="text/javascript"></script> 
	<link rel="stylesheet" type="text/css" href="{{ asset('css/demo/nifty-demo.min.css') }}"/>
	<link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	@stack('css')
</head>
<body>    
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        <header id="navbar">
            <div id="navbar-container" class="boxed">
                <div class="navbar-header">
                    <a href="{{ route('home')}}" class="navbar-brand">  
                        <div class="brand-title">
                                <img class="brand-logo" src="{{asset('img/residential-pool-service-logo.png')}}">
                        </div>
                    </a>                      
                </div>
                <div class="navbar-content">
                    <ul class="nav navbar-top-links">
                        <li class="tgl-menu-btn">
                            <a class="mainnav-toggle" href="#">
                                <i class="demo-pli-list-view"></i>
                            </a>                   
                        </li> 
                        <li>     
                            <div class="custom-search-form">
                                <label class="btn btn-trans" for="search-input" data-toggle="collapse" data-target="#nav-searchbox">
                                    <i class="demo-pli-magnifi-glass"></i>
                                </label> 
                            </div>      
                        </li>                         
                    </ul>    
                    <ul class="nav navbar-top-links">
                        <li id="dropdown-user" class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                <span class="ic-user pull-right">
                                    <i class="demo-pli-male"></i>
                                </span> 
                            </a>   
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right panel-default">
                                <ul class="head-list">
                                    <li><a href="{{route('logout')}}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();"><i class="demo-pli-unlock icon-lg icon-fw"></i> Logout</a></li> 
                                </ul>   
                            </div>                            
                        </li>
                    </ul> 
                </div>
            </div>
        </header>        
		<div class="boxed">                      
			<div id="content-container">
			@yield('usercontent') 
			</div>
            <nav id="mainnav-container">
                <div id="mainnav">
                    <div id="mainnav-menu-wrap">
                        <div class="nano">
                            <div class="nano-content"> 
                                <div id="mainnav-profile" class="mainnav-profile">
                                    <div class="profile-wrap text-center">
                                        <div class="pad-btm">
											<a href = "javascript: void(0)" class = "avatar-selector">
												@if(Auth::user()->picture)
													<img class="img-circle img-md" src="{{asset('images/avatar/' .   Auth::user()->picture )}}" alt="{!! Auth::user()->first_name !!} {!! Auth::user()->last_name !!}">
												@else
													<img class="img-circle img-md" src="{{asset('img/profile-photos/1.png')}}" alt="{!! Auth::user()->first_name !!} {!! Auth::user()->last_name !!}">
												@endif 
											</a>
                                        </div>
                                        <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                            <span class="pull-right dropdown-toggle">
                                                <i class="dropdown-caret"></i>
                                            </span>
                                            <p class="mnp-name"> {{Auth::user()->first_name}}   {{Auth::user()->last_name}}</p>
                                            <span class="mnp-desc">   </span>   
                                        </a>
                                    </div>                              
                                    <div id="profile-nav" class="collapse list-group bg-trans"> 
										<a href="{{ route('logout') }}"  onclick="event.preventDefault();  document.getElementById('logout-form').submit();" class="logout-button list-group-item"><i class="demo-pli-unlock icon-lg icon-fw"></i> Logout </a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }} 
										</form>                     
                                    </div>                     
                                </div>                                                                 
                                <ul id="mainnav-menu" class="list-group"> 
									<li @if(Request::is('employee/maintenances') || Request::is('employee/maintenances/*')|| Request::is('/')|| Request::is('employee/home')) class = "active-sub active" @endif>
										<a href="{!! route('employeemaintenances') !!}">
											<i class="fa fa-tasks"></i>
											<span class="menu-title">  
												MAINTENANCE
												@if(Mainhelper::getUncompletedMaintenance(Auth::user()->id))
												<span class="pull-right badge badge-danger">{!! Mainhelper::getUncompletedMaintenance(Auth::user()->id) !!}</span>
												@endif 
											</span>
										</a>                                                                     
									</li> 
									
									<li @if(Request::is('employee/services') || Request::is('employee/services/*')) class = "active-sub active" @endif>
										<a href="{!! route('employeeservices') !!}">
											<i class="fa fa-cab"></i>
											<span class="menu-title">  
												SERVICES 
												@if(Mainhelper::getUncompletedService(Auth::user()->id))
												<span class="pull-right badge badge-danger">{!! Mainhelper::getUncompletedService(Auth::user()->id) !!}</span>
												@endif
											</span>
										</a>                                                                     
									</li>
									
									<li @if(Request::is('employee/additionals') || Request::is('employee/additionals/*')) class = "active-sub active" @endif>
										<a href="{!! route('employeeadditionals') !!}">
											<i class="fa fa-cab"></i>
											<span class="menu-title">   
												Additional Job  
											</span>
										</a>                                
									</li> 
									
						            <li class="list-divider"></li>  
									<li @if(Request::is('employee/employees') || Request::is('employee/employees/*')) class = "active-sub active" @endif>
										<a href="{!! route('employeeworkers') !!}">  
											<i class="fa fa-users"></i>
											<span class="menu-title">  Employees  </span>
										</a>                                                                     
									</li> 
									<li @if(Request::is('employee/clients') || Request::is('employee/clients/*')) class = "active-sub active" @endif>
										<a href="{!! route('employeeclients') !!}">  
											<i class="fa fa-users"></i>
											<span class="menu-title">  Clients  </span>
										</a>                                                                     
									</li> 
						        </ul> 
                            </div>  
                        </div>                   
                    </div>                          
                </div>       
            </nav>      
		</div>
        <footer id="footer">     
            <p class="pad-lft">&#0169; <?= date('Y'); ?>  rpsapp.tk </p>
        </footer>
        <button class="scroll-top btn hidden-xs">  
            <i class="pci-chevron chevron-up"></i>
        </button> 
    </div> 
	 
	<div id="uploadavatar" class="modal fade" role="dialog">
		<div class="modal-dialog"> 
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"> Upload Picture </h4>
				</div>
				<form  class="form-horizontal" action="{!! route('uploadpicture') !!}" method="post" enctype="multipart/form-data">
					<div class="modal-body"> 
						{{csrf_field()}}
						<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong> Picture: <star>*</star></strong></label>
								<div class="col-md-9">
									<input   type = "file" class="form-control border-primary"  name="picture" style = "height: auto;" required> </input>
									@if ($errors->has('picture'))
										<span class="help-block">
											<strong>{{ $errors->first('picture')}}</strong>
										</span>
									@endif 
								</div>
						</div>
					</div> 
					<div class="modal-footer">
						<button type = "submit" class="btn btn-mint">Save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> 
					</div>
				</form>
			</div> 
		</div>
	</div> 
	 
	<script src="{{  asset('js/jquery.min.js') }}"    type="text/javascript"></script>
	<script src="{{  asset('js/bootstrap.min.js') }}" type="text/javascript"></script> 
	<script src="{{  asset('js/nifty.js') }}"         type="text/javascript"></script>
	<script>
		!function ($) {
			"use strict";  
			$(document).one('nifty.ready', function(){
				var niftyScrollTop = $('.scroll-top'), niftyScrollDown =  $('.scroll-bottom') ,niftyWindow = $(window), isMobile = function(){
					return ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
				}();
				if (niftyScrollTop.length && !isMobile) {     
					var isVisible = false, offsetTop = 250,
					calcScroll = function (){ 
						if (niftyWindow.scrollTop() > offsetTop && !isVisible) {
							niftyScrollTop.addClass('in').stop(true, true).css({'animation':'none'}).show(0).css({
								"animation" : "jellyIn .8s"
							});
							isVisible = true;
						}else if (niftyWindow.scrollTop() < offsetTop && isVisible) {
							niftyScrollTop.removeClass('in');
							isVisible = false;
						}
						if(window.scrollMaxY == window.scrollY){
							niftyScrollDown.removeClass('in');
						}
						else{
							niftyScrollDown.addClass('in');
						}             
					};
					calcScroll();  
					niftyWindow.scroll(calcScroll);  
					niftyScrollTop.on('click', function(e){  
						e.preventDefault(); 
						$('body, html').animate({scrollTop : 0}, 500);
					});   
					niftyScrollDown.on('click', function(e){
						e.preventDefault();
						$('body, html').animate({scrollTop : $(document).height()}, 500);
					});
				}else{                                   
					niftyScrollTop = null;
					niftyWindow = null;
				}  
				isMobile = null;   
			});
		}(jQuery)             
	</script>                  
	<script src="{{  asset('plugins/bootbox/bootbox.min.js') }}"     type="text/javascript"></script>
	<script src="{{  asset('plugins/unitegallery/js/unitegallery.min.js') }}"     type="text/javascript"></script> 
	<script src="{{  asset('plugins/unitegallery/themes/carousel/ug-theme-carousel.js') }}"     type="text/javascript"></script> 
	@stack('scripts')
	<script> 
		$(".avatar-selector").click(function(){ 
			$("#uploadavatar").modal("show");
		});  
	</script> 
</body>
</html>