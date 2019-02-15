@extends('layouts.employee')
@section('title','Maintenance Management')
@section('usercontent')
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
					<!-- Striped Table -->
					<div class="panel-body"> 
						<div class="table-responsive">
							<table class="table table-striped table-hover table-vcenter">
								<thead>
									<tr>
										<th> ID </th>   
										<th class = "text-center">  Client Name   </th>
										<th class = "text-center">  Status  </th>
										<th> Date    </th>  
										<th> Action  </th>
									</tr>     
								</thead>  
								<tbody>        
									@forelse($tasks as $task)  
										<tr>
											<td> <a href ="#" class = "queuedetails" data-id  = "{{$task->id}}"> {!! $task->id    !!} </a>  </td>  
											<td class = "text-center"> 
												@if(isset($task->client_data)) 
													<a href= "#" class="add-tooltip" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="{!! $task->client_data->first_name !!} {!! $task->client_data->last_name !!}"> <img class="img-circle img-md" src="{!! asset('img/profile-photos/2.png') !!}" style = "height: 40px;width: 40px;" alt="{!! $task->client_data->first_name !!} {!! $task->client_data->last_name !!}"> </a>   
												@endif
											</td>
											<td class = "text-center">  
												@if($task->status == "0")
													<span class="label label-danger"> Uncompleted </span>
												@else
													<span class="label label-primary"> Completed    </span>
												@endif    
											</td>
											
											<td> {!! $task->date !!}  </td>   
											<td>
												<div class="btn-group btn-group-sm">
													@if($task->status == "0")
													<a  href = "{{ route('employeemaintenancesupdate', $task->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a> 
													@endif
													<a  href = "#" class="btn btn-warning viewinfo" data-id = "{!! $task->id !!}"><i class="fa  fa-eye"></i></a>  
												</div>
											</td>
										</tr>  
									@empty
										<tr> <td class = "text-center" colspan = "8">  There are no maintenances.  </td></tr>
									@endforelse  
								</tbody>
							</table>
						</div>     
						<div class = "text-right">   
							{{$tasks->links()}}
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
				<h4 class="modal-title"> Maintenance Detail </h4>
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
			 $(document).on('click', '.viewinfo' , function(){ 
				 $.ajax({
					url: '{!! route('employeemaintenancesdetail') !!}',
					type: 'POST',
					data: {_token : "{{ csrf_token() }}", value : $(this).data('id')},
					dataType: 'json',
					beforeSend: function () { 
					},
					success: function(json) {
						if(json.status){
							$("#detailmodal .modal-body").html(json.html);
							$("#detailmodal").modal("show");
						}
					},
					complete: function () {
						
					},
					error: function() { 
					}
				}); 
			 });
			 
			 
			 
		</script>
	@endpush
@endsection
