<style>
.formdetail .table th { 
    font-size: 12px !important;
}
.formdetail .table td{
	 font-size: 12px;
	 padding-top: 0;
	 padding-bottom: 0;
	/* border: none !important; */
}
</style>
<div class ="row  formdetail">
	<div class="form-group"> 
		<label class="col-md-6 control-label text-center"> <strong> Client </strong></label>
		<label class="col-md-6 control-label text-center"> <strong> Employee </strong></label>
	</div> 
	<div class="form-group"> 
		<label class="col-md-2 control-label text-right"> <strong> First Name: </strong></label>
		<div class="col-md-4">
			<label  class="control-label"> {!! $task->client_data->first_name !!} </label>
		</div>
		
		<label class="col-md-2 control-label text-right"> <strong> First Name: </strong></label>
		<div class="col-md-4">
			<label  class="control-label"> {!! $task->worker_data->first_name !!} </label>
		</div> 
	</div> 
	<div class="form-group"> 
		<label class="col-md-2 control-label text-right"> <strong> Last Name: </strong></label>
		<div class="col-md-4">
			<label  class="control-label"> {!! $task->client_data->last_name !!} </label>
		</div>
		
		<label class="col-md-2 control-label text-right"> <strong> Last Name: </strong></label>
		<div class="col-md-4">
			<label  class="control-label"> {!! $task->worker_data->last_name !!} </label>
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-md-2 control-label text-right"> <strong> Company: </strong></label>
		<div class="col-md-4">
			<label  class="control-label"> {!! $task->client_data->company !!} </label>
		</div> 
		<label class="col-md-2 control-label text-right"> <strong> phone: </strong></label>
		<div class="col-md-4">
			<label  class="control-label"> {!! $task->worker_data->phone !!} </label>
		</div>  
	</div>
	<div class="form-group"> 
		<label class="col-md-2 control-label text-right"> <strong> Phone: </strong></label>
		<div class="col-md-4">
			<label  class="control-label"> {!! $task->client_data->phone !!} </label>
		</div> 
		
		<label class="col-md-2 control-label text-right"> <strong> Email: </strong></label>
		<div class="col-md-4">
			<label  class="control-label"> {!! $task->worker_data->email !!} </label>
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-md-2 control-label text-right"> <strong> Address: </strong></label>
		<div class="col-md-10">
			<label  class="control-label"> {!! $task->client_data->address !!} </label>
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-md-2 control-label text-right"> <strong> Email: </strong></label>
		<div class="col-md-10">
			<label  class="control-label"> {!! $task->client_data->email !!} </label>
		</div> 
	</div>
</div> 
<div class ="row  formdetail">
	<div class="form-group">
		<div class = "col-md-1"></div>
		<div class="col-md-11">
			<div class="table-responsive">
				<table class="table table-vcenter mar-top">
					<thead>
						<tr>
							<th class="min-w-td">Chemical Readings</th>
							<th class="min-w-td text-center">In/Out of Range   </th>
							<th>   Action Taken  </th> 
						</tr>
					</thead>
					<tbody> 
						<tr>
							<td class="min-w-td"> Chlorine  </td>
							<td class = "text-center">
								 @if($task->maintenance->chlorine == '0') in @endif
								 @if($task->maintenance->chlorine == '1') out @endif 
							</td>
							<td>   
								<label  class="control-label">  {!! $task->maintenance->chlorine_action_taken !!} </label>
							</td>
						</tr>
						<tr>
							<td class="min-w-td"> pH  </td>
							<td class = "text-center">  
								 @if($task->maintenance->ph == '0') in @endif
								 @if($task->maintenance->ph == '1') out @endif 
							</td>
							<td>   
								<label  class="control-label"> {!! $task->maintenance->ph_action_taken !!}  </label>
							</td>
						</tr>
						<tr>
							<td class="min-w-td"> Total alkalinity  </td>
							<td class = "text-center">
								@if($task->maintenance->total_alkalinity == '0') in @endif
								@if($task->maintenance->total_alkalinity == '1') out @endif 
							</td>
							<td>   
								<label  class="control-label">  {!! $task->maintenance->total_alkalinity_action_taken !!}  </label>
							</td>
						</tr>
						<tr>
							<td class="min-w-td"> Stabilizer  </td>
							<td class = "text-center">
								@if($task->maintenance->stabilizer == '0') in @endif
								@if($task->maintenance->stabilizer == '1') out @endif 
							</td>
							<td>   
								<label  class="control-label"> {!! $task->maintenance->stabilizer_action_taken !!}  </label>
							</td>
						</tr>
						<tr>
							<td class="min-w-td"> Salt  </td>
							<td class = "text-center">
								@if($task->maintenance->salt == '0') in @endif
								@if($task->maintenance->salt == '1') out @endif 
							</td>
							<td>   
								<label  class="control-label">  {!! $task->maintenance->salt_action_taken !!}  </label>
							</td>
						</tr>
						<tr>
							<td class="min-w-td"> Other  </td>
							<td class = "text-center">
								@if($task->maintenance->other == '0') in @endif
								@if($task->maintenance->other == '1') out @endif 
							</td>
							<td>   
								<label  class="control-label">  {!! $task->maintenance->other_action_taken !!}  </label>
							</td>
						</tr>
					</tbody>
				</table> 
			</div>
		</div>
	</div>
