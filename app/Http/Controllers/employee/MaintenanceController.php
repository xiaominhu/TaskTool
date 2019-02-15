<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use App\Models\MaintenanceCheck;
use App\Models\Maintenancesign;
use App\Models\MaintenanceWeek;
use App\Models\Task;
use App\User;
use Mail, PDF, Validator, Auth;
use Carbon\Carbon;
use App\Helpers\Mainhelper;
class MaintenanceController extends Controller
{
	public function posttable(Request $request){  
		$firstday = Carbon::now()->startOfWeek(); 
		$maintenanceweek = MaintenanceWeek::where('employee', Auth::user()->id) 
										  ->first();
		if(!isset($maintenanceweek)){
			return  response()->json(array('msg'=> "Maintenance Table is not exist.",  'status'=> 0), 200); 
		}
		$data = array();
		$data['maintenanceweek'] = $maintenanceweek; 
		$available_days = array();
		$current_tasks  = array();
		for($i = 0; $i < $maintenanceweek->week; $i++){
			$available_days[] = $firstday->toDateString(); 
			$thisdaytasks = Task::where('tasks.date', $firstday->toDateString())
								->where('tasks.employee', Auth::user()->id)
								->where('tasks.type', '0') 
								->Join('users', 'users.id', 'tasks.client')
								->Join('maintenance', 'maintenance.task_id', 'tasks.id')
								->select('tasks.*', 'users.first_name', 'users.last_name', 'users.color', 'maintenance.sign')
								->orderBy('tasks.client')
								->orderBy('tasks.id', 'desc')
								->get();
			foreach($thisdaytasks as $item){
				if($item->sign){
					$item->signcolor = Maintenancesign::where('id', $item->sign)->first(); 
				}
			}
			
			$current_tasks[] = $thisdaytasks; 
			$firstday->addDay();
		}
		$data['available_days'] = $available_days;		
		$data['current_tasks'] 	= $current_tasks;	 
		$return_html =  view('admin/maintenances/ajaxindex', $data)->render();  
		return  response()->json(array('msg'=> "success", 'html' => $return_html ,'status'=> 1), 200); 
	} 
	public function index(Request $request){
		$tasks = Task::where('deleted', '0')
					 ->where('type', '0')
					  ->where('employee', Auth::user()->id)
					 ->paginate(15); 
		foreach($tasks as $task){
			$task->client_data = User::where('id', $task->client)->first(); 
		}
		return view('employee.home', compact('tasks'));
	}  
	public function update(Request $request, $id){ 
		$task = Task::where('tasks.id', $id)
					->where('employee', Auth::user()->id)
					->where('tasks.deleted', '0')
					//->where('tasks.status', '0')
					->leftJoin('users', 'users.id' ,'tasks.client')
					->select('tasks.*', 'users.first_name', 'users.last_name', 'users.phone', 'users.company', 'users.address', 'users.email')
					->first();  
		if(!isset($task))
			return view('errors.404'); 
		 
		$maintenance = Maintenance::where('task_id', $task->id)->first(); 
		if(!isset($maintenance))
			return view('errors.404');
		$maintenancechecks = MaintenanceCheck::where('task_id', $task->id)->get(); 
		if($request->isMethod('post')){
			/*if($request->savesend)
			{  
				$validator  =  Validator::make($request->all(), [  
					'chlorine_action_taken'   			=> 'required',
					'ph_action_taken'      				=> 'required',
					'total_alkalinity_action_taken'     => 'required',
					'stabilizer_action_taken'      		=> 'required',
					'salt_action_taken'      			=> 'required',
					'other_action_taken'      			=> 'required', 
					'chlorine'      					=> 'required',
					'ph'      							=> 'required',
					'total_alkalinity'      			=> 'required',
					'stabilizer'      					=> 'required',
					'salt'      						=> 'required',
					'other'      						=> 'required',
					'chlorine_action_taken'      		=> 'required',  
					//'serviced_comments'      			=> 'required',
					//'pool_comments'      				=> 'required', 
					//'equipment'      				=> 'required',
					//'poolowner'      				=> 'required', 
				]);  
				if($validator->fails()){
					$messages =$validator->messages();     
					return redirect()->back()->withInput()->withErrors($messages);
				}
			}  */
			$maintenance->update([
				'task_id'  => $task->id,
				'chlorine' 							=> $request->chlorine,
				'ph' 		    					=> $request->ph,
				'total_alkalinity'  				=> $request->total_alkalinity,
				'stabilizer'  						=> $request->stabilizer,
				'salt'  							=> $request->salt,
				'other'  							=> $request->other, 
				'chlorine_action_taken'      		=> $request->chlorine_action_taken,
				'ph_action_taken'     		 		=> $request->ph_action_taken,
				'total_alkalinity_action_taken'  	=> $request->total_alkalinity_action_taken,
				'stabilizer_action_taken'  			=> $request->stabilizer_action_taken,
				'salt_action_taken'  				=> $request->salt_action_taken,
				'other_action_taken'  				=> $request->other_action_taken,  
				'serviced_comments'  				=> $request->serviced_comments, 
				'pool_comments'  					=> $request->pool_comments, 
			]);  
			MaintenanceCheck::where('task_id', $task->id)->update(['deleted' => '1']);  
			if($request->equipment){
				foreach($request->equipment as $item){
					MaintenanceCheck::updateOrCreate(
					[
						'task_id'  		    =>  $task->id, 
						'property'  		=>  'equipment',
						'property_value'    =>   $item,
					],
					[
						'deleted'  =>  0
					]);
				}
			}
			if($request->poolowner){
				 foreach($request->poolowner as $item){
					MaintenanceCheck::updateOrCreate(
					[
						'task_id'  		    =>  $task->id, 
						'property'  		=>  'poolowner',
						'property_value'    =>   $item,
					],
					[
						'deleted'  =>  0
					]);
				}
			} 
			Task::where('id', $task->id)->update([
				'sign'  => '1'
			]); 
			if($request->savesend)
			{  
				Task::where('id', $task->id)->update([
					'status'  => '1'
				]);
				$task->maintenance = Maintenance::where('task_id', $task->id)->first(); 
				$task->worker_data = User::where('id', $task->employee)->first(); 
				$equipment_array = array();
				$poolowner_array = array(); 
				foreach($maintenancechecks as $item){
					if($item->property == "equipment")
						$equipment_array[] = $item->property_value;
					else
						$poolowner_array[] = $item->property_value;
				} 
				$task->equipment_array  	= $equipment_array;
				$task->poolowner_array  	= $poolowner_array;  
				$pdf = PDF::loadView('employee.maintenances.pdfformdetail', compact('task'));  
				$pdf->save(storage_path("app/public/maintenance.pdf")); 
				$datal = array(); 
				$datal['worker_name'] = $task->worker_data->first_name . ' ' . $task->worker_data->last_name;
				$datal['type'] 		  = $task->type;   
				$task->client_data = User::where('id', $task->client)->first();  
				Mail::send(['html'=>'mail'], $datal, function($message) use($task){
					$message->to($task->client_data->email, $task->client_data->first_name . ' ' . $task->client_data->last_name)->subject("Maintenance Update");
					
					$ccs = Mainhelper::getAdmin();
					if(count($ccs)){
						$message->cc($ccs);                                         
					} 
					
					$message->from(Auth::user()->email,  Auth::user()->first_name . ' ' . Auth::user()->last_name); 
					$message->attach(storage_path("app/public/maintenance.pdf"), [
							'as' =>  "maintenance.pdf",
					]); 
				});  
				return redirect()->route('employeemaintenances')->with('message', "The maintenance is sent successfully."); 
			}
			return redirect()->route('employeemaintenances')->with('message', "The maintenance is saved successfully."); 
		}
		
		
		$data = array();
		$data['task']  					= $task;
		$data['maintenance']  			= $maintenance; 
		$equipment_array = array();
		$poolowner_array = array();
		foreach($maintenancechecks as $item){
			if($item->property == "equipment")
				$equipment_array[] = $item->property_value;
			else
				$poolowner_array[] = $item->property_value;
		}
		$data['equipment_array']  	= $equipment_array;
		$data['poolowner_array']  	= $poolowner_array; 
		$data['clients']   = User::where('deleted', 0)->where('usertype', '0')->get(); 
		return view('employee.maintenances.update', $data);
	}
}
