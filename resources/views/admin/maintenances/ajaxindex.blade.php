<?php
	$available_weeks = ['MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY'];
?> 
<style>
	.tasktd{
		cursor: pointer; 
	} 
	.full{
		width: 100%;
	}
	.partial{
		width: 70%;
	}
	.main{ 
		float: left;
		height: 100%; 
		padding: 5px;
	} 
	.right{
		width: 30%;
		float: left;
		height: 100%;
		background-color: #ff0;
		text-align: center;
		padding: 5px;
	} 
	tbody td{
		padding : 0px !important;
	}
	.taskblank{
		height: 33.5px;
	}
</style> 
<div class="table-responsive">
	<table class="table table-bordered table-hover table-vcenter">
		<thead>
			<tr>
				<th>  </th>
				@for($i = 0; $i < $maintenanceweek->week; $i++)
					<th class = "text-center"> {!! $available_weeks[$i] !!} </th>   
				@endfor
			</tr>
		</thead>  
		<tbody>
			@for($i = 0; $i < $maintenanceweek->rows; $i++)
			 <tr> 
				<td class = "text-center">  {!! $i + 1 !!}  </td>    
				@for($j = 0; $j < $maintenanceweek->week; $j++) 
					@if(count($current_tasks[$j]) > $i) 
						<td class = "tasktd taskavailable"  @if(Auth::user()->usertype == "20")   data-url = "{!! route('adminmaintenancesupdate', $current_tasks[$j][$i]->id) !!}"  @else  data-url = "{!! route('employeemaintenancesupdate', $current_tasks[$j][$i]->id) !!}"    @endif  data-id = "{!!  $current_tasks[$j][$i]->id !!}"  data-date = "{!! $available_days[$j] !!}">
							@if($current_tasks[$j][$i]->signcolor)
								<div  class = "main partial"  style = "background-color: {!! $current_tasks[$j][$i]->color !!}; color: #000;">
									{!! $current_tasks[$j][$i]->first_name !!}  {!! $current_tasks[$j][$i]->last_name !!}     
									@if($current_tasks[$j][$i]->newsign == 1)<span class="pull-right badge badge-info">New</span> @endif
								</div>
								<div class = "right" style = "background-color: {!! $current_tasks[$j][$i]->signcolor->color !!}; color: #000;">
									{!!  $current_tasks[$j][$i]->signcolor->title   !!}
								</div>
							@else 
								<div  class = "main full " style = "background-color: {!! $current_tasks[$j][$i]->color !!}; color: #000;">
									{!! $current_tasks[$j][$i]->first_name !!}  {!! $current_tasks[$j][$i]->last_name !!}  
										@if($current_tasks[$j][$i]->newsign == 1)<span class="pull-right badge badge-info">New</span> @endif  
								</div> 
							@endif							
  					     </td>
					@else
						<td class = "tasktd taskblank" data-date = "{!! $available_days[$j] !!}"> 
							<div  class = "main full"></div> 
					    </td>
					@endif
				@endfor  
			 </tr> 	
			 @endfor	 
		</tbody>
	</table>  
</div>     

