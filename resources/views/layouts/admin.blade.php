<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('title') </title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"> 
	<link rel="stylesheet" type="text/css" href="{{ asset('css/nifty.min.css') }}"> 
	<link href='{{asset("plugins/sweet/sweetalert2.min.css")}}' rel='stylesheet'/> 
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
		#form-gallery{
			margin:0 auto;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/demo/nifty-demo-icons.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/pace/pace.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/unitegallery/css/unitegallery.min.css') }}"> 
	<script src="{{ asset('plugins/pace/pace.min.js') }}" type="text/javascript"></script> 
	<link rel="stylesheet" type="text/css" href="{{ asset('css/demo/nifty-demo.min.css') }}"/> 
	<link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
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
                                            <p class="mnp-name"> {{Auth::user()->first_name}} {{Auth::user()->last_name}} </p> 
                                        </a> 
                                    </div>                              
                                    <div id="profile-nav" class="collapse list-group bg-trans"> 
										@if(Auth::user()->usertype == '0')
											<a href="{{ route('userprofile')}}" class="list-group-item">  
												<i class="demo-pli-male icon-lg icon-fw"></i> View Profile
											</a>
										@endif
										<a href="{{ route('logout') }}"  onclick="event.preventDefault();  document.getElementById('logout-form').submit();" class="logout-button list-group-item"><i class="demo-pli-unlock icon-lg icon-fw"></i> Logout </a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }} 
										</form>
                                    </div>
                                </div>
                                <div id="mainnav-shortcut" class="hidden">
                                    <ul class="list-unstyled shortcut-wrap">
                                        <li class="col-xs-3" data-content="My Profile">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
													<i class="demo-pli-male"></i>
                                                </div>   
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Messages">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">           
													<i class="demo-pli-speech-bubble-3"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Activity">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
													<i class="demo-pli-thunder"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Lock Screen">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
													<i class="demo-pli-lock-2"></i>
                                                </div>
                                            </a>                            
                                        </li>   
                                    </ul> 
                                </div>
                                <ul id="mainnav-menu" class="list-group">
									<li @if(Request::is('admin/home')||  Request::is('admin/home/*')) class = "active-sub active" @endif>
						                <a href="{{route('home')}}">
						                    <i class="demo-pli-home"></i>  
						                    <span class="menu-title">
												Dashboard
											</span>
						                </a>
						            </li>
									<li @if(Request::is('admin/employees') || Request::is('admin/employees/*')) class = "active-sub active" @endif>
										<a href="{!! route('adminworkers') !!}">  
											<i class="fa fa-users"></i>
											<span class="menu-title">  Employees  </span>
										</a>
									</li>
									<li @if(Request::is('admin/clients') || Request::is('admin/clients/*')) class = "active-sub active" @endif>
										<a href="{!! route('adminclients') !!}">  
											<i class="fa fa-users"></i>
											<span class="menu-title">  Clients  </span>
										</a>
									</li>
									<li @if(Request::is('admin/maintenances') || Request::is('admin/maintenances/*')) class = "active-sub active" @endif>
										<a href="{!! route('adminmaintenances') !!}">
											<i class="fa fa-tasks"></i>
											<span class="menu-title maintenance-title">  
												MAINTENANCE   
											</span>
										</a>
									</li>
									<li @if(Request::is('admin/services') || Request::is('admin/services/*')) class = "active-sub active" @endif>
										<a href="{!! route('adminservices') !!}">
											<i class="fa fa-cab"></i>
											<span class="menu-title service-title">  SERVICES  </span>
										</a>                                                                     
									</li>
									<li @if(Request::is('admin/additionals') || Request::is('admin/additionals/*')) class = "active-sub active" @endif>
										<a href="{!! route('adminadditionals') !!}">
											<i class="fa  fa-shopping-bag"></i>
											<span class="menu-title addtional-title">   
												Additional Job  
											</span>
										</a>                                                                     
									</li>
									<li @if(Request::is('admin/history') || Request::is('admin/history/*')) class = "active-sub active" @endif>
										<a href="{!! route('admintasks') !!}">  
											<i class="fa fa-calendar"></i>
											<span class="menu-title">  HISTORY  </span>
										</a>                                                                     
									</li>
						            <li class="list-divider"></li> 
						        </ul> 
                            </div>  
                        </div>                   
                    </div>                          
                </div>       
            </nav>      
		</div>                                                
        <footer id="footer">     
            <p class="pad-lft">&#0169; <?= date('Y'); ?>  Sixth Sense Design</p>
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
	<script src='{{  asset("plugins/sweet/sweetalert2.min.js")}}'></script>
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
	<script>
		var deleteconfirm_string = "Do you want to remove this item?"; 
	</script>
	@stack('scripts')
	<script> 
		$(".deleteaction").on("click", function(event){
			 var url = $(this).data('url');
			 swal({
					title: "Notification",
					text: deleteconfirm_string,
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: "Yes",
					cancelButtonText: "No"
				}).then((result) => {
					if (result.value){ 
						window.location.href = url;
					}
			   }); 
		}); 
		 
		function  getTimeDelay(){
			$.ajax({
					url: '{!! route('getnewsigns') !!}',
					type: 'GET',
					data: {},
					dataType: 'json',
					beforeSend: function () {
					},
					success: function(json){
						 if(json.maintenance)
							 $(".maintenance-title").html('MAINTENANCE<span class="pull-right badge badge-danger">' + json.maintenance + '</span>');
						 else
							 $(".maintenance-title").html('MAINTENANCE');
						 
						 if(json.service)
							$(".service-title").html('SERVICES<span class="pull-right badge badge-danger">' + json.service + '</span>');
						 else
							 $(".service-title").html('SERVICES');  
						 
						 if(json.additionals)
							$(".addtional-title").html('Additional Job<span class="pull-right badge badge-danger">' + json.additionals + '</span>');
						 else
							 $(".addtional-title").html('Additional Job'); 
						 
					},
					complete: function () {
						
					},
					error: function() { 
						 
					}
				});  
		} 
	    setInterval(function(){
			getTimeDelay(); 
		 }, 3000); 
		getTimeDelay(); 
		
		$(".avatar-selector").click(function(){ 
			$("#uploadavatar").modal("show");
		});
	</script>
</body>
</html>