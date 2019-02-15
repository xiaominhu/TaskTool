<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Service;
use App\User;
use Mail, Validator, Auth, PDF, App;
use Illuminate\Support\Facades\Input;
use App\Helpers\Mainhelper;
use App\Models\EmployeeService;

class ServiceController extends Controller
{ 
    public function index(Request $request){ 
		$tasks_obj = Task::where('tasks.deleted', '0')
						 ->where('tasks.type', '1')
						 ->leftJoin('users', 'users.id', 'tasks.client')
						 ->where('employee', Auth::user()->id)
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
		return view('employee.services.index', ['tasks' => $tasks->appends(Input::except('page'))]);  
	} 
	 
	public function update(Request $request, $id){
		$task = Task::where('tasks.id', $id)
					->where('employee', Auth::user()->id)
					->where('tasks.deleted', '0')
					->where('tasks.status', '0')
					->leftJoin('users', 'users.id' ,'tasks.client')
					->select('tasks.*', 'users.first_name', 'users.last_name', 'users.phone', 'users.company', 'users.address', 'users.email')
					->first(); 
		if(!isset($task))
			return view('errors.404'); 
		$service = Service::where('task_id', $task->id)->first(); 
		if(!isset($service))
			return view('errors.404');  
		
		
		if($request->isMethod('post')){ 
			/*if($request->savesend)
			{  
			
				$validator  =  Validator::make($request->all(), [
					'job_description'   => 'required',
					'complited'      	=> 'required',
					'comments'          => 'required',
					'instructions'      => 'required',
					'billed'      		=> 'required',
				]); 
				
				if($validator->fails()){
					$messages =$validator->messages();     
					return redirect()->back()->withInput()->withErrors($messages);
				}
				
			} */      
		
			 
			$service->update([   
					'complited' 		=> $request->complited,
					'billed' 		    => $request->billed, 
					//'job_description'  	=> $request->job_description,
					'comments'  		=> $request->comments,
					'instructions'  	=> $request->instructions
			]);  	
			Task::where('id', $task->id)->update([
				'sign'  => '1'
			]);
			 
			$task->worker_data = User::where('id', $task->employee)->first(); 
			$task->service     = Service::where('task_id', $task->id)->first();  
			$datal = array();
			$datal['worker_name'] = $task->worker_data->first_name . ' ' . $task->worker_data->last_name;
			$datal['type'] 		  = $task->type;
			
			
			EmployeeService::where('service_id', $task->id)->update([
					'deleted' => '1'
			]);			
			if($request->uploadedfiles){
				$uploadedfiles = $request->uploadedfiles;
				$uploadedfiles_array = explode(",", $uploadedfiles);
				foreach($uploadedfiles_array as $item){
					EmployeeService::updateOrCreate(
						[
							'service_id' => $task->id,
							'name'    => $item
						],
						[
							'deleted' => '0'
						]
					); 
				}
			}
			 
			if($request->savesend)
			{   
				Task::where('id', $task->id)->update([
					'status'  => '1'
				]); 
				$pdf = PDF::loadView('employee.services.pdfformdetail', compact('task'));  
				$pdf->save(storage_path("app/public/service.pdf")); 
				$task->client_data = User::where('id', $task->client)->first(); 
							
				Mail::send(['html'=>'mail'], $datal, function($message) use($task){ 
					$message->to($task->client_data->email, $task->client_data->first_name . ' ' . $task->client_data->last_name)->subject("Service Update");
					$message->from(Auth::user()->email,  Auth::user()->first_name . ' ' . Auth::user()->last_name);  
					$ccs = Mainhelper::getAdmin();
					if(count($ccs)){
						$message->cc($ccs);                                         
					}  
					$message->attach(storage_path("app/public/service.pdf"), [
									'as' =>  "service.pdf",
					]); 
				}); 
					 
				return redirect()->route('employeeservices')->with('message', "The service is sent successfully."); 
			}
			else{ 
				$pdf = PDF::loadView('employee.services.pdfformdetailsave', compact('task'));  
				$pdf->save(storage_path("app/public/service.pdf")); 
				$ccs = Mainhelper::getAdmin(); 
				Mail::send(['html'=>'mail'], $datal, function($message) use($task, $ccs){  
					$message->from(Auth::user()->email,  Auth::user()->first_name . ' ' . Auth::user()->last_name);  
					$admin_data = User::where('email', $ccs[0])->first();
					$message->to($admin_data->email, $admin_data->first_name . ' ' . $admin_data->last_name)->subject("Service Update"); 
					if(count($ccs) > 1){
						$newccs = array();
						for($i = 1; $i < count($ccs); $i++){
							$newccs = $ccs[$i];
						}
						$message->cc($newccs);                                         
					} 
					$message->attach(storage_path("app/public/service.pdf"), [
									'as' =>  "service.pdf",
					]);  
				}); 
			} 
			return redirect()->route('employeeservices')->with('message', "The service is updated successfully."); 
		}
		 
		$data = array();
		$data['task']  				= $task;
		$service->employeeservice  = EmployeeService::where('deleted', 0)
													  ->where('service_id', $task->id)
													  ->get();
		$data['service']  			= $service;
		return view('employee.services.update', $data);
	}
	
	public function detail(Request $request){
		if($request->value === null)
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200); 
		$task = Task::where('id', $request->value)
					->where('deleted', '0')
					->where('type', '1')
					->where('employee', Auth::user()->id)
					->first();
		if(!isset($task))
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200);
		
		$task->client_data = User::where('id', $task->client)->first(); 
		$task->service     = Service::where('task_id', $task->id)->first(); 
		if(!isset($task->service))
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200);  
		
		$task->employeeservice  = EmployeeService::where('deleted', 0)
													  ->where('service_id', $task->id)
													  ->get();
		$gallery = 0;
		if(count($task->employeeservice))
			$gallery = count($task->employeeservice); 
		$return_html =  view('employee/services/formdetail', compact('task'))->render();  
		return  response()->json(array('msg'=> "success", 'gallery' => $gallery ,'html' => $return_html  , 'status'=> 1), 200);
	}
	
	public function uploadimage(Request $request){  
		$validator = Validator::make($request->all(),
						[ 
							'file'  => 'required|image|mimes:jpeg,bmp,png', 
						]
				     )->validate();
		if ($request->hasFile('file')) {
			$image=$request->file('file');
			$imageName=$image->getClientOriginalName();
			$imageName = time() . $imageName; 
			$image->move('images/service',$imageName);
			echo $imageName; 
		}
	} 
}
