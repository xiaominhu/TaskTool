<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator, Auth;
use Illuminate\Support\Facades\Input;
class WorkersController extends Controller    
{
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
		return view('admin.workers.index', ['users' => $users->appends(Input::except('page'))]); 
	} 
	public function create(Request $request){
		if($request->isMethod('post')){
			$validator  =  Validator::make($request->all(), [
				'first_name'     => 'required|max:255',
				'last_name'      => 'required|max:255',
				'phone'          => 'required|max:20',
				'email'    		 => 'required|email|max:255|unique:users',  
				'password'       => 'required|min:8',  
			]);  
			if($validator->fails()){
				$messages =$validator->messages();     
				return redirect()->back()->withInput()->withErrors($messages);
			} 
			User::create([
				'first_name' 		=> $request->first_name,
				'last_name' 		=> $request->last_name,
				'phone' 			=> $request->phone,
				'email' 			=> $request->email,
				'password' 			=> bcrypt($request->password),
				'usertype'  		=> '10'
			]);
			return redirect()->route('adminworkers')->with('message', "New Employee " . $request->name . " is created successfully.");
		}
		return view('admin.workers.create');
	} 
	public function update(Request $request, $id){ 
		$user = User::where('id', $id)->where('usertype', '10')->first();
		if(!isset($user))
			return view('errors.404');
		if($request->isMethod('post')){
			if($user->email == $request->email){
				$validator  =  Validator::make($request->all(), [
					'first_name'     => 'required|max:255',
					'last_name'      => 'required|max:255',
					'phone'          => 'required|max:20', 
					'password' => 'nullable|min:8',  
				]);  
			}
			else{
				$validator  =  Validator::make($request->all(), [
					'first_name'     => 'required|max:255',
					'last_name'      => 'required|max:255',
					'phone'          => 'required|max:20',
					'email'    => 'required|email|max:255|unique:users',  
					'password' => 'nullable|min:8',  
				]);   
			} 
			if($validator->fails()){
				$messages =$validator->messages();     
				return redirect()->back()->withInput()->withErrors($messages);
			}  
			$user->update([
				'first_name' 		=> $request->first_name,
				'last_name' 		=> $request->last_name,
				'phone' 			=> $request->phone,
				'email' 			=> $request->email,
				'usertype'  		=> '10'
			]); 
			if($request->password){
				$user->password = bcrypt($request->password);
			}
			$user->save(); 
			return redirect()->route('adminworkers')->with('message', "The Employee " . $request->name . " is updated successfully.");
		}  
		return view('admin.workers.update', compact('user'));
	}
	public function delete(Request $request, $id){
		$user = User::find($id);
		if(!isset($user))
			return view('errors.404');
		$user->deleted = 1; 
		$user->save();
		return redirect()->route('adminworkers')->with('message', "The User : " . $user->name . " is deleted successfully."); 
	}
	public function detail(Request $request){
		if($request->value === null)
			return  response()->json(array('msg'=> "fail",  'status'=> 0), 200); 
		$employee    =  User::where('id', $request->value)
							->where('usertype', '10')
							->first();
		$return_html =  view('admin/workers/formdetail', compact('employee'))->render();
		return  response()->json(array('msg'=> "success", 'html' => $return_html  , 'status'=> 1), 200);
	}
}
