@extends('layouts.admin')
@section('title','Client Management')
@section('usercontent')
	 <div id="page-head">
		<div id="page-title">
			<h1 class="page-header text-overflow"> Client Management </h1>
		</div>
		<ol class="breadcrumb">
			<li><a href="{{ route('adminhome') }}"><i class="demo-pli-home"></i></a></li>  
			<li class="active"> Manage Clients </li>
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
								<div class = "col-sm-3 toolbar-left text-left">
									<form method = "get" action = "{{ route('adminclients') }}">
										Sort by :
										<div class="select">
											<select id="sortbyuser" name = "sort">
												<option value="first_name" @if(app('request')->input('sort') == "first_name") selected @endif >First Name</option>
												<option value="last_name"  @if(app('request')->input('sort') == "last_name") selected @endif >Last Name</option> 
											</select> 
										</div> 
									</form> 
								</div> 
								<div class = "col-sm-3 toolbar-left text-left">
									<form  class="form-horizontal" method = "get" action = "{{ route('adminclients') }}"> 
										 <div class="input-group mar-btm">
											<span class="input-group-btn">
												<button class="btn btn-mint" type="submit" style = "padding: 9px 12px;"><i class="fa fa-search"></i></button>
											</span>
											<input type="text" autofocus name = "key" placeholder="Search" class="form-control" value = "{!! app('request')->input('key') !!}"> 
										</div>
									</form>  
								</div>  
							
								<div class = "col-sm-6">
									<div class = "text-right">
										<a href = "{{ route('adminclientscreate') }}" class="btn btn-primary btn-fill btn-wd">Add New Client</a>  
									</div>
								</div>   
						</div>
						
						<div class="table-responsive">
							<table class="table table-striped table-hover table-vcenter">
								<thead>
									<tr> 
										<th> Name </th>
										<th> Email </th>
										<th> Phone </th>
										<th> Address  </th>
										<th> Action </th>
									</tr>     
								</thead>
								<tbody>
									@forelse($users as $user)  
										<tr> 
											<td> <a href ="#" class = "queuedetails" data-id  = "{{$user->id}}"> {!! $user->first_name  !!} {!! $user->last_name  !!}    </a>  </td> 
											<td> <a href ="#" class = "queuedetails" data-id  = "{{$user->id}}"> {!! $user->email !!}  </a>  </td>  
											<td>   {!! $user->phone !!}    </td>  
											<td> <a href ="#" class = "queuedetails" data-id  = "{{$user->id}}"> {!! $user->address !!}  </a>  </td>  
											<td>
												<div class="btn-group btn-group-sm"> 
													<a  href = "{{ route('adminclientsupdate', $user->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a> 
													<a  href = "#" class="btn btn-warning viewinfo" data-id = "{!! $user->id !!}"><i class="fa  fa-eye"></i></a> 
													<a   href = "javascript: void(0)" data-url = "{!! route('adminclientsdelete', $user->id ) !!}"  class="btn btn-danger deleteaction"><i class="fa fa-times"></i></a> 
												</div>
											</td>							  				 
										</tr>
									@empty
										<tr> <td class = "text-center" colspan = "9"> There is no client. </td> </tr> 
									@endforelse  
								</tbody>
							</table>
						</div>     
						<div class = "text-right">   
							{{$users->links()}}
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
				<h4 class="modal-title"> Client Detail </h4>
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
			var url = "{!! route('adminclients')!!}?";
			@if(app('request')->input('key'))
				url += "key={!! app('request')->input('key') !!}&"; 
			@endif
			location.href = url +  "sort=" + $("#sortbyuser").val();
		});

		deleteconfirm_string  = "Do you want to remove this client?";
		$(document).on('click', '.viewinfo' , function(){
			 $.ajax({
				url: '{!! route('adminclientdetail') !!}',
				type: 'POST',
				data: {_token : "{{ csrf_token() }}", value : $(this).data('id')},
				dataType: 'json',
				beforeSend: function () { 
				},
				success: function(json) {
					if(json.status){
						$("#detailmodal .modal-body").html(json.html);
						$("#detailmodal").modal("show");  
						if(json.gallery){
							var width  = 100;
							if(json.gallery == 1) width = 33;
							if(json.gallery == 2) width = 66; 
							$("#form-gallery").unitegallery({
								tile_enable_shadow: false,
								gallery_width: width + "%",
								tiles_align:"center"
							}); 
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
