<?php
namespace App\Http\Controllers\admin;
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
									->orWhere('users.phone', 'like', $key)
									->orWhere('users.address', 'like', $key)
									->orWhere('users.email', 'like', $key);
							});  
		}
		
		$users =  $users_obj->paginate(15);
		return view('admin.clients.index', ['users' => $users->appends(Input::except('page'))]);  
	} 
	public function create(Request $request){
		if($request->isMethod('post')){
			$validator  =  Validator::make($request->all(), [
				'type'     			=> 'required|max:20',
				'first_name'     	=> 'required|max:255',
				'last_name'      	=> 'required|max:255',
				'phone'          	=> 'required|max:20',
				'company'          	=> 'required|max:256',
				'address'          	=> 'required|max:256',
				'email'    			=> 'required|email|max:255|unique:users',   
			]); 
			
			if($validator->fails()){
				$messages =$validator->messages();     
				return redirect()->back()->withInput()->withErrors($messages);
			}
			
			
			$user = User::create([
						'color'      		=> $request->type,
						'first_name' 		=> $request->first_name,
						'last_name'  		=> $request->last_name,    
						'phone' 	 		=> $request->phone,
						'company' 	 		=> $request->company,
						'address' 	 		=> $request->address,
						'email' 	 		=> $request->email, 
						'pool_description' 	=> $request->pool_description, 
						'usertype'   		=> '0',
						'password' 			=> '0',
					]);
			
			if($request->uploadedfiles){
				$uploadedfiles = $request->uploadedfiles;
				$uploadedfiles_array = explode(",", $uploadedfiles);
				foreach($uploadedfiles_array as $item){
					ClientPool::create([
						'user_id' => $user->id,
						'name'    => $item
					]); 
				} 
			}
			return redirect()->route('adminclients')->with('message', "New Client " . $request->name . " is created successfully.");
		}
		return view('admin.clients.create');
	}
	public function update(Request $request, $id){
		$user = User::where('id', $id)->where('usertype', '0')->first();
		if(!isset($user))
			return view('errors.404');
		if($request->isMethod('post')){
			if($user->email == $request->email){ 
				$validator  =  Validator::make($request->all(), [
					'type'     		=> 'required|max:20',
					'first_name'    => 'required|max:255',
					'last_name'     => 'required|max:255',
					'phone'         => 'required|max:20',
					'company'       => 'required|max:256',
					'address'       => 'required|max:256', 
				]); 
			}
			else{  
				$validator  =  Validator::make($request->all(), [
					'type'     			=> 'required|max:20',
					'first_name'     	=> 'required|max:255',
					'last_name'      	=> 'required|max:255',
					'phone'          	=> 'required|max:20',
					'company'          	=> 'required|max:256',
					'address'          	=> 'required|max:256',
					'email'    			=> 'required|email|max:255|unique:users',   
				]);  
			}
			
			if($validator->fails()){
				$messages =$validator->messages();     
				return redirect()->back()->withInput()->withErrors($messages);
			}  
			$user->update([
				'color'      => $request->type,
				'first_name' => $request->first_name,
				'last_name'  => $request->last_name,
				'phone' 	 => $request->phone,
				'company' 	 => $request->company,
				'address' 	 => $request->address,
				'email' 	 => $request->email,
				'usertype'   => '0',
				'pool_description' 	=> $request->pool_description,  
			]); 
			$user->save(); 
			 
			ClientPool::where('user_id', $user->id)->update([
					'deleted' => '1'
			]);			
			if($request->uploadedfiles){
				$uploadedfiles = $request->uploadedfiles;
				$uploadedfiles_array = explode(",", $uploadedfiles);
				foreach($uploadedfiles_array as $item){
					ClientPool::updateOrCreate(
						[
							'user_id' => $user->id,
							'name'    => $item
						],
						[
							'deleted' => '0'
						]
					); 
				}
			}
			
			return redirect()->route('adminclients')->with('message', "The Client " . $request->name . " is updated successfully."); 
		} 
		$user->clientpool = ClientPool::where('deleted', 0)
									  ->where('user_id', $user->id)
									  ->get(); 
		return view('admin.clients.update', compact('user'));
	}
	
	public function delete(Request $request, $id){
		$user = User::find($id);
		if(!isset($user))
			return view('errors.404');
		$user->deleted = 1; 
		$user->save();
		return redirect()->route('adminclients')->with('message', "The User : " . $user->first_name . ' '  .$user->last_name . " is deleted successfully."); 
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
									  
		$return_html =  view('admin/clients/formdetail', compact('client'))->render(); 
		$gallery = 0;
		if(count($client->clientpool))
			$gallery = count($client->clientpool);
		
		return  response()->json(array('msg'=> "success", 'gallery' => $gallery ,'html' => $return_html, 'status'=> 1), 200);
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
			$image->move('images/client',$imageName);
			echo $imageName;
		}
	}
}