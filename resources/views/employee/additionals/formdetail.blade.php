<div class="row"> 
	<div class="form-group"> 
		<label class="col-md-3 control-label text-right"> <strong> First Name: </strong></label>
		<div class="col-md-3">
			<label  class="control-label"> {!! $task->client_data->first_name !!} </label>
		</div> 
	</div> 	
</div>
<div class="row"> 	
	<div class="form-group"> 
		<label class="col-md-3 control-label text-right"> <strong> Last Name: </strong></label>
		<div class="col-md-3">
			<label  class="control-label"> {!! $task->client_data->last_name !!} </label>
		</div> 
	</div>
</div>
<div class="row"> 
	<div class="form-group"> 
		<label class="col-md-3 control-label text-right"> <strong> Company: </strong></label>
		<div class="col-md-3">
			<label  class="control-label"> {!! $task->client_data->company !!} </label>
		</div>  
	</div>
</div>
<div class="row"> 
	<div class="form-group"> 
		<label class="col-md-3 control-label text-right"> <strong> Phone: </strong></label>
		<div class="col-md-3">
			<label  class="control-label"> {!! $task->client_data->phone !!} </label>
		</div> 
	</div>
</div>
<div class="row">
	<div class="form-group"> 
		<label class="col-md-3 control-label text-right"> <strong> Address: </strong></label>
		<div class="col-md-9">
			<label  class="control-label"> {!! $task->client_data->address !!} </label>
		</div> 
	</div>
	<div class="form-group clearfix"> 
		<label class="col-md-3 control-label text-right"> <strong> Email: </strong></label>
		<div class="col-md-9">
			<label  class="control-label"> {!! $task->client_data->email !!} </label>
		</div> 
	</div>
</div>
 		
<div class ="row"> 
	<div class="form-group mar-no"> 
		<label class="col-md-3 control-label text-right"> <strong> Service Date: </strong></label>
		<div class="col-md-3">
			<label  class="control-label"> {!! $task->date !!} </label>
		</div> 
	</div>
</div>
<div class="row">
	<div class="form-group clearfix"> 
		<label class="col-md-3 control-label text-right"> <strong> Service Time: </strong></label>
		<div class="col-md-3">
			<label  class="control-label"> {!! $task->time !!} </label>
		</div> 
	</div> 
</div> 

<div class ="row"> 
	<div class="form-group">
		<div class = "col-md-1"> </div>
		<div class="col-md-11"> 
			<span class = "text-primary"> Job Description: </span>
		</div>
	</div>
	<div class="form-group clearfix">
		<div class = "col-md-1"> </div>
		<div class="col-md-11">
			 {!! nl2br($task->additional->job_description) !!}
		</div>
	</div> 
</div>	
 
<div class ="row">	 
	<div class="form-group">
		<div class = "col-md-1"> </div>
		<div class="col-md-11">
			<span class = "text-primary"> Comments  </span>
		</div>
	</div>  
	<div class="form-group">
		<div class = "col-md-1"> </div>
		<div class="col-md-11">
			 {!! nl2br($task->additional->comments) !!}
		</div>
	</div>
</div>

 