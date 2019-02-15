<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Service;
use App\User;
use Auth, Validator;
class TaskController extends Controller
{
    //
	public function taskdetail(Request $request){
		if($request->value === null)
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200);  
		$task = Task::where('deleted', '0')->where('id', $request->value)->first();; 
		if(!isset($task))
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200); 
		$task->client_data = User::where('id', $task->client)->first(); 
		if($task->type == '0'){ // maintenace
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200);  
		}
		else{
			$task->service     = Service::where('task_id', $task->id)->first(); 
			if(!isset($task->service))
				return  response()->json(array('msg'=> "fail",  'status'=> 0), 200); 
			$return_html =  view('employee/services/formdetail', compact('task'))->render();
			return  response()->json(array('msg'=> "success", 'html' => $return_html  , 'status'=> 1), 200);
		} 
	}
}
