@extends('layouts.admin')
@section('title','Create Maintenance Table')
@section('usercontent')
@push('css')
 
@endpush
	<div id="page-head">
		<div id="page-title">
			<h1 class="page-header text-overflow">Create Maintenance Table</h1>
		</div>
		<ol class="breadcrumb">
			<li><a href="{{ route('adminhome') }}"><i class="demo-pli-home"></i></a></li>
			<li><a href="{{route('adminmaintenances')}}"> Manage Maintenances </a></li>  
			<li class="active">Create Maintenance Table</li>  
		</ol>
	</div>
	<div id="page-content">
		<div class="row"> 
			<div class="col-md-6 col-md-offset-3">  
				<div class="panel panel-bordered panel-info">  
					<div class="panel-heading">
						<div class="panel-control">
							<a href = "{!! route('adminmaintenances') !!}" class="btn btn-info"><i class="demo-psi-cross"></i></a>
						</div>
						<h3 class="panel-title"> Create Maintenance Table</h3> 
					</div>
					<div class="panel-body">   
						<form class="form-horizontal" method = "post" action = "{{route('adminmaintenancescreatetable')}}">  
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong> Employee: <star>*</star></strong></label>
								<div class="col-md-9">
									<select name = "employee"   class="form-control" type="text" required>
										<option value = ""> Please select the employee </option>
										@foreach($employees as $employee)
											<option value = "{!! $employee->id !!}" @if(old('employee') == $employee->id) selected @endif> {!! $employee->first_name !!}  {!! $employee->last_name !!} </option>
										@endforeach
									</select>
									
									@if(Session::has('maintenanceweek'))  
										<span class="help-block">
											<strong>{{ Session::get('maintenanceweek') }}</strong>
										</span>
									@endif  
									
									@if ($errors->has('employee'))  
										<span class="help-block">
											<strong>{{ $errors->first('employee') }}</strong>
										</span>
									@endif   
								</div>
							</div>
							
							 
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong>Week: <star>*</star></strong></label>
								<div class="col-md-9">
									<select name = "week"   class="form-control"  required>
										@for($i = 1; $i <= 6; $i++)
										<option value = "{!! $i !!}"> {!! $i !!} </option>
										@endfor
									</select>
									@if ($errors->has('week'))  
										<span class="help-block">
											<strong>{{ $errors->first('week') }}</strong>
										</span>
									@endif   
								</div>
							</div> 
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong> Rows: <star>*</star></strong></label>
								<div class="col-md-9">
									<input placeholder="rows" name = "rows" value ="{{old('rows')}}" class="form-control" type="number" required>
									@if ($errors->has('rows'))  
											<span class="help-block"> 
												<strong>{{ $errors->first('rows') }}</strong>  
											</span>    
									@endif
								</div>
							</div> 
							<div class="form-group">   
								<div class="col-md-12 text-center">  
									<button type = "submit" class="btn btn-mint">Create</button> 
									<a href = "{!! route('adminmaintenances') !!}" class="btn btn-danger">Cancel</a>
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
	 
	@endpush
	
	
@endsection
