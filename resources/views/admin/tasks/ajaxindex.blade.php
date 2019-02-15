<td class = "text-center"> 
	@if(isset($task->client_data)) 
		{!! $task->client_data->first_name !!} {!! $task->client_data->last_name !!}
	@endif
</td>
<td class = "text-center"> 
	@if(isset($task->worker_data)) 
		@if($task->sign)
			<span class = "text-danger"> <em> {!! $task->worker_data->first_name !!} {!! $task->worker_data->last_name !!} </em> </span>
		@else
			<span> {!! $task->worker_data->first_name !!} {!! $task->worker_data->last_name !!} </span>
		@endif 
	@endif
</td>
<td>
	@if($task->type == "0")
		Maintenance
	@else
		Service
	@endif
</td> 
<td> {!! $task->date !!}  </td> 
<td class = "text-center">  
	@if($task->status == "0")
		<span class="label label-danger"> Uncompleted </span>
	@else
		<span class="label label-primary"> Completed    </span>
	@endif    
</td>
<td>
	<div class="btn-group btn-group-sm"> 
		<a  href = "#" class="btn btn-warning viewinfo @if($task->type == '0') maintenance @else service @endif" data-id = "{!! $task->id !!}"><i class="fa  fa-eye"></i></a> 
		@if($task->type == "0")
			<a  href = "{!! route('adminmaintenancesdelete', $task->id) !!}" class="btn btn-danger"><i class="fa  fa-times"></i></a>
		@else
			<a  href = "{!! route('adminservicesdelete', $task->id) !!}" class="btn btn-danger"><i class="fa  fa-times"></i></a>
		@endif
	</div>
</td>							  				 
 
 