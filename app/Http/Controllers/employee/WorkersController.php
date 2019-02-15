<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator, Auth;
use App\User;
use Illuminate\Support\Facades\Input;
class WorkersController extends Controller
{
    //
	public function index(Request $request){ 
		$users_obj  = User::where('usertype', '10')->where('deleted', 0); 
		switch($request->sort){
			case 'first_name':
				$users_obj	= $users_obj->orderBy('first_name');
				break;
			case 'last_name':
				$users_obj	= $users_obj->orderBy('last_name');
				break;
			default:
				$users_obj	= $users_obj->orderBy('first_name');
				break;
		}
		
		if($request->key){
			$key =  "%" . $request->key . "%";
			$users_obj	= $users_obj->where(function ($query) use($key) {
								$query->where('users.first_name', 'like', $key)
									->orWhere('users.last_name',  'like', $key)
									->orWhere('users.email', 'like', $key)
									->orWhere('users.phone', 'like', $key);
							});  
		}
		
		
		$users =  $users_obj->paginate(15);
		return view('employee.workers.index', ['users' => $users->appends(Input::except('page'))]); 
	} 
 
	public function detail(Request $request){
		if($request->value === null)
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200); 
		$employee    =  User::where('id', $request->value)
							->where('usertype', '10')
							->first();
		$return_html =  view('employee/workers/formdetail', compact('employee'))->render();
		return  response()->json(array('msg'=> "success", 'html' => $return_html  , 'status'=> 1), 200);
	}
}
