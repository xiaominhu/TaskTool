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
		.margint30{
			margin-top: 30px;
		} 
		 
		.margin10{
			margin-bottom: 10px;
		}
		.margint10{
			margin-top: 10px;
		}
		
		.margin5{
			margin-bottom: 5px;
		}
		.margint5{
			margin-top: 5px;
		}
		
		.margin20{
			margin-bottom: 20px;
		}  
		.margint20{
			margin-top: 20px;
		}
		
		.formdetail .table th { 
			font-size: 10px !important;
		}
		.formdetail .table td{
			 font-size: 12px;
			 padding-top: 0;
			 padding-bottom: 0; 
		}
		.formdetail .equip{
			font-size: 12px !important;
		}
		
		.formdetail .subequip{
			font-size: 13px !important;
		}
	</style> 
</head>
<body>  
 	<div class = "row margin20">
		<h3 class = "text-center"> Maintenance Details </h3>
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
	<div class ="row  formdetail"> 
		<div class="col-xs-12">
			<div class="table-responsive">
				<table class="table mar-top">
					<thead>
						<tr style = "border:none;">
							<th style = "border:none;">Chemical Readings</th>
							<th style = "border:none;" class="text-center">In/Out of Range   </th>
							<th style = "border:none;">   Action Taken  </th> 
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
								  {!! $task->maintenance->chlorine_action_taken !!}  
							</td>
						</tr>
						<tr>
							<td class="min-w-td"> pH  </td>
							<td class = "text-center">  
								 @if($task->maintenance->ph == '0') in @endif
								 @if($task->maintenance->ph == '1') out @endif 
							</td>
							<td>   
								 {!! $task->maintenance->ph_action_taken !!}   
							</td>
						</tr>
						<tr>
							<td class="min-w-td"> Total alkalinity  </td>
							<td class = "text-center">
								@if($task->maintenance->total_alkalinity == '0') in @endif
								@if($task->maintenance->total_alkalinity == '1') out @endif 
							</td>
							<td>   
								  {!! $task->maintenance->total_alkalinity_action_taken !!}  
							</td>
						</tr>
						<tr>
							<td class="min-w-td"> Stabilizer  </td>
							<td class = "text-center">
								@if($task->maintenance->stabilizer == '0') in @endif
								@if($task->maintenance->stabilizer == '1') out @endif 
							</td>
							<td>   
								 {!! $task->maintenance->stabilizer_action_taken !!}   
							</td>
						</tr>
						<tr>
							<td class="min-w-td"> Salt  </td>
							<td class = "text-center">
								@if($task->maintenance->salt == '0') in @endif
								@if($task->maintenance->salt == '1') out @endif 
							</td>
							<td>   
								 {!! $task->maintenance->salt_action_taken !!}   
							</td>
						</tr>
						<tr>
							<td class="min-w-td"> Other  </td>
							<td class = "text-center">
								@if($task->maintenance->other == '0') in @endif
								@if($task->maintenance->other == '1') out @endif 
							</td>
							<td>   
								   {!! $task->maintenance->other_action_taken !!}   
							</td>
						</tr>
					</tbody>
				</table> 
			</div>
		</div> 
	</div>


		 
		<div class ="row  formdetail">
			<div class="col-xs-12">
				<strong> We tested / serviced the fallowing equipment: </strong>
			</div>
		</div>
		@if(in_array("pump", $task->equipment_array))
			<div class ="row  formdetail">
				 <div class = "col-xs-12 equip">  Pump   </div> 
			</div>
		@endif
		@if(in_array("filter", $task->equipment_array))
			<div class ="row  formdetail">
				 <div class = "col-xs-12 equip">  Filter   </div> 
			</div>
		@endif
		
		@if(in_array("heater", $task->equipment_array))
			<div class ="row  formdetail">
				 <div class = "col-xs-12 equip">   Heater  </div> 
			</div>
		@endif
		@if(in_array("heat_pump", $task->equipment_array))
			<div class ="row  formdetail">
				<div class = "col-xs-12 equip">  Heat pump   </div> 
			</div>
		@endif
		@if(in_array("salt_chlorinator_system", $task->equipment_array))
			<div class ="row  formdetail">
				<div class = "col-xs-12 equip"> Salt chlorinator system   </div> 
			</div>
		@endif
		@if(in_array("pool_light", $task->equipment_array))
			<div class ="row  formdetail">
				<div class = "col-xs-12 equip">  Pool light (s)   </div> 
			</div>
		@endif
		@if(in_array("spa_light", $task->equipment_array))
			<div class ="row  formdetail">
				<div class = "col-xs-12 equip"> Spa light (s)    </div> 
			</div>
		@endif
		@if(in_array("automation_system", $task->equipment_array))
			<div class ="row  formdetail">
				<div class = "col-xs-12 equip">   Automation system  </label> </div> 
			</div>
		@endif 
		@if(in_array("other", $task->equipment_array))
			<div class ="row  formdetail">
				<div class = "col-xs-12 equip"> Other  </div> 
			</div>
		@endif 
		@if($task->maintenance->serviced_comments)
		<div class ="row margint10 margint5 formdetail">	 
			<div class="col-xs-12 subequip">
				<span class = "text-primary"> <em> Comments  </em> </span>
			</div>
		</div> 
		<div class="row clearfix formdetail"> 
			<div class="col-xs-12 equip">
				 {!! nl2br($task->maintenance->serviced_comments) !!}
			</div>
		</div>
		@endif 
		<div class="row clearfix margint20"> 
			<div class="col-xs-12">
				<strong> Actions required of pool owner: </strong>
			</div>
		</div> 
		@if(in_array("clean", $task->poolowner_array))
			<div class="row clearfix formdetail"> 
				<div class="col-xs-12 equip"> Please clean filter   </div> 
			</div>
		@endif
		
		@if(in_array("waterto", $task->poolowner_array))
			<div class="row clearfix formdetail"> 
				<div class="col-xs-12 equip">  Please add water to pool    </div> 
			</div>
		@endif
		
		@if(in_array("waterfrom", $task->poolowner_array))
			<div class="row clearfix formdetail"> 
				<div class="col-xs-12 equip">  Please drain excess water from pool  </label> </div> 
			</div>
		@endif
		
		@if(in_array("other", $task->poolowner_array))
			<div class="row clearfix formdetail"> 
				<div class="col-xs-12 equip">  Other    </div> 
			</div>
		@endif 
 

	@if($task->maintenance->pool_comments)
		<div class ="row margint5 formdetail">	 
			<div class="col-xs-12 subequip">
				<span class = "text-primary"> <em> Comments  </em>  </span>
			</div>
		</div>  
		<div class ="row formdetail">
			<div class="col-xs-12 equip">
				 {!! nl2br($task->maintenance->pool_comments) !!}
			</div>
		</div>
	@endif 
	 

</body>	
</html>