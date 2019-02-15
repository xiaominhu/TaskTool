@extends('layouts.admin')
@section('title','Home')
@section('usercontent') 
	<div id="page-head">
		<div id="page-title">
			<h1 class="page-header text-overflow">Home</h1>
		</div> 
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
										 <option value = "{!! $employee->id !!}"> {!! $employee->first_name !!}  {!! $employee->last_name !!} </option>
										 @endforeach
									</select> 
								</div>  
							</div> 
							<div class = "col-sm-8">
								<div class = "text-right"> 
								</div>
							</div>   
						</div>
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
				<h4 class="modal-title"> Service Detail </h4>
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
				url: '{!! route('adminmaintenancesposttable') !!}',
				type: 'POST',
				data: {_token : "{{ csrf_token() }}", value : $("#employeeuser").val()},
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
						if (result.value) {
							window.location.href = "{!! route('adminmaintenancescreate') !!}?employee=" + $("#employeeuser").val() +  "&date=" +  obj.data('date');
						}
				}); 
			}
			else{ 
				//location.href =  $(this).data('url');
				 $.ajax({
					url: '{!! route('adminmaintenancesdetail') !!}',
					type: 'POST',
					data: {_token : "{{ csrf_token() }}", value : $(this).data('id')},
					dataType: 'json',
					beforeSend: function () { 
					},
					success: function(json) {
						if(json.status){
							$("#detailmodal .modal-title").html('Maintenance Detail');
							$("#detailmodal .modal-body").html(json.html);
							$("#detailmodal").modal("show");
						}
					},
					complete: function () { 
					},
					error: function() { 
					}
				}); 
				
			}
		});
		 
	</script> 
	@endpush
@endsection
