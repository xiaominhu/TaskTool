@extends('layouts.employee')
@section('title','Update Service | '.  $task->first_name . ' ' . $task->last_name )
@section('usercontent')
	@push('css')  
		<link href="{!! asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') !!}" rel="stylesheet">
		<link href="{!! asset('plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') !!}" rel="stylesheet"> 
		<link rel="stylesheet" type="text/css" href="{{ asset('plugins/dropzone/dropzone.min.css') }}">
	@endpush 
	<div id="page-head">
		<div id="page-title">
			<h1 class="page-header text-overflow">Update Service</h1>
		</div>
		<ol class="breadcrumb">
			<li><a href="#"><i class="demo-pli-home"></i></a></li>
			<li><a href="{{route('employeeservices')}}"> Manage Services </a></li>   
			<li class="active">Update Service</li>
		</ol>
	</div>    
	<div id="page-content">
		<div class="row"> 
			<div class="col-md-6 col-md-offset-3">  
				<div class="panel panel-bordered panel-info">
					<div class="panel-heading">
						<div class="panel-control">
							<a href = "{!! route('employeeservices') !!}" class="btn btn-info"><i class="demo-psi-cross"></i></a> 
						</div> 
						<h3 class="panel-title"> Update Service </h3> 
					</div>
					<div class="panel-body">   
						<form class="form-horizontal" method = "post" action = "{{ route('employeeservicesupdate', $task->id) }}">  
							<div class="form-group" style = "margin: 0;">  
								<label class="col-md-3 control-label text-right"> <strong> First Name: </strong></label>
								<div class="col-md-3"> 
									<label  class="control-label">  
										{!! $task->first_name !!}
									</label> 
								</div> 
								<label class="col-md-3 control-label text-right"> <strong> Service Date: </strong></label>
								<div class="col-md-3"> 
									<label  class="control-label">  
										{!! $task->date !!}
									</label> 
								</div>  
							</div>   
							<div class="form-group" style = "margin: 0;">  
								<label class="col-md-3 control-label text-right"> <strong> Last Name: </strong></label>
								<div class="col-md-3"> 
									<label  class="control-label">
										{!! $task->last_name !!}
									</label> 
								</div>   
								<label class="col-md-3 control-label text-right"> <strong> Service Time: </strong></label>
								<div class="col-md-3"> 
									<label  class="control-label">
										{!! $task->time !!}
									</label> 
								</div>  
							</div>  
							<div class="form-group" style = "margin: 0;">   
								<label class="col-md-3 control-label text-right"> <strong> Company: </strong></label>
								<div class="col-md-9"> 
									<label  class="control-label">  
										{!! $task->company !!}
									</label> 
								</div>  
							</div> 
							 
							<div class="form-group" style = "margin: 0;">  
								<label class="col-md-3 control-label text-right"> <strong> Address: </strong></label>
								<div class="col-md-9"> 
									<label  class="control-label">  
										{!! $task->address !!}
									</label> 
								</div>  
							</div> 
							 
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									  Job Description: 
								</div>
							</div>
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									<textarea placeholder="" name = "job_description" class="form-control" type="text" readonly>@if($errors->any()){{old('job_description')}}@else{{$service->job_description}}@endif</textarea> 
									@if ($errors->has('job_description'))  
										<span class="help-block"> 
											<strong>{{ $errors->first('job_description') }}</strong>  
										</span>    
									@endif
								</div>
							</div> 
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									Comments: <star>*</star>
								</div>
							</div> 
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									<textarea placeholder="" name = "comments" class="form-control" type="text">@if($errors->any()){{old('comments')}}@else{{$service->comments}}@endif</textarea> 
									@if ($errors->has('comments'))  
										<span class="help-block"> 
											<strong>{{ $errors->first('comments') }}</strong>  
										</span>    
									@endif
								</div> 
							</div>  
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									INSTRUCTIONS: <star>*</star> 
								</div>
							</div>
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									<textarea placeholder="" name = "instructions" class="form-control" type="text">@if($errors->any()){{old('instructions')}}@else{{$service->instructions}}@endif</textarea> 
									@if ($errors->has('instructions'))  
										<span class="help-block"> 
											<strong>{{ $errors->first('instructions') }}</strong>  
										</span>    
									@endif
								</div> 
							</div> 
							<div class="form-group">
								<div class = "col-md-1"> 
								</div>
								<div class="col-md-11">
									<div class="table-responsive"> 
										<table class="table table-vcenter"> 
											<tbody> 
												<tr>
													<td style = "width: 105px;border: none;"> Complited <star>*</star> </td>
													<td style = "border: none;">
														<div class="radio">
															<input id="complited-form-radio"  class="magic-radio" type="radio" name="complited"   value = "1"  @if($errors->any()) @if(old('complited') == '1') checked @endif @else @if($service->complited == '1') checked @endif @endif >
															<label for="complited-form-radio">YES</label> 
															<input id="complited-form-radio-2" class="magic-radio" type="radio" name="complited"  value = "0" @if($errors->any()) @if(old('complited') == '0') checked @endif @else @if($service->complited == '0') checked @endif @endif>
															<label for="complited-form-radio-2"> NO </label>
														</div>  
													</td> 
												</tr>
												<tr>
													<td style = "width: 105px;border: none;"> Billed <star>*</star>  </td>
													<td style = "border: none;">
														<div class="radio">
															<input id="billed-form-radio"  class="magic-radio" type="radio" name="billed"  value = "1" @if($errors->any()) @if(old('billed') == '1') checked @endif @else @if($service->billed == '1') checked @endif @endif >
															<label for="billed-form-radio"> YES </label> 
															<input id="billed-form-radio-2" class="magic-radio" type="radio" name="billed" value = "0" @if($errors->any()) @if(old('billed') == '0') checked @endif @else @if($service->billed == '0') checked @endif @endif>
															<label for="billed-form-radio-2"> NO </label>
														</div> 
													</td> 
												</tr> 
											</tbody>
										</table> 
									</div>
								</div>
							</div>   
							
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									Image:  
								</div>
							</div> 
							 
							<div class  = "form-group">
								<div class = "col-md-1"> </div> 
								<div class="col-md-11"> 
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
									@if($errors->any())
										@if(old('uploadedfiles'))
											@php 
												$uploadedfiles = explode(',', old('uploadedfiles'));
											@endphp
											@foreach($uploadedfiles as $item)
												<div id="" class="pad-top bord-top filequeuepart dz-processing dz-image-preview dz-complete nameadded" data-name="{!! $item !!}">
													<div class="media">
														<div class="media-body"> 
															<div class="media-block">
																<div class="media-left">
																	<img class="dz-img" style = "height: 50px;" alt="123_1-m-x4n7owblikwvmqxrzzv4wna.jpeg" src="{!! asset('images/service' . $item) !!}">
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
									@else
										@php
											$uploadedfiles = array();
										@endphp
										@foreach($service->employeeservice as $item)
											@php
												$uploadedfiles[] = $item->name;
											@endphp
											<div id="" class="pad-top bord-top filequeuepart dz-processing dz-image-preview dz-complete nameadded" data-name="{!! $item->name !!}">
												<div class="media">
													<div class="media-body"> 
														<div class="media-block">
															<div class="media-left">
																<img class="dz-img" style = "height: 50px;" alt="{!! $item->name !!}" src="{!! asset('images/service/' . $item->name) !!}">
															</div>
															<div class="media-body">
																<p class="text-main text-bold mar-no text-overflow">{!! $item->name !!} </p>  
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
							<input type = "hidden" name = "uploadedfiles" value = "@if($errors->any()){{old('uploadedfiles')}}@else{{implode(',', $uploadedfiles)}}@endif" id = "uploadedfilesval">  
							<input type = "hidden" class = "savesend" name = "savesend">  
							<input type = "submit" id = "submitbutton" style = "display:none;"> 
							<div class="form-group">   
								<div class="col-md-12 text-center">  
									<button type = "button" class="btn btn-mint submitdata save">SAVE</button> 
									<button type = "button" class="btn btn-danger submitdata send">COMPLETE</button> 
								</div>
							</div>
							{{csrf_field()}} 
						</form>
					</div> 
				</div> 
			</div>
		</div>
	</div>  
	@push('scripts')
	<?php
		if($errors->any())
			$time = old('time');
		else
			$time = $task->time; 
		$time = date("h:i A", strtotime($time));   
	?>  
    <script src="{!! asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') !!}"></script>
    <script src="{!! asset('plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') !!}"></script>
	<script src="{{  asset('plugins/dropzone/dropzone.min.js') }}"  type="text/javascript"></script>
	<script> 
		$('#demo-tp-com').timepicker({defaultTime: '{!! $time !!}'});  
		$('#demo-dp-component .input-group.date').datepicker({
				format: "yyyy-mm-dd",
				todayBtn: "linked",
				autoclose: true,
				todayHighlight: true
		});	
		
		$(".submitdata").click(function(){ 
			if($(this).hasClass('save')){
				$(".savesend").val(0);
				//$(".form-horizontal").submit();
			}
			
			if($(this).hasClass('send')){
				$(".savesend").val(1);
				//$(".form-horizontal").submit();
			}
			
			$("#submitbutton").trigger("click");
			
		}); 
		/****************************************************************************************************/
		function setuploadedfiles(){
			var val = "";
			$(".filequeuepart.nameadded").each(function(){
				if(val != "")
					val += ",";
				val += $(this).data("name");
			}); 
			$("#uploadedfilesval").val(val); 
		} 
			
		var previewNode = document.querySelector("#dz-template"); 
			previewNode.id = "";
			var previewTemplate = previewNode.parentNode.innerHTML;
			previewNode.parentNode.removeChild(previewNode); 
			var removeBtn = $('#dz-remove-btn');
			var myDropzone = new Dropzone(document.body, {   
				url: "{!! route('employeeservicesuploadimage') !!}", // Set the url
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