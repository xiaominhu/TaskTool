<! DOCTYPE html>
<html lang = "en">
<head> 
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"> 
	<style>
	.page-break {
		page-break-after: always;
	}
	.margin30{
		margin-bottom: 30px;
	}
	
	.margin10{
		margin-bottom: 10px;
	}
	.margin5{
		margin-bottom: 5px;
	}
	.margin20{
		margin-bottom: 20px;
	} 
</style> 
</head>
<body> 
	<div class = "row margin20">
		<h3 class = "text-center"> Service Details </h3>
	</div> 
	<div class="row">  
		<label class="col-xs-2 control-label text-right"> <strong> First Name: </strong></label>
		<div class="col-xs-4">
			{!! $task->worker_data->first_name !!} 
		</div> 
		<label class="col-xs-2 control-label text-right"> <strong> Service Date: </strong></label>
		<div class="col-xs-4">
			 {!! $task->date !!}  
		</div>  
	</div>	 
	<div class="row"> 	 
		<label class="col-xs-2 control-label text-right"> <strong> Last Name: </strong></label>
		<div class="col-xs-4">
			 {!! $task->worker_data->last_name !!}  
		</div> 
		<label class="col-xs-2 control-label text-right"> <strong> Service Time: </strong></label>
		<div class="col-xs-4">
			  {!! $task->time !!}  
		</div>
	</div>  
	<div class="row"> 	 
		<label class="col-xs-2 control-label text-right"> <strong> Phone: </strong></label>
		<div class="col-xs-10">
			 {!! $task->worker_data->phone !!} 
		</div>   
	</div>  
	<div class="row margin30">
		<label class="col-xs-2 control-label text-right"> <strong> Email: </strong></label>
		<div class="col-xs-10">
			{!! $task->worker_data->email !!} 
		</div> 
	</div>  
	<div class ="row">  
		<div class = "col-xs-12">
			<span class = "text-primary"> Job Description:    </span>
		</div>
	</div>
	<div class ="row margin10">
		<div class = "col-xs-12">
			 {!! nl2br($task->service->job_description) !!}
		</div>
	</div> 
	  
	<div class ="row">	 
		<div class = "col-xs-12">
			<span class = "text-primary"> Comments  </span>
		</div>
	</div>  
	<div class ="row margin10">	 
		<div class = "col-xs-12">
			 {!! nl2br($task->service->comments) !!}
		</div>
	</div> 
</body>	
</html>