<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Task;
use App\Models\Additional;
use App\User;
use Validator, Auth;
use Illuminate\Support\Facades\Input;

class AdditionalController extends Controller
{ 
	public function index(Request $request){
		$tasks_obj = Task::where('tasks.deleted', '0')
						 ->where('tasks.type', '2')
						 ->Join('users', 'users.id', 'tasks.client')
						 ->where('users.deleted', 0)
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
		} 
		return view('employee.additionals.index', ['tasks' => $tasks->appends(Input::except('page'))]);  
	}  
	public function create(Request $request){ 
		if($request->isMethod('post')){
			$validator  =  Validator::make($request->all(), [
				'client'        => 'required',
				'date'          => 'required',
				'time'    		=> 'required',  
			]); 
			if($validator->fails()){
				$messages =$validator->messages();     
				return redirect()->back()->withInput()->withErrors($messages);
			}
			
			$datetime = date('Y-m-d H:i:s', strtotime($request->date . ' ' . $request->time));
			$datetime_array = explode(' ', $datetime); 
			$task = Task::create(
			[
				'date' 				=> $datetime_array[0],
				'time' 				=> $datetime_array[1],
				'client' 			=> $request->client,
				'employee' 			=> Auth::user()->id,
				'type' 		    	=> '2', 
				'sign'  			=> '1' 
			]); 
			Additional::create([
					'task_id'  			=> $task->id,  
					'job_description'  	=> $request->job_description,
					'comments'  		=> $request->comments  
			]);
			return redirect()->route('employeeadditionals')->with('message', "New Additional Job is created successfully.");
		}
		$data = array(); 
		$data['clients']   = User::where('deleted', 0)->where('usertype', '0')->get(); 
		return view('employee.additionals.create', $data);
	} 
	public function delete(Request $request, $id){
		$task = Task::where('id', $id)->where('deleted', '0')->where('tasks.type', '2')->first(); 
		if(!isset($task))
			return view('errors.404'); 
		$task->deleted = 1; 
		$task->save();  
		return redirect()->back()->with('message', "The addtional job is deleted successfully.");
	}
	public function detail(Request $request){
		if($request->value === null)
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200); 
		$task = Task::where('id', $request->value)
					->where('deleted', '0')
					->where('type', '2')
					->first();      
		if(!isset($task)) 
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200);
		$data  = array();  
		$task->client_data 	= User::where('id', $task->client)->first(); 
		$task->additional   = Additional::where('task_id', $task->id)->first(); 
		if(!isset($task->additional))
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200);  
		$data['html'] =  view('employee/additionals/formdetail', compact('task'))->render(); /*
		$change_tr = 0;
		if($task->sign){ 
			Task::find($request->value)
			->update(
			[
				'sign' => 0, 
			]); 
			$task->sign = 0;
			$change_tr = 1;
			if($request->type != null)
				$data['change_tr_html'] =  view('admin/tasks/ajaxindex', compact('task'))->render(); 
			else
				$data['change_tr_html'] =  view('admin/services/ajaxindex', compact('task'))->render(); 
		}
		$data['change_tr'] = $change_tr;*/
		$data['msg']  = "success"; 
		$data['status']  = 1;
		return  response()->json($data, 200); 
	}
	
}
