@extends('layouts.admin')
@section('title','Create Addtional Job')
@section('usercontent')
	@push('css')  
		<link href="{!! asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') !!}" rel="stylesheet">
		<link href="{!! asset('plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') !!}" rel="stylesheet"> 
	@endpush
	<div id="page-head">
		<div id="page-title">
			<h1 class="page-header text-overflow">Create Addtional Job</h1>
		</div>
		<ol class="breadcrumb">
			<li><a href="{{ route('employeehome') }}"><i class="demo-pli-home"></i></a></li>
			<li><a href="{{route('employeeadditionals')}}"> Manage Addtional Job </a></li>  
			<li class="active">Create Addtional Job</li>  
		</ol> 
	</div>
	<div id="page-content">
		<div class="row"> 
			<div class="col-md-6 col-md-offset-3">  
				<div class="panel panel-bordered panel-info"> 
					<div class="panel-heading">
						<div class="panel-control">
							<a href = "{!! route('employeeadditionals') !!}" class="btn btn-info"><i class="demo-psi-cross"></i></a>
						</div>
						<h3 class="panel-title"> Create Addtional Job </h3> 
					</div> 
					<div class="panel-body">   
						<form class="form-horizontal" method = "post" action = "{{route('employeeadditionalscreate')}}">  
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong> CLIENT: <star>*</star></strong></label>
								<div class="col-md-3">
									<select name = "client"   class="form-control" type="text" required>
										<option value = ""> Please select the client </option>
										@foreach($clients as $client)
											<option value = "{!! $client->id !!}" @if(old('client') == $client->id) selected @endif> {!! $client->first_name !!} {!! $client->last_name !!} </option>
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
										<input id="demo-tp-com" type="text" class="form-control" name = "time" required>
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
								<label class="col-md-3 control-label"> </label>
								<div class="col-md-3"> 
								</div>
								<label class="col-md-3 control-label"> <strong> Date: <star>*</star></strong></label>
								<div class="col-md-3">
									<div id="demo-dp-component">
										<div class="input-group date">
											<input type="text" class="form-control" name = "date" required>
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
									<textarea placeholder="" name = "job_description" class="form-control" type="text">{{old('job_description')}}</textarea>
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
									<textarea placeholder="" name = "comments" class="form-control" type="text">{{old('comments')}}</textarea>
								</div>
							</div>   
							<div class="form-group">   
								<div class="col-md-12 text-center">  
									<button type = "submit" class="btn btn-mint">Create</button>
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
    <script src="{!! asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') !!}"></script>
    <script src="{!! asset('plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') !!}"></script> 
	<script> 
		$('#demo-tp-com').timepicker({defaultTime: '{!! old("time") !!}'});  
		$('#demo-dp-component .input-group.date').datepicker({ 
				format: "yyyy-mm-dd",
				todayBtn: "linked",
				autoclose: true,
				todayHighlight: true
		});	
	</script>
	@endpush	
	 
@endsection
