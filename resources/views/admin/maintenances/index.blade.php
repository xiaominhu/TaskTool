@extends('layouts.admin')
@section('title','Maintenances Management')
@section('usercontent')
	<style>
		.enableworkspace{
			display:none;
		}
	</style> 
	<div id="page-head">
		<div id="page-title">
			<h1 class="page-header text-overflow">Maintenance Management </h1>
		</div>
		<ol class="breadcrumb">
			<li><a href="{{ route('adminhome') }}"><i class="demo-pli-home"></i></a></li>  
			<li class="active"> Manage Maintenances </li> 
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
			<div class="col-sm-12">
				<div class="panel"> 
					<div class="panel-body"> 
						<div class = "row"> 
							<div class = "col-sm-4 toolbar-left text-left">
								Employee :
								<div class="select" >
									<select id="employeeuser">
										 @foreach($employees as $employee)
										 <option value = "{!! $employee->id !!}"  @if(Session::has('maintenanceemployee'))  @if(Session::get('maintenanceemployee') == $employee->id) selected @endif   @endif> {!! $employee->first_name !!}  {!! $employee->last_name !!} </option>
										 @endforeach
									</select>
								</div>  
							</div> 
							<div class = "col-sm-8">
								<div class = "text-right">
									@if($total_employees != count($employees))
									<a href = "{{ route('adminmaintenancescreatetable') }}" class="btn btn-primary btn-fill btn-wd">Create New Maintenance Table</a>  
									@endif
								</div>
							</div>   
						</div>
						<div class="table-responsive"> 
						</div>   
						<div class = "col-md-6 enableworkspace">
							<a href = "#" class = "addnewrow"> + Add New Row </a>
						</div>  
						<div class = "col-md-6 text-right enableworkspace">
							<a href = "#" class = "deleterow"> - Delete Row </a>
						</div>  
					</div>
				</div>            
			</div>
		</div>
	</div> 
	@push('scripts')
	<script>
		$(".addnewrow").click(function(){
			 swal({
					title: "Notification",
					text: "Do you want to add new row?",
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: "Yes",
					cancelButtonText: "No"
				}).then((result) => {
					if (result.value){
						$.ajax({
							url: '{!! route('adminmaintenanceaddnewrow') !!}',
							type: 'POST',
							data: {_token : "{{ csrf_token() }}", value : $("#employeeuser").val()},
							dataType: 'json',
							beforeSend: function () {
							},
							success: function(json) {
								if(json.status)
									employeeuser(); 
							},
							complete: function () {
								
							},
							error: function() { 
							}
						}); 
					}
			   });
		});
		
		$(".deleterow").click(function(){
			
			swal({
				title: "Notification",
				text: "Do you want to remove the row?",
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: "Yes",
				cancelButtonText: "No"
			}).then((result) => {
				if (result.value){
					$.ajax({
						url: '{!! route('adminmaintenancedeleterow') !!}',
						type: 'POST',
						data: {_token : "{{ csrf_token() }}", value : $("#employeeuser").val()},
						dataType: 'json',
						beforeSend: function () {
						},
						success: function(json) {
							if(json.status)
								employeeuser(); 
						},
						complete: function () {
							
						},
						error: function() { 
						}
					}); 
				}
			});
		});
		
		function employeeuser(){
			 $.ajax({
				url: '{!! route('adminmaintenancesposttable') !!}',
				type: 'POST',
				data: {_token : "{{ csrf_token() }}", value : $("#employeeuser").val()},
				dataType: 'json',
				beforeSend: function () {
				},
				success: function(json) {
					if(json.status){
						 $(".table-responsive").html(json.html);
						 $(".enableworkspace").show();
					}
					else{
						 $(".table-responsive").html('<div class = "text-center"> No Data To Display. </div>');
						 $(".enableworkspace").hide();
					}
				},
				complete: function () {
					
				},
				error: function() { 
				}
			}); 
		}

		$("#employeeuser").change(function(){
			employeeuser();
		});
		
		@if(count($employees))
			employeeuser();
		@else
			 $(".table-responsive").html('<div class = "text-center"> No Data To Display. </div>'); 
		@endif

		/************************************************************************/
		$(document).on("click", ".tasktd", function(){
			if($(this).hasClass("taskblank")){ 
				var obj = $(this);  
				swal({
						title: "Notification",
						text: "Will you create new maintenance?",
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: "Yes",
						cancelButtonText: "No"
				}).then((result) => {
					if (result.value){
						window.location.href = "{!! route('adminmaintenancescreate') !!}?employee=" + $("#employeeuser").val() +  "&date=" +  obj.data('date');
					}
				}); 
			}
			else{
				location.href =  $(this).data('url');
			}
		});
		  
	</script>
	@endpush
@endsection
