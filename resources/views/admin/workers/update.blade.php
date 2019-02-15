@extends('layouts.admin')
@section('title','Update Employee | ' . $user->first_name)
@section('usercontent')
	<div id="page-head">
		<div id="page-title">
			<h1 class="page-header text-overflow">Update Employee</h1>
		</div>
		<ol class="breadcrumb">
			<li><a href="#"><i class="demo-pli-home"></i></a></li>
			<li><a href="{{route('adminworkers')}}"> Manage Employees </a></li>   
			<li class="active">Update Employee</li>
		</ol>
	</div>    
	<div id="page-content">
		<div class="row"> 
			<div class="col-md-6 col-md-offset-3">  
				<div class="panel panel-bordered panel-info">
					<div class="panel-heading"> 
						<div class="panel-control">
							<a href = "{!! route('adminworkers') !!}" class="btn btn-info"><i class="demo-psi-cross"></i></a>
						</div>
						<h3 class="panel-title"> Update Employee </h3> 
					</div>
					<div class="panel-body">   
						<form class="form-horizontal" method = "post" action = "{{ route('adminworkersupdate', $user->id) }}"> 
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong>First Name: <star>*</star></strong></label>
								<div class="col-md-9">
									<input placeholder="First Name" name = "first_name" value ="@if($errors->any()){{old('first_name')}}@else{{$user->first_name}}@endif" class="form-control" type="text" required>
									@if ($errors->has('name'))  
										<span class="help-block"> 
											<strong>{{ $errors->first('name') }}</strong>  
										</span>    
									@endif  
								</div>
							</div> 
							
							
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong>Last Name: <star>*</star></strong></label>
								<div class="col-md-9">
									<input placeholder="Last Name" name = "last_name" value ="@if($errors->any()){{old('last_name')}}@else{{$user->last_name}}@endif" class="form-control" type="text" required>
									@if ($errors->has('last_name'))  
										<span class="help-block"> 
											<strong>{{ $errors->first('last_name') }}</strong>  
										</span>    
									@endif  
								</div>
							</div>
							 
							 
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong> Email: <star>*</star></strong></label>
								<div class="col-md-9">
									<input placeholder="Email" name = "email" value ="@if($errors->any()){{old('email')}}@else{{$user->email}}@endif" class="form-control" type="email" required>
									@if ($errors->has('email'))  
										<span class="help-block"> 
											<strong>{{ $errors->first('email') }}</strong>  
										</span>    
									@endif  
								</div>
							</div> 
							
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong> Phone: <star>*</star></strong></label>
								<div class="col-md-9">
									<input placeholder="Phone" name = "phone" value ="@if($errors->any()){{old('phone')}}@else{{$user->phone}}@endif" class="form-control" type="text" required>
									@if ($errors->has('email'))  
										<span class="help-block"> 
											<strong>{{ $errors->first('email') }}</strong>  
										</span>    
									@endif  
								</div>
							</div> 
							
							
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong> Password: </strong></label>
								<div class="col-md-9">
									<input placeholder="Password" name = "password"  class="form-control" type="text"> 
									@if ($errors->has('password'))  
										<span class="help-block"> 
											<strong>{{ $errors->first('password') }}</strong>  
										</span>    
									@endif  
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label"> <strong>  </strong></label>
								<div class="col-md-9">
									<i> Note: if you populate this field, password will be changed on this contact. </i>
								</div>
							</div>
							 
							<div class="form-group">   
								<div class="col-md-12 text-center">  
									<button type = "submit" class="btn btn-mint">Update</button>
									<a href = "{!! route('adminworkers') !!}" class="btn btn-danger">Cancel</a>
								</div>
							</div>
							{{csrf_field()}} 
						</form>
					</div> 
				</div> 
			</div>
		</div>
	</div> 
	 
@endsection
