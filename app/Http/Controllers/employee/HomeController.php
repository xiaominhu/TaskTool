<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use App\Models\Task;
use App\User;
class HomeController extends Controller
{
	public function index(Request $request){
		 
		 
		 
		 
		return view('employee.home');
	}
	private function makeJson($start_time, $task, $index){   
		$class = array('warning', 'success', 'mint', 'purple');
		$jsonitem = array();
		 
		if(count($class) > $index){
			$jsonitem['className'] = $class[$index];			 
		}
		else 
			$jsonitem['className']  = $class[0];
		
        $jsonitem['start'] 	= $start_time;
        $jsonitem['title'] 			=  $task->first_name . " " . $task->last_name; 
        $jsonitem['id'] 	=  $task->id; 
        $jsonitem['color'] = null;
        $jsonitem['editable'] = false;
        $jsonitem['end'] = $start_time;
        $jsonitem['eventTextColor'] = null;
        $jsonitem['overlap'] = false;
        $jsonitem['startEditable'] = null;
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
						 ->leftJoin('users', 'users.id', 'tasks.client')
						 ->select('tasks.*', 'users.first_name', 'users.last_name')
						 ->where('employee', Auth::user()->id)
						 ->get(); 
			 foreach($tasks as $task){  
				$json_item = $this->makeJson($start_date->toDateString(), $task, $task->type);
				$jsondata[] = $json_item; 
			 }  
			$start_date->addDay();
		}
		return response()->json($jsondata, 200); 
	}
}
