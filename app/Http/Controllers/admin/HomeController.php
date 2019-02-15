<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Task;
use App\User;
use Mail, Response, Paginator, View;
class HomeController extends Controller
{ 
	public function index(Request $request){
		/*
		$data = array('data'=> "Test Data");
		Mail::send(['html'=>'mail'], $data, function($message) {
			$message->to("cr3884489@gmail.com", "Chen Jie")->subject("Re: #T-Test EMail");
			$message->from("whitebear@hotmail.com", "XiaoMIn"); 
		});
		*/  
		$data = array();
		$data['employees'] = User::where('deleted', 0)
								->where('usertype', '10')
								->Join('maintenance_week', 'maintenance_week.employee', 'users.id')
								->select('users.*') 
								->get();  
		return view('admin.home', $data);	 
	}
	
	public function history(Request $request){
		return view('admin.history.index');
	} 
	private function makeJson($start_time, $task, $index){   
		$class = array('warning', 'success', 'mint', 'purple');
		$jsonitem = array();
		 
		if(count($class) > $index){
			$jsonitem['className'] = $class[$index];			 
		}
		else 
			$jsonitem['className']  = $class[0];
		
        $jsonitem['start'] 			=  $start_time;
        $jsonitem['staus'] 			=  $index;
		
        $jsonitem['title'] 			=  $task->first_name . " " . $task->last_name; 
        $jsonitem['id'] 			=  $task->id; 
        $jsonitem['color'] 			=  null;
        $jsonitem['editable'] 		=  false;
        $jsonitem['end'] 			=  $start_time;
        $jsonitem['eventTextColor'] =  null;
        $jsonitem['overlap'] 		=  false;
        $jsonitem['startEditable'] 	=  null;
        return $jsonitem; 
    }
	
	public function calendar(Request $request){
		$start = $request->input('start');
        $end   = $request->input('end');         
	
		$start_date = Carbon::createFromFormat('Y-m-d', $start);
        $end_date   = Carbon::createFromFormat('Y-m-d', $end);	
		$now = Carbon::now();  
		$jsondata = array();
		 
		while(1){      
            if(((int) $start_date->diffInSeconds($end_date, false)) < 0) {
                break; 
            } 
			$tasks = Task::where('date', $start_date->toDateString())
						 ->leftJoin('users', 'users.id', 'tasks.employee')
						 ->select('tasks.*', 'users.first_name', 'users.last_name')
						 ->get();
			 foreach($tasks as $task){ 
				$json_item = $this->makeJson($start_date->toDateString(), $task, $task->type);
				$jsondata[] = $json_item;
				
			 }  
			$start_date->addDay();
		}
		return response()->json($jsondata, 200);
	}
	 
	public function getnewsigns(Request $request){
		 $firstday = Carbon::now()->startOfWeek()->toDateString(); 	
		 $maintenances = Task::where('type', '0') 
							  ->where('sign', '1')
							  ->where('deleted', 0)
							  ->where('date', '>=', $firstday)
							  ->count(); 
		 $services   = Task::where('type', '1') 
							  ->where('sign', '1')
							  ->where('deleted', 0)
							  ->count();
		 $additionals   = Task::where('type', '2') 
							  ->where('sign', '1')
							  ->where('deleted', 0)
							  ->count();					  
		return  response()->json(array('service'=>  $services ,  'maintenance'=> $maintenances, 'additionals' => $additionals), 200); 
	} 
}
