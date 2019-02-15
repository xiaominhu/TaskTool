@extends('layouts.admin')
@section('title','Create Employee')
@section('usercontent')
	<div id="page-head">
		<div id="page-title">
			<h1 class="page-header text-overflow">Create Employee</h1>
		</div>
		<ol class="breadcrumb">
			<li><a href="{{ route('adminhome') }}"><i class="demo-pli-home"></i></a></li>
			<li><a href="{{route('adminworkers')}}"> Manage Employees </a></li>  
			<li class="active">Create Employee</li>  
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
						<h3 class="panel-title"> Create Employee </h3>
					</div>
					<div class="panel-body">   
						<form class="form-horizontal" method = "post" action = "{{route('adminworkerscreate')}}"> 
						
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
								<label class="col-md-3 control-label"> <strong> Password: <star>*</star></strong></label>
								<div class="col-md-9">
									<input placeholder="Password" name = "password"  class="form-control" type="text" required>
									@if ($errors->has('password'))  
										<span class="help-block"> 
											<strong>{{ $errors->first('password') }}</strong>  
										</span>    
									@endif  
								</div>
							</div> 
							<div class="form-group">   
								<div class="col-md-12 text-center">  
									<button type = "submit" class="btn btn-mint">Create</button>
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