</div>

<div class ="row  formdetail">
	<div class="form-group clearfix">
		<div class = "col-md-1"> </div>
		<div class="col-md-11">
			<strong> We tested / serviced the fallowing equipment: </strong>
		</div>
	</div>
	@if(in_array("pump", $task->equipment_array))
		<div class="form-group">
			<div class = "col-md-1"> </div> <div class = "col-md-11"> <label  class="control-label">  Pump  </label> </div> 
		</div>
	@endif
	@if(in_array("filter", $task->equipment_array))
		<div class="form-group">
			<div class = "col-md-1"> </div> <div class = "col-md-11"> <label  class="control-label">  Filter  </label> </div> 
		</div>
	@endif
	@if(in_array("heater", $task->equipment_array))
		<div class="form-group">
			<div class = "col-md-1"> </div> <div class = "col-md-11"> <label  class="control-label">  Heater  </label> </div> 
		</div>
	@endif
	@if(in_array("heat_pump", $task->equipment_array))
		<div class="form-group">
			<div class = "col-md-1"> </div> <div class = "col-md-11"> <label  class="control-label">  Heat pump  </label> </div> 
		</div>
	@endif
	@if(in_array("salt_chlorinator_system", $task->equipment_array))
		<div class="form-group">
			<div class = "col-md-1"> </div> <div class = "col-md-11"> <label  class="control-label">  Salt chlorinator system  </label> </div> 
		</div>
	@endif
	@if(in_array("pool_light", $task->equipment_array))
		<div class="form-group">
			<div class = "col-md-1"> </div> <div class = "col-md-11"> <label  class="control-label">  Pool light (s)  </label> </div> 
		</div>
	@endif
	@if(in_array("spa_light", $task->equipment_array))
		<div class="form-group">
			<div class = "col-md-1"> </div> <div class = "col-md-11"> <label  class="control-label">   Spa light (s)  </label> </div> 
		</div>
	@endif
	@if(in_array("automation_system", $task->equipment_array))
		<div class="form-group">
			<div class = "col-md-1"> </div> <div class = "col-md-11"> <label  class="control-label">   Automation system  </label> </div> 
		</div>
	@endif 
	@if(in_array("other", $task->equipment_array))
		<div class="form-group">
			<div class = "col-md-1"> </div> <div class = "col-md-11"> <label  class="control-label">  Other  </label> </div> 
		</div>
	@endif
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
	<div class="form-group clearfix">
		<div class = "col-md-1"> </div>
		<div class="col-md-11">
			 {!! nl2br($task->maintenance->serviced_comments) !!}
		</div>
	</div>
</div>


<div class ="row  formdetail"> 
	<div class="form-group clearfix">
		<div class = "col-md-1"> </div>
		<div class="col-md-11">
			<strong> Actions required of pool owner: </strong>
		</div>
	</div>
	@if(in_array("clean", $task->poolowner_array))
		<div class="form-group">
			<div class = "col-md-1"> </div> <div class = "col-md-11"> <label  class="control-label">  Please clean filter  </label> </div> 
		</div>
	@endif
	
	@if(in_array("waterto", $task->poolowner_array))
		<div class="form-group">
			<div class = "col-md-1"> </div> <div class = "col-md-11"> <label  class="control-label">  Please add water to pool   </label> </div> 
		</div>
	@endif
	
	@if(in_array("waterfrom", $task->poolowner_array))
		<div class="form-group">
			<div class = "col-md-1"> </div> <div class = "col-md-11"> <label  class="control-label">  Please drain excess water from pool  </label> </div> 
		</div>
	@endif
	
	@if(in_array("other", $task->poolowner_array))
		<div class="form-group">
			<div class = "col-md-1"> </div> <div class = "col-md-11"> <label  class="control-label">  Other  </label> </div> 
		</div>
	@endif 
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
			 {!! nl2br($task->maintenance->pool_comments) !!}
		</div>
	</div>
</div>
