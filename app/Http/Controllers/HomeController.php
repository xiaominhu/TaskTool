<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\User;
class HomeController extends Controller
{
     
    public function __construct()
    {
        $this->middleware('auth');
    } 
    
    public function index()
    {
         switch(Auth::user()->usertype){ 
			 case 10:
				return redirect()->route('employeehome');
				break;
			case 20:
				return redirect()->route('adminhome');
				break;
		 }
    } 
	public function uploadpicture(Request $request){ 
		$validator = Validator::make($request->all(),
							[ 
								'picture'  => 'required|image|mimes:jpeg,bmp,png', 
							]
					  )->validate();
		if ($request->hasFile('picture')) { 
			$image=$request->file('picture');
			$imageName=$image->getClientOriginalName();
			$imageName = time() . $imageName;
			$image->move('images/avatar',$imageName);
			$user = User::find(Auth::user()->id);
			$user->picture = $imageName; 
			$user->save(); 
		}
		return redirect()->back();
	}
}
