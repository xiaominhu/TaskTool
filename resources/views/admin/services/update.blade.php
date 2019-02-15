@extends('layouts.admin')
@section('title','Update Service | '.  $task->id)
@section('usercontent')
	@push('css')  
		<link href="{!! asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') !!}" rel="stylesheet">
		<link href="{!! asset('plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') !!}" rel="stylesheet"> 
	@endpush
	
	<div id="page-head">
		<div id="page-title">
			<h1 class="page-header text-overflow">Update Service</h1>
		</div>
		<ol class="breadcrumb">
			<li><a href="#"><i class="demo-pli-home"></i></a></li>
			<li><a href="{{route('adminmaintenances')}}"> Manage Services </a></li>   
			<li class="active">Update Service</li>
		</ol>
	</div>    
	<div id="page-content">
		<div class="row"> 
			<div class="col-md-6 col-md-offset-3">  
				<div class="panel panel-bordered panel-info">
					<div class="panel-heading">
						<div class="panel-control">
							<a href = "{!! route('adminservices') !!}" class="btn btn-info"><i class="demo-psi-cross"></i></a>
						</div>
						<h3 class="panel-title"> Update Service </h3> 
					</div> 
					<div class="panel-body">   
						<form class="form-horizontal" method = "post" action = "{{ route('adminservicesupdate', $task->id) }}">  
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong> Client: <star>*</star></strong></label>
								<div class="col-md-3">
									<select name = "client"   class="form-control" type="text" required>
										<option> Please select the client </option>
										@foreach($clients as $client)
											<option value = "{!! $client->id !!}" @if($errors->any()) @if(old('client') == $client->id) selected @endif @else @if($client->id == $task->client) selected @endif @endif > {!! $client->first_name !!} {!! $client->last_name !!} </option>
										@endforeach
									</select>
									@if ($errors->has('client'))  
										<span class="help-block">
											<strong>{{ $errors->first('client') }}</strong>
										</span>
									@endif   
								</div>
								<label class="col-md-3 control-label"> <strong> Time: <star>*</star></strong></label>
								<div class="col-md-3">
									<div class="input-group date">
										<input id="demo-tp-com" type="text" class="form-control" name = "time"  required>
										<span class="input-group-addon"><i class="demo-pli-clock"></i></span>
									</div>
									@if ($errors->has('time'))  
										<span class="help-block">
											<strong>{{ $errors->first('time') }}</strong>
										</span>
									@endif   
								</div>  
							</div> 
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong> EMPLOYEE: </strong></label>
								<div class="col-md-3">
									<select name = "employee"   class="form-control" type="text">
										<option> Please select the employee </option>
										@foreach($employees as $employee) 
											<option value = "{!! $employee->id !!}" @if($errors->any()) @if(old('employee') == $employee->id) selected @endif @else @if($employee->id == $task->employee) selected @endif @endif > {!! $employee->first_name !!}  {!! $employee->last_name !!}  </option>
											
										@endforeach
									</select>
									@if ($errors->has('employee'))  
										<span class="help-block">
											<strong>{{ $errors->first('employee') }}</strong>
										</span>
									@endif   
								</div>
								<label class="col-md-3 control-label"> <strong> Date: <star>*</star></strong></label>
								<div class="col-md-3">
									<div id="demo-dp-component">
										<div class="input-group date">
											<input type="text" class="form-control" name = "date"  value ="@if($errors->any()){{old('date')}}@else{{$task->date}}@endif" required>
											<span class="input-group-addon"><i class="demo-pli-calendar-4"></i></span>
										</div> 
									</div> 
									@if ($errors->has('date'))  
										<span class="help-block">
											<strong>{{ $errors->first('date') }}</strong>
										</span>
									@endif   
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
									<textarea placeholder="" name = "job_description" class="form-control" type="text">@if($errors->any()){{old('job_description')}}@else{{$service->job_description}}@endif</textarea>
								</div>
							</div>  
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									Comments 
								</div>
							</div>
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									<textarea placeholder="" name = "comments" class="form-control" type="text">@if($errors->any()){{old('comments')}}@else{{$service->comments}}@endif</textarea>
								</div>
							</div> 
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									INSTRUCTIONS 
								</div>
							</div>
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									<textarea placeholder="" name = "instructions" class="form-control" type="text">@if($errors->any()){{old('instructions')}}@else{{$service->instructions}}@endif</textarea>
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
													<td style = "width: 30px;border: none;"> Complited  </td>
													<td style = "border: none;">
														<div class="radio">
															<input id="complited-form-radio" class="magic-radio" type="radio" name="complited"   value = "1"  @if($errors->any()) @if(old('complited') == '1') checked @endif @else @if($service->complited == '1') checked @endif @endif >
															<label for="complited-form-radio">YES</label> 
															<input id="complited-form-radio-2" class="magic-radio" type="radio" name="complited"  value = "0" @if($errors->any()) @if(old('complited') == '0') checked @endif @else @if($service->complited == '0') checked @endif @endif>
															<label for="complited-form-radio-2"> NO </label>
														</div> 
													</td> 
												</tr>
												<tr>
													<td style = "width: 30px;border: none;"> Billed   </td>
													<td style = "border: none;">
														<div class="radio">
															<input id="billed-form-radio" class="magic-radio" type="radio" name="billed"  value = "1" @if($errors->any()) @if(old('billed') == '1') checked @endif @else @if($service->billed == '1') checked @endif @endif >
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
								<div class="col-md-12 text-center">  
									<button type = "submit" class="btn btn-mint">Update</button>
									<a href = "{!! route('adminservices') !!}" class="btn btn-danger">Cancel</a>
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
	<script> 
		$('#demo-tp-com').timepicker({defaultTime: '{!! $time !!}'});  
		$('#demo-dp-component .input-group.date').datepicker({
				format: "yyyy-mm-dd",
				todayBtn: "linked",
				autoclose: true,
				todayHighlight: true
		});	
	</script> 
	@endpush	
	
	
@endsection
