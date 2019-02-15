<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Service;
use App\User;
use Validator, Auth;
use Illuminate\Support\Facades\Input;
use App\Models\EmployeeService;
class ServiceController extends Controller
{
	public function index(Request $request){
		$tasks_obj = Task::where('tasks.deleted', '0')
						 ->where('tasks.type', '1')
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
									->orWhere('users.address', 'like', $key)
									->orWhere('users.email', 'like', $key);
							});
		} 
		
		$tasks = $tasks_obj->paginate(15);  
		foreach($tasks as $task){
			$task->client_data = User::where('id', $task->client)->first();
			$task->worker_data = User::where('id', $task->employee)->first(); 
		} 
		return view('admin.services.index', ['tasks' => $tasks->appends(Input::except('page'))]);  
	}  
	public function create(Request $request){ 
		if($request->isMethod('post')){
			$validator  =  Validator::make($request->all(), [
				'client'        => 'required',
				'employee'      => 'required',
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
				'employee' 			=> $request->employee,
				'type' 		    	=> '1', 
			]); 
			Service::create([
					'task_id'  			=> $task->id,
					'complited' 		=> $request->complited,
					'billed' 		    => $request->billed, 
					'job_description'  	=> $request->job_description,
					'comments'  		=> $request->comments,
					'instructions'  	=> $request->instructions 
			]);
			return redirect()->route('adminservices')->with('message', "New Service is created successfully.");
		}
		$data = array(); 
		$data['clients']   = User::where('deleted', 0)->where('usertype', '0')->get();
		$data['employees'] = User::where('deleted', 0)->where('usertype', '10')->get();
		return view('admin.services.create', $data);
	} 
	public function update(Request $request, $id){
		$task = Task::where('id', $id)->where('deleted', '0')->where('tasks.type', '1')->where('status', '0')->first();
		if(!isset($task))
			return view('errors.404'); 
		$service = Service::where('task_id', $task->id)->first(); 
		if(!isset($service))
			return view('errors.404');
		
		$task->sign = 0; 
		$task->save();
		
		if($request->isMethod('post')){
			$validator  =  Validator::make($request->all(), [
				'client'        => 'required',
				'employee'      => 'required',
				'date'          => 'required',
				'time'    		=> 'required',  
			]); 
			if($validator->fails()){
				$messages =$validator->messages();     
				return redirect()->back()->withInput()->withErrors($messages);
			} 
			$datetime = date('Y-m-d H:i:s', strtotime($request->date . ' ' . $request->time));
			$datetime_array = explode(' ', $datetime);
			$task->update(
				[
					'date' 				=> $datetime_array[0],
					'time' 				=> $datetime_array[1],
					'client' 			=> $request->client,
					'employee' 			=> $request->employee,
					'type' 		    	=> '1', 
				]);
			 
			$service->update([
					'task_id'  			=> $task->id,
					'complited' 		=> $request->complited,
					'billed' 		    => $request->billed, 
					'job_description'  	=> $request->job_description,
					'comments'  		=> $request->comments,
					'instructions'  	=> $request->instructions 
			]); 
			return redirect()->route('adminservices')->with('message', "The service is created successfully."); 
		}
		$data = array();
		$data['task']  				= $task;
		$data['service']  			= $service;  
		$data['clients']   = User::where('deleted', 0)->where('usertype', '0')->get();
		$data['employees'] = User::where('deleted', 0)->where('usertype', '10')->get();
		return view('admin.services.update', $data);
	}
	public function delete(Request $request, $id){
		$task = Task::where('id', $id)->where('deleted', '0')->where('tasks.type', '1')->first(); 
		if(!isset($task))
			return view('errors.404'); 
		$task->deleted = 1; 
		$task->save();
		return redirect()->back()->with('message', "The service is deleted successfully.");
	}
	public function detail(Request $request){
		if($request->value === null)
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200); 
		$task = Task::where('id', $request->value)
					->where('deleted', '0')
					->where('type', '1')
					->first();
		if(!isset($task))
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200);
		$data  = array();  
		$task->client_data = User::where('id', $task->client)->first();
		$task->worker_data = User::where('id', $task->employee)->first(); 
		$task->service     = Service::where('task_id', $task->id)->first(); 
		if(!isset($task->service))
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200);  
		
		$task->employeeservice  = EmployeeService::where('deleted', 0)
													  ->where('service_id', $task->id)
													  ->get(); 
		$gallery = 0;
		if(count($task->employeeservice))
			$gallery = count($task->employeeservice);
		
		$data['html'] =  view('admin/services/formdetail', compact('task'))->render(); 
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
		$data['gallery'] 	= $gallery;
		$data['change_tr']  = $change_tr;
		$data['msg']  = "success";
		$data['status']  = 1;
		return  response()->json($data, 200);
	}
}
