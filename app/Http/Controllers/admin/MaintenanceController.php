<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use App\Models\MaintenanceCheck;
use App\Models\MaintenanceWeek;
use App\Models\Maintenancesign;
use App\Models\Task;
use App\User;
use Validator, Auth, Session;
use Carbon\Carbon;

class MaintenanceController extends Controller
{  
	public function addnewrow(Request $request){
		if($request->value === null)
			return  response()->json(array('msg'=> "The Employee id is omitted.",  'status'=> 0), 200); 
		$firstday = Carbon::now()->startOfWeek(); 
		$maintenanceweek = MaintenanceWeek::where('employee', $request->value)
										  ->where('start_date', $firstday->toDateString())
										  ->first();  
		if(!isset($maintenanceweek)){
			return  response()->json(array('msg'=> "Maintenance Table is not exist.",  'status'=> 0), 200); 
		} 
		$maintenanceweek->rows = $maintenanceweek->rows + 1;
		$maintenanceweek->save(); 
		return  response()->json(array('msg'=> "success",  'status'=> 1), 200); 
	}
	public function deleterow(Request $request){
		if($request->value === null)
			return  response()->json(array('msg'=> "The Employee id is omitted.",  'status'=> 0), 200); 
		$firstday = Carbon::now()->startOfWeek(); 
		$maintenanceweek = MaintenanceWeek::where('employee', $request->value)
										  ->where('start_date', $firstday->toDateString())
										  ->first();  
		if(!isset($maintenanceweek)){
			return  response()->json(array('msg'=> "Maintenance Table is not exist.",  'status'=> 0), 200); 
		}
		if($maintenanceweek->rows > 1){
			$maintenanceweek->rows = $maintenanceweek->rows - 1;
			$maintenanceweek->save();
			return  response()->json(array('msg'=> "success",  'status'=> 1), 200); 
		}
		else{
			return  response()->json(array('msg'=> "Cannot remove the row anymoreo.",  'status'=> 0), 200); 
		} 
	}
	public function posttable(Request $request){ 
		if($request->value === null)
			return  response()->json(array('msg'=> "The Employee id is omitted.",  'status'=> 0), 200); 
		
		$firstday = Carbon::now()->startOfWeek(); 
		$maintenanceweek = MaintenanceWeek::where('employee', $request->value) 
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
								->where('tasks.employee', $request->value)
								->where('tasks.type', '0')
								->leftJoin('users', 'users.id', 'tasks.client')
								->leftJoin('maintenance', 'maintenance.task_id', 'tasks.id')
								->select('tasks.*', 'users.first_name', 'users.last_name', 'users.color', 'maintenance.sign', 'tasks.sign as newsign')
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
		if($request->employee != null){
			$user = User::where('id', $request->employee)->where('deleted', 0)->first();
			if(!isset($user))
				return view('errors.404');
			Session::flash('maintenanceemployee', $request->employee); 
			return redirect()->route('adminmaintenances');
		}
		$firstday = Carbon::now()->startOfWeek()->toDateString();  
		$data = array();
		$data['employees'] = User::where('deleted', 0)
								->where('usertype', '10')
								->Join('maintenance_week', 'maintenance_week.employee', 'users.id')
								->select('users.*') 
								->get(); 
 
		$firstday = Carbon::now()->startOfWeek()->toDateString();  
		$data['total_employees']  = User::where('deleted', 0)
							->where('usertype', '10') 
							->count();   
		return view('admin.maintenances.index', $data);
	}
	public function createtable(Request $request){
		if($request->isMethod('post')){
			$validator  =  Validator::make($request->all(), [
				'week'        	=> 'required',
				'employee'      => 'required',
				'rows'          => 'required'
			]);
			if($validator->fails()){
				$messages   =   $validator->messages();     
				return redirect()->back()->withInput()->withErrors($messages);
			} 
			$firstday = Carbon::now()->startOfWeek()->toDateString();  
				
			if(MaintenanceWeek::checkDateEnable($request->employee , $firstday)){
				Session::flash('maintenanceweek', "This Employee already have maintenance table this week."); 
				return redirect()->back()->withInput()->withErrors($validator);
			}
			 
			$task = MaintenanceWeek::create(
					[ 
						'week' 			    => $request->week,
						'employee' 			=> $request->employee,
						'rows' 		    	=> $request->rows,
						'start_date' 		=> $firstday,
					]); 
			return redirect()->route('adminmaintenances')->with('message', "New Maintenance Table is created successfully."); 
		}
		
		$data = array();  
		$employees = User::where('deleted', 0)
							->where('usertype', '10')
							->Join('maintenance_week', 'maintenance_week.employee', 'users.id')
							->select('users.*') 
							->get(); 
		$current_employee = array();					
		foreach($employees as $employee){
			$current_employee[] = $employee->id;			
		} 
		$data['employees'] = User::where('deleted', 0)->where('usertype', '10')->whereNotIn('id', $current_employee)->get();
		return view('admin.maintenances.createtable', $data); 
	} 
	public function addsign(Request $request){ 
		$validator  =  Validator::make($request->all(), [
				'color'      => 'required|unique:maintenancesign',
				'title'      => 'required', 
		]); 
		if($validator->fails()){
			return  response()->json(array('msg'=> "Please fill in the required field.",  'status'=> 0), 200);  
		} 
		
		$newmaintenance = Maintenancesign::create([
							'color'  => $request->color,
							'title'  => $request->title
						]); 
		$return_html = "";
		$maintenances = Maintenancesign::get();
		foreach($maintenances as $maintenance){
			if($newmaintenance->id == $maintenance->id)
				$return_html .= "<option value '" .  $maintenance->id ."' selected>" . $maintenance->title . "</option>";
			else
				$return_html .= "<option value '" .  $maintenance->id ."'>" . $maintenance->title . "</option>";
		}
		 
		return  response()->json(array('msg'=> "success", 'html' => $return_html ,'status'=> 1), 200); 
	}
	public function create(Request $request){ 
		if (\DateTime::createFromFormat('Y-m-d',  $request->date) === FALSE) {
			return view('error.404');
		}   
		$maintenanceweek = MaintenanceWeek::where('employee', $request->employee) 
										  ->first(); 
		if(!isset($maintenanceweek))
			return view('error.404'); 
		if($request->isMethod('post')){  
			$validator  =  Validator::make($request->all(), [
				'client'        => 'required',
				'employee'      => 'required',
				'new_date'      => 'required',
				'time'    		=> 'required',  
			]); 
			if($validator->fails()){
				$messages =$validator->messages();   
				return redirect()->back()->withInput()->withErrors($messages);
			} 
			/************  Check the date is over *****************/ 
			$dt =  Carbon::now()->startOfWeek();  
			$flag = 1; 
			for($i = 0; $i < $maintenanceweek->week; $i++){ 
				echo $dt->toDateString() . '<br>';
				if($request->new_date == $dt->toDateString()){
					$flag = 0;
					break;
				} 
				$dt->addDay();
			}

			if($flag){
				Session::flash('maintenanceweekupdate', "Cannot set this date beacause out of date."); 
				$messages =$validator->messages();     
				return redirect()->back()->withInput()->withErrors($messages);
			}
			
			/*******************************************************/	 
			$datetime = date('Y-m-d H:i:s', strtotime($request->new_date . ' ' . $request->time));
			$datetime_array = explode(' ', $datetime); 
			$task = Task::create(
					[
						'date' 					=> $datetime_array[0],
						'time' 					=> $datetime_array[1],
						'client' 				=> $request->client,
						'employee' 				=> $request->employee,
						'type' 		    		=> '0', 
						'maintenance_week_id'  	=> $maintenanceweek ->id
					]); 
			Maintenance::create([
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
					'sign'  							=> $request->sign
			]); 
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
			return redirect()->route('adminmaintenances', ['employee' => $request->employee])->with('message', "New Maintenance is created successfully.");
		} 
		$data = array(); 
		$data['clients']   = User::where('deleted', 0)->where('usertype', '0')->get();
		$data['employees'] = User::where('deleted', 0)->where('usertype', '10')->where('id', $request->employee)->first();
		$data['maintenanceweek'] = $maintenanceweek; 
		$data['maintenancesigns'] = Maintenancesign::get(); 
		return view('admin.maintenances.create', $data);
	}
	public function update(Request $request, $id){
		$task = Task::where('id', $id)->where('deleted', '0')->first();
		if(!isset($task))
			return view('errors.404');  
		$maintenanceweek = MaintenanceWeek::find($task->maintenance_week_id);
		if(!isset($maintenanceweek))
			return view('errors.404');   
		$maintenance = Maintenance::where('task_id', $task->id)->first();
		$maintenancechecks = MaintenanceCheck::where('task_id', $task->id)->where('deleted', '0')->get(); 
		if(!isset($maintenance))
			return view('errors.404');
		
		$task->sign = 0; 
		$task->save();
		
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
			/************  Check the date is over *****************/ 
			$dt =  Carbon::now()->startOfWeek();  
			$flag = 1; 
			for($i = 0; $i < $maintenanceweek->week; $i++){ 
				if($request->date == $dt->toDateString()){
					$flag = 0;
					break;
				} 
				$dt->addDay();
			}
			if($flag){
				Session::flash('maintenanceweekupdate', "Cannot set this date beacause out of date."); 
				$messages =$validator->messages();     
				return redirect()->back()->withInput()->withErrors($messages);
			}
			/*******************************************************/		
			$datetime = date('Y-m-d H:i:s', strtotime($request->date . ' ' . $request->time));
			$datetime_array = explode(' ', $datetime);
			$task->update(
			[
				'date' 				=> $datetime_array[0],
				'time' 				=> $datetime_array[1],
				'client' 			=> $request->client, 
				'type' 		    	=> '0', 
			]);
			
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
				'sign'  							=> $request->sign
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
			return redirect()->route('adminmaintenances', ['employee' => $request->employee])->with('message', "The maintenance is created successfully.");
		}
		$data = array();
		$data['task']  					= $task;
		$data['maintenance']  			= $maintenance;
		$data['maintenancesigns'] = Maintenancesign::get(); 
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
		$data['employees'] = User::where('deleted', 0)->where('usertype', '10')->get();
		return view('admin.maintenances.update', $data);
	}
	public function detail(Request $request){ 
		if($request->value === null)
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200);
		 
		$task = Task::where('id', $request->value)
					->where('deleted', '0')
					->where('type', '0')
					->first();
		if(!isset($task))
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200);
		$data  = array();   
		$task->client_data = User::where('id', $task->client)->first();
		$task->worker_data = User::where('id', $task->employee)->first(); 
		$task->maintenance = Maintenance::where('task_id', $task->id)->first(); 
		if(!isset($task->maintenance))
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200);  
		$equipment_array = array();
		$poolowner_array = array();
		$maintenancechecks = MaintenanceCheck::where('task_id', $task->id)->where('deleted', '0')->get(); 
		foreach($maintenancechecks as $item){
			if($item->property == "equipment")
				$equipment_array[] = $item->property_value;
			else
				$poolowner_array[] = $item->property_value;
		}
		$task->equipment_array  	= $equipment_array;
		$task->poolowner_array  	= $poolowner_array; 
		$data['html'] =  view('admin/maintenances/formdetail', compact('task'))->render(); 
		$change_tr = 0;
		if($task->sign){
			Task::find($request->value)
			->update(
			[ 
				'sign' 		    	=> 0, 
			]);
			$task->sign = 0;
			$change_tr = 1;
			$data['change_tr_html'] =  view('admin/tasks/ajaxindex', compact('task'))->render(); 
		}
		$data['change_tr'] = $change_tr;
		$data['msg']  = "success";
		$data['status']  = 1;  
		return  response()->json($data, 200);
	}
	public function delete(Request $request, $id){
		$task = Task::where('id', $id)->where('deleted', '0')->where('tasks.type', '0')->first();
		if(!isset($task))
			return view('errors.404'); 
		$task->deleted = 1;
		$task->save();
		return redirect()->back()->with('message', "The service is deleted successfully.");
	}
}
