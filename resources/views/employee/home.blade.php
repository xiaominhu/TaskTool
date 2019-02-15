@extends('layouts.employee')
@section('title','Home')
@section('usercontent')
	@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/fullcalendar/fullcalendar.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/fullcalendar/nifty-skin/fullcalendar-nifty.min.css') }}">
	<style>
		.taskdetail:hover{
			opacity:  0.8 !important;
			cursor: pointer !important;
		}
	</style>
	@endpush 
	<div id="page-head">
		<div id="page-title">
			<h1 class="page-header text-overflow">Home</h1>
		</div>
		<ol class="breadcrumb">
			<li class="active"> Home  </li>
		</ol>
	</div>
	<div id="page-content">  
		 @if(Session::has('message'))
			<div class="alert alert-success">
				<button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
				{!!Session::get('message')!!}
			</div> 
		@endif      
		<div class="row"> 
			<div class="col-xs-12"> 
				<div class="panel"> 
					<div class="panel-body">
						 <div class="table-responsive">
							 
						</div>   
					</div>
				</div>
				 
			</div>  
		</div>    
	 </div>      
	 
	 <div id="detailmodal" class="modal fade" role="dialog">
		<div class="modal-dialog"> 
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"> Task Detail </h4>
			  </div>
				<div class="modal-body">
					 
				</div> 
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
			</div> 
		</div>
	</div> 
	 
	@push('scripts')
	 <script>		
		  
		  function employeeuser(){ 
			 $.ajax({
				url: '{!! route('employeemaintenancesposttable') !!}',
				type: 'POST',
				data: {_token : "{{ csrf_token() }}"},
				dataType: 'json',
				beforeSend: function () {
					
				},
				success: function(json) {
					if(json.status)
						 $(".table-responsive").html(json.html);
					else
						$(".table-responsive").html('<div class = "text-center"> No Data To Display. </div>'); 
				},
				complete: function () {
					
				},
				error: function() { 
				}
			}); 
		}
		
		$(document).on("click", ".tasktd", function(){
			if($(this).hasClass("taskavailable")){  
				location.href =  $(this).data('url');
			}
		}); 
		 
		employeeuser();
	</script>
	@endpush	
	 
@endsection
