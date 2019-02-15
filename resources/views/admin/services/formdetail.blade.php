<div class="row">
	<div class="form-group"> 
		<label class="col-md-6 control-label text-center"> <strong> Client </strong></label>
		<label class="col-md-6 control-label text-center"> <strong> Employee </strong></label>
	</div> 
	<div class="form-group"> 
		<label class="col-md-3 control-label text-right"> <strong> First Name: </strong></label>
		<div class="col-md-3">
			<label  class="control-label"> {!! $task->client_data->first_name !!} </label>
		</div>
		
		<label class="col-md-3 control-label text-right"> <strong> First Name: </strong></label>
		<div class="col-md-3">
			<label  class="control-label"> {!! $task->worker_data->first_name !!} </label>
		</div> 
	</div> 
	<div class="form-group"> 
		<label class="col-md-3 control-label text-right"> <strong> Last Name: </strong></label>
		<div class="col-md-3">
			<label  class="control-label"> {!! $task->client_data->last_name !!} </label>
		</div>
		
		<label class="col-md-3 control-label text-right"> <strong> Last Name: </strong></label>
		<div class="col-md-3">
			<label  class="control-label"> {!! $task->worker_data->last_name !!} </label>
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-md-3 control-label text-right"> <strong> Company: </strong></label>
		<div class="col-md-3">
			<label  class="control-label"> {!! $task->client_data->company !!} </label>
		</div> 
		<label class="col-md-3 control-label text-right"> <strong> phone: </strong></label>
		<div class="col-md-3">
			<label  class="control-label"> {!! $task->worker_data->phone !!} </label>
		</div>  
	</div>
	<div class="form-group"> 
		<label class="col-md-3 control-label text-right"> <strong> Phone: </strong></label>
		<div class="col-md-3">
			<label  class="control-label"> {!! $task->client_data->phone !!} </label>
		</div> 
		
		<label class="col-md-3 control-label text-right"> <strong> Email: </strong></label>
		<div class="col-md-3">
			<label  class="control-label"> {!! $task->worker_data->email !!} </label>
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-md-3 control-label text-right"> <strong> Address: </strong></label>
		<div class="col-md-9">
			<label  class="control-label"> {!! $task->client_data->address !!} </label>
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-md-3 control-label text-right"> <strong> Email: </strong></label>
		<div class="col-md-9">
			<label  class="control-label"> {!! $task->client_data->email !!} </label>
		</div> 
	</div>
</div> 		
<div class ="row">
	<div class="form-group"> 
	</div>
	<div class="form-group"> 
		<label class="col-md-3 control-label text-right"> <strong> Service Date: </strong></label>
		<div class="col-md-3">
			<label  class="control-label"> {!! $task->date !!} </label>
		</div>
		<label class="col-md-3 control-label text-right"> <strong> Status: </strong></label>
		<div class="col-md-3">
			<label  class="control-label">   
				@if($task->status == "0")
					<span class="text-danger"> Uncompleted </span>
				@else
					<span class="text-primary"> Completed    </span>
				@endif     
			</label>
		</div>  
	</div>
	<div class="form-group"> 
		<label class="col-md-3 control-label text-right"> <strong> Service Time: </strong></label>
		<div class="col-md-3">
			<label  class="control-label"> {!! $task->time !!} </label>
		</div> 
	</div> 
</div> 
<div class ="row">	
	<div class="form-group"> 
	</div> 
	<div class="form-group">
		<div class = "col-md-1"> </div>
		<div class="col-md-11"> 
			<span class = "text-primary"> Job Description:    </span>
		</div>
	</div>
	<div class="form-group">
		<div class = "col-md-1"> </div>
		<div class="col-md-11">
			 {!! nl2br($task->service->job_description) !!}
		</div>
	</div> 
</div>	 
<div class ="row">	
	<div class="form-group"> 
	</div> 	
	<div class="form-group">
		<div class = "col-md-1"> </div>
		<div class="col-md-11">
			<span class = "text-primary"> Comments  </span>
		</div>
	</div>  
	<div class="form-group">
		<div class = "col-md-1"> </div>
		<div class="col-md-11">
			 {!! nl2br($task->service->comments) !!}
		</div>
	</div>
</div>

<div class ="row">	
	<div class="form-group"> 
	</div> 	
	<div class="form-group">
		<div class = "col-md-1"> </div>
		<div class="col-md-11">
			<span class = "text-primary"> Instructions  </span>
		</div>
	</div>  
	<div class="form-group">
		<div class = "col-md-1"> </div>
		<div class="col-md-11">
			 {!! nl2br($task->service->instructions) !!}
		</div>
	</div>
</div> 
<div class ="row">
	<div class="form-group"> 
	</div>
	<div class="form-group clearfix mar-no">
		<label class="col-md-3 control-label text-right"> <strong> Complited : </strong></label>
		<div class="col-md-9">
			<label  class="control-label">  
				@if($task->service->complited == '0') No  @endif
				@if($task->service->complited == '1') Yes @endif 
			</label>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label text-right"> <strong> Billed  : </strong></label>
		<div class="col-md-9">
			<label  class="control-label">  
				@if($task->service->billed == '0') No  @endif
				@if($task->service->billed == '1') Yes @endif 
			</label>
		</div>
	</div> 
</div>
<div class ="row">
	@if(count($task->employeeservice))
		<div class = "form-group clearfix">
			<div id ="form-gallery" style="display:none;">  
				@foreach($task->employeeservice as $item)
				<a href="#">
					<img alt="{!! $item->id !!}"
						 src="{!! asset('images/service/' . $item->name)!!}"
						 data-image="{!! asset('images/service/'. $item->name)!!}"
						 data-description="{!! $item->id !!}"
						 style="display:none">
				</a>  
				@endforeach
			</div>
		</div>
	@endif
</div>