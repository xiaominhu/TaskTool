<?php 
namespace App\Helpers; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use GuzzleHttp\Client as HttpClient; 
use Auth;
use Illuminate\Support\Facades\Storage;
use File;
use Session;
use DB;   
use App\Models\Task;
use Carbon\Carbon;
use App\User;

class Mainhelper extends Authenticatable                       
{
	 public static function getUncompletedMaintenance($user_id){ 
		 $firstday = Carbon::now()->startOfWeek()->toDateString();  
		 $tasks = Task::where('type', '0')
					  ->where('employee', $user_id)
					  ->where('status', '0')
					  ->where('tasks.deleted', '0')
					  ->where('date', '>=' , $firstday)
					  ->count();
		 return $tasks;
	 } 
	 public static function getUncompletedService($user_id){
		 $tasks = Task::where('type', '1')
					  ->where('employee', $user_id)
					  ->where('status', '0')
					  ->where('tasks.deleted', '0')
					  ->count(); 
		 return $tasks;
	 }
	 
	 public static function getUncompletedAdditional($user_id){
		 $tasks = Task::where('type', '2')
					  ->where('employee', $user_id)
					  ->where('status', '0')
					  ->where('tasks.deleted', '0')
					  ->count(); 
		 return $tasks;
	 }
	 
	 
	 public static function getAdmin(){
		 $admins = User::where('usertype', '20')->get();
		 $ccs = array();
		 foreach($admins as $admin){
			 $ccs[]  = $admin->email;   
		 } 
		 return $ccs;
	 }
	 
	 
	 
}