<td class = "text-center"> 
	@if(isset($task->client_data)) 
		{!! $task->client_data->first_name !!} {!! $task->client_data->last_name !!}
	@endif
</td>
<td class = "text-center">  
	  {!! $task->client_data->address !!} 
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
<td class = "text-center"> 
	@if(isset($task->worker_data))  
		<span> {!! $task->worker_data->phone !!}   </span> 
	@endif
</td> 
<td> {!! $task->date !!}  </td>  
<td>
	<div class="btn-group btn-group-sm">  
		<a  href = "#" class="btn btn-warning viewinfo" data-id = "{!! $task->id !!}"><i class="fa  fa-eye"></i></a>
		<a  href = "javascript: void(0)" data-url = "{!! route('adminadditionalsdelete', $task->id) !!}" class="btn btn-danger deleteaction"><i class="fa  fa-times"></i></a>
	</div> 
</td>