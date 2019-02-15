@extends('layouts.admin')
@section('title','History Management')
@section('usercontent')
	 <div id="page-head">
		<div id="page-title">
			<h1 class="page-header text-overflow"> History Management </h1>
		</div>
		<ol class="breadcrumb">
			<li><a href="{{ route('adminhome') }}"><i class="demo-pli-home"></i></a></li>  
			<li class="active"> Manage Services and Maintenances </li> 
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
						<div class = "row"> 
							<div class = "col-sm-3 toolbar-left text-left"> 
								<form method = "get" action = "{{ route('admintasks') }}">
									Sort by :
									<div class="select" >
										<select id="sortbyuser" name = "sort" >
											<option value="first_name" @if(app('request')->input('sort') == "first_name") selected @endif >First Name</option>
											<option value="last_name"  @if(app('request')->input('sort') == "last_name")  selected @endif >Last Name</option> 
											<option value="type"  	   @if(app('request')->input('sort') == "type")       selected @endif >Type</option> 
											<option value="date"       @if(app('request')->input('sort') == "date") 	  selected @endif >Date</option> 
										</select> 
									</div> 
								</form> 	
							</div>
							
							<div class = "col-sm-3 toolbar-left text-left">
								<form  class="form-horizontal" method = "get" action = "{{ route('admintasks') }}"> 
									 <div class="input-group mar-btm">
										<span class="input-group-btn">
											<button class="btn btn-mint" type="submit" style = "padding: 9px 12px;"><i class="fa fa-search"></i></button>
										</span>
										<input type="text" autofocus name = "key" placeholder="Search" class="form-control" value = "{!! app('request')->input('key') !!}"> 
									</div>
								</form>  
							</div>  
							
						</div> 
					
						<div class="table-responsive">
							<table class="table table-striped table-hover table-vcenter">
								<thead>
									<tr> 
										<th class = "text-center">  Client Name      </th>
										<th class = "text-center">  Client Address   </th>
										<th class = "text-center">  Employee Name   </th>
										<th> Type</th>
										<th> Start Date </th>
										<th  class = "text-center"> Status </th>
										<th> Action </th>
									</tr>         
								</thead>
								<tbody>        
									@foreach($tasks as $task)  
										<tr> 
											<td class = "text-center"> 
												@if(isset($task->client_data)) 
													{!! $task->client_data->first_name !!} {!! $task->client_data->last_name !!}
												@endif
											</td>
											
											<td class = "text-center"> 
												@if(isset($task->client_data)) 
													{!! $task->client_data->address !!}  
												@endif
											</td>
											
											
											<td class = "text-center"> 
												@if(isset($task->worker_data)) 
													@if($task->sign)
														<span class = "text-danger"> <em> {!! $task->worker_data->first_name !!} {!! $task->worker_data->last_name !!} </em> </span>
													@else
														<span> {!! $task->worker_data->first_name !!} {!! $task->worker_data->last_name !!} </span>
													@endif 
												@endif
											</td>
											
											
											
											<td>
												@if($task->type == "0")
													Maintenance
												@else
													Service
												@endif
											</td> 
											<td> {!! $task->date !!}  </td> 
											<td class = "text-center">  
												@if($task->status == "0")
													<span class="label label-danger"> Uncompleted </span>
												@else
													<span class="label label-primary"> Completed    </span>
												@endif    
											</td>
											<td>
												<div class="btn-group btn-group-sm"> 
													<a  href = "#" class="btn btn-warning viewinfo @if($task->type == '0') maintenance @else service @endif" data-id = "{!! $task->id !!}"><i class="fa  fa-eye"></i></a> 
													@if($task->type == "0")
														<a  href = "javascript: void(0)" data-url = "{!! route('adminmaintenancesdelete', $task->id) !!}" class="deleteaction btn btn-danger maintenance"><i class="fa  fa-times"></i></a>
													@else
														<a   href = "javascript: void(0)" data-url = "{!! route('adminservicesdelete', $task->id) !!}" class="deleteaction btn btn-danger deleteaction service"><i class="fa  fa-times"></i></a>
													@endif
												</div>
											</td>							  				 
										</tr>  
									@endforeach  
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
		
			$("select[name='sort']").change(function(){
				var url = "{!! route('admintasks')!!}?";
				@if(app('request')->input('key'))
					url += "key={!! app('request')->input('key') !!}&"; 
				@endif
				location.href = url +  "sort=" + $("#sortbyuser").val();
			});
		
		
			 $(document).on('click', '.viewinfo.service' , function(){
				 var obj = $(this);
				 $.ajax({
					url: '{!! route('adminservicesdetail') !!}',
					type: 'POST',
					data: {_token : "{{ csrf_token() }}", value : $(this).data('id'), type: 'all'},
					dataType: 'json',
					beforeSend: function () { 
					},
					success: function(json) {
						if(json.status){
							$("#detailmodal .modal-title").html('Service Detail');
							$("#detailmodal .modal-body").html(json.html);
							$("#detailmodal").modal("show");
							if(json.change_tr){  
								obj.closest('tr').html(json.change_tr_html);
							} 
						}
					},
					complete: function () {
						
					},
					error: function() { 
					}
				}); 
			 });
			 
			 $(document).on('click', '.viewinfo.maintenance' , function(){
				  var obj = $(this);
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
							if(json.change_tr){  
								obj.closest('tr').html(json.change_tr_html);
							} 
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
