<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Service;
use App\User;
use Auth, Validator;
use Illuminate\Support\Facades\Input;
class TaskController extends Controller
{ 
	public function index(Request $request){
		$tasks_obj = Task::where('tasks.deleted', '0')
						 ->leftJoin('users', 'users.id', 'tasks.client')
						 ->whereIn('tasks.type', array('0', '1'))
						 ->select('tasks.*');  
		switch($request->sort){
			case 'first_name':
				$tasks_obj	= $tasks_obj->orderBy('users.first_name');
				$tasks_obj	= $tasks_obj->orderBy('tasks.date', 'desc');
				$tasks_obj	= $tasks_obj->orderBy('tasks.id', 'desc');
				break;
			case 'last_name':
				$tasks_obj	= $tasks_obj->orderBy('users.last_name');
				$tasks_obj	= $tasks_obj->orderBy('tasks.date', 'desc');
				$tasks_obj	= $tasks_obj->orderBy('tasks.id', 'desc');
				break;
			case 'last_name':
				$tasks_obj	= $tasks_obj->orderBy('tasks.type');
				$tasks_obj	= $tasks_obj->orderBy('tasks.date', 'desc');
				$tasks_obj	= $tasks_obj->orderBy('tasks.id', 'desc');
				break;
			case 'date':
				$tasks_obj	= $tasks_obj->orderBy('tasks.date', 'desc');
				$tasks_obj	= $tasks_obj->orderBy('tasks.id', 'desc');
				break;
			default:
				$tasks_obj	= $tasks_obj->orderBy('users.first_name');
				$tasks_obj	= $tasks_obj->orderBy('tasks.date', 'desc');
				$tasks_obj	= $tasks_obj->orderBy('tasks.id', 'desc');
				break;
		}
		
		
		if($request->key){
			$key =  "%" . $request->key . "%";
			$tasks_obj	= $tasks_obj->where(function ($query) use($key) {
								$query->where('users.first_name', 'like', $key)
									->orWhere('users.last_name',  'like', $key) 
									->orWhere('users.address', 'like', $key);
							});
		}
		 
		$tasks = $tasks_obj->paginate(15); 
		foreach($tasks as $task){
			$task->client_data = User::where('id', $task->client)->first();
			$task->worker_data = User::where('id', $task->employee)->first(); 
		}
		return view('admin.tasks.index',  ['tasks' => $tasks->appends(Input::except('page'))]);
	}  
	public function taskdetail(Request $request){ 
		if($request->value === null)
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200);  
		$task = Task::where('deleted', '0')->where('id', $request->value)->first();; 
		if(!isset($task))
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200);
		
		$task->client_data = User::where('id', $task->client)->first();
		$task->worker_data = User::where('id', $task->employee)->first(); 
		
		if($task->type == '0'){ // maintenace
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200);  
		}
		else{
			$task->service     = Service::where('task_id', $task->id)->first(); 
			if(!isset($task->service))
				return  response()->json(array('msg'=> "fail",  'status'=> 0), 200); 
			$return_html =  view('admin/services/formdetail', compact('task'))->render();
			return  response()->json(array('msg'=> "success", 'html' => $return_html  , 'status'=> 1), 200);
		} 
	}
}
