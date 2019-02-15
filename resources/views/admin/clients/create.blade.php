@extends('layouts.admin')
@section('title','Create Client')
@section('usercontent')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/heatmap/css/bootstrap-colorpicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/dropzone/dropzone.min.css') }}"> 
@endpush
	<div id="page-head">
		<div id="page-title">
			<h1 class="page-header text-overflow">Create Client</h1>
		</div>
		<ol class="breadcrumb">
			<li><a href="{{ route('adminhome') }}"><i class="demo-pli-home"></i></a></li>
			<li><a href="{{route('adminclients')}}"> Manage Clients </a></li>  
			<li class="active">Create Client</li>   
		</ol>
	</div>
	<div id="page-content">
		<div class="row"> 
			<div class="col-md-6 col-md-offset-3">  
				<div class="panel panel-bordered panel-info">  
					<div class="panel-heading"> 
						<div class="panel-control">
							<a href = "{!! route('adminclients') !!}" class="btn btn-info"><i class="demo-psi-cross"></i></a>
						</div>
						<h3 class="panel-title"> Create Client </h3> 
					</div>
					<div class="panel-body">   
						<form  id = "total-form" class="form-horizontal" method = "post" action = "{{route('adminclientscreate')}}">  
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong>First Name: <star>*</star></strong></label>
								<div class="col-md-9">
									<input placeholder="First Name" name = "first_name" value ="{{old('first_name')}}" class="form-control" type="text" required>
									@if ($errors->has('first_name'))  
										<span class="help-block">
											<strong>{{ $errors->first('first_name') }}</strong>
										</span>
									@endif   
								</div>
							</div>
							 
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong>Last Name: <star>*</star></strong></label>
								<div class="col-md-9">
									<input placeholder="Last Name" name = "last_name" value ="{{old('last_name')}}" class="form-control" type="text" required>
									@if ($errors->has('last_name'))  
										<span class="help-block">
											<strong>{{ $errors->first('last_name') }}</strong>
										</span>
									@endif   
								</div>
							</div> 
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong> Company: <star>*</star></strong></label>
								<div class="col-md-9">
									<input placeholder="company" name = "company" value ="{{old('company')}}" class="form-control" type="text" required>
									@if ($errors->has('company'))  
											<span class="help-block"> 
												<strong>{{ $errors->first('company') }}</strong>  
											</span>    
									@endif
								</div>
							</div>
							
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong> Phone: <star>*</star></strong></label>
								<div class="col-md-9">
									<input placeholder="phone" name = "phone" value ="{{old('phone')}}" class="form-control" type="text" required>
									@if ($errors->has('phone'))  
											<span class="help-block"> 
												<strong>{{ $errors->first('phone') }}</strong>  
											</span>    
									@endif
								</div>
							</div>
							
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong> Address: <star>*</star></strong></label>
								<div class="col-md-9">
									<input placeholder="Address" name = "address" value ="{{old('address')}}" class="form-control" type="text" required>
									@if ($errors->has('address'))  
											<span class="help-block"> 
												<strong>{{ $errors->first('address') }}</strong>  
											</span>    
									@endif
								</div>
							</div>
							
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong> Email: <star>*</star></strong></label>
								<div class="col-md-9">
									<input placeholder="Email" name = "email" value ="{{old('email')}}" class="form-control" type="email" required>
									@if ($errors->has('email'))  
											<span class="help-block"> 
												<strong>{{ $errors->first('email') }}</strong>  
											</span>    
									@endif
								</div>
							</div>  
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong> Type: <star>*</star></strong></label>
								<div class="col-md-9">
									<input placeholder="Type" name = "type" value ="{{old('type')}}" class="form-control" type="text" required>
									@if ($errors->has('type'))  
										<span class="help-block"> 
											<strong>{{ $errors->first('type') }}</strong>  
										</span>    
									@endif  
								</div>
							</div> 
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong> Pool Description: </strong></label>
								<div class="col-md-9">
									<textarea placeholder="" name = "pool_description" class="form-control" type="text">{{old('pool_description')}}</textarea>
									@if ($errors->has('address'))  
											<span class="help-block"> 
												<strong>{{ $errors->first('address') }}</strong>  
											</span>    
									@endif
								</div>
							</div> 
							<div class  = "form-group">
								<label class="col-md-3 control-label"> <strong> Image: <star>*</star></strong></label>
								<div class="col-md-9"> 
									<div class="pad-ver"> 
										<span class="btn btn-success fileinput-button dz-clickable">
											<i class="fa fa-plus"></i>
											<span>Add files...</span>
										</span> 
										<div class="btn-group pull-right"> 
											<button id="dz-remove-btn" class="btn btn-danger cancel" type="reset" disabled>
												 Remove All
											</button>
										</div>
									</div> 
									<div id="dz-previews">
										<div id="dz-template" class="pad-top bord-top filequeuepart">
											<div class="media">
												<div class="media-body"> 
													<div class="media-block">
														<div class="media-left">
															<img class="dz-img" data-dz-thumbnail>
														</div>
														<div class="media-body">
															<p class="text-main text-bold mar-no text-overflow" data-dz-name></p>
															<span class="dz-error text-danger text-sm" data-dz-errormessage></span> 
															<div id="dz-total-progress" style="opacity:0">
																 <div class="progress progress-xs active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
																	<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
																</div>
															</div>
														</div>
													</div>
												</div> 
												<div class="media-right">
													<button data-dz-remove class="btn btn-xs btn-danger dz-cancel">Remove</button>
												</div>
											</div>
										</div> 
									@if(old('uploadedfiles'))
										@php 
											$uploadedfiles = explode(',', old('uploadedfiles'));
										@endphp
										@foreach($uploadedfiles as $item)
										<div id="" class="pad-top bord-top filequeuepart dz-processing dz-image-preview dz-complete nameadded" data-name="1549883308123_1-m-x4n7owblikwvmqxrzzv4wna.jpeg">
											<div class="media">
												<div class="media-body"> 
													<div class="media-block">
														<div class="media-left">
															<img class="dz-img" style = "height: 50px;" alt="123_1-m-x4n7owblikwvmqxrzzv4wna.jpeg" src="{!! asset('images/client' . $item) !!}">
														</div>
														<div class="media-body">
															<p class="text-main text-bold mar-no text-overflow">{!! $item !!} </p>  
														</div>
													</div>
												</div> 
												<div class="media-right">
													<button type = "button" class="btn btn-xs btn-danger dz-cancel-fake">Remove</button>
												</div>
											</div>
										</div>
										@endforeach
									@endif 
									</div> 
								</div>	    
							</div>   
							<div class="form-group">   
								<div class="col-md-12 text-center">  
									<button type = "submit" class="btn btn-mint">Create</button>
									<a href = "{!! route('adminclients') !!}" class="btn btn-danger">Cancel</a>
								</div>
							</div> 
							
							<input type = "hidden" name = "uploadedfiles" value = "{!! old('uploadedfiles') !!}" id = "uploadedfilesval"> 
							{{csrf_field()}} 
						</form>
					</div>
				</div>
			</div>  
		</div>
	</div> 
	 @push('scripts')
		<script src="{{  asset('plugins/heatmap/js/bootstrap-colorpicker.min.js') }}"  type="text/javascript"></script>
		<script src="{{  asset('plugins/dropzone/dropzone.min.js') }}"  type="text/javascript"></script>
		<script>

			@if(old('uploadedfiles'))
			@else
				$("#uploadedfilesval").val(""); 
			@endif
			
			function setuploadedfiles(){
				var val = "";
				$(".filequeuepart.nameadded").each(function(){
					if(val != "")
						val += ",";
					val += $(this).data("name");
				}); 
				$("#uploadedfilesval").val(val); 
			} 
			$('input[name="type"]').colorpicker( 
				{
					format: 'hex'
				}
			); 
			var previewNode = document.querySelector("#dz-template");
			previewNode.id = "";
			var previewTemplate = previewNode.parentNode.innerHTML;
			previewNode.parentNode.removeChild(previewNode); 
			var removeBtn = $('#dz-remove-btn');
			var myDropzone = new Dropzone(document.body, {  
				url: "{!! route('adminclientuploadimage') !!}", // Set the url
				thumbnailWidth: 50,
				thumbnailHeight: 50,
				parallelUploads: 20,
				acceptedFiles: ".jpeg,.jpg,.png,.gif", 
				previewTemplate: previewTemplate,
				success: function(file, response){
					 $(".filequeuepart").last().attr('data-name', response);
					 $(".filequeuepart").last().addClass('nameadded');
					 setuploadedfiles();
				},
				removedfile : function(file){  
					file.previewElement.remove();
					setuploadedfiles();					  
				},
				autoQueue: true, // Make sure the files aren't queued until manually added
				previewsContainer: "#dz-previews", // Define the container to display the previews
				clickable: ".fileinput-button",
				headers: { 
					'x-csrf-token': "{{ csrf_token() }}",
				}
			}); 
			myDropzone.on("addedfile", function(file) { 
				removeBtn.prop('disabled', false);
			}); 
			myDropzone.on("totaluploadprogress", function(progress) {
				$("#dz-total-progress .progress-bar").css({'width' : progress + "%"});
			}); 
			myDropzone.on("sending", function(file) { 
				document.querySelector("#dz-total-progress").style.opacity = "1";
			});   
			myDropzone.on("queuecomplete", function(progress) {
				
				document.querySelector("#dz-total-progress").style.opacity = "0";
				
			}); 
			removeBtn.on('click', function() {
				myDropzone.removeAllFiles(true); 
				removeBtn.prop('disabled', true);
				setuploadedfiles();
			});
			
			$(document).on("click", ".dz-cancel-fake", function(){
				$(this).closest(".filequeuepart ").remove();
				setuploadedfiles();			
			});
			
		</script>
	@endpush
	
	
@endsection
