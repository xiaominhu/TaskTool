<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User; 
use Validator, Auth;
use Illuminate\Support\Facades\Input;
use App\Models\ClientPool;

class ClientsController extends Controller
{
	public function index(Request $request){ 
		$users_obj  = User::where('usertype', '0')->where('deleted', 0); 
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
									->orWhere('users.address', 'like', $key);
							});  
		} 
		$users =  $users_obj->paginate(15);
		return view('employee.clients.index', ['users' => $users->appends(Input::except('page'))]);  
	}  
	public function detail(Request $request){
		if($request->value === null)
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200); 
		$client    =  User::where('id', $request->value)
							->where('usertype', '0')
							->first();
		$client->clientpool = ClientPool::where('deleted', 0)
									  ->where('user_id', $client->id)
									  ->get(); 
		$return_html =  view('employee/clients/formdetail', compact('client'))->render();
		$gallery = 0;
		if(count($client->clientpool))
			$gallery = count($client->clientpool); 
		return  response()->json(array('msg'=> "success", 'gallery' => $gallery, 'html' => $return_html  , 'status'=> 1), 200);
	}
}
