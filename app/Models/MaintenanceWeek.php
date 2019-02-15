<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class MaintenanceWeek extends Model
{
	protected $table = 'maintenance_week';
	protected $fillable = ['employee', 'week', 'rows', 'start_date'];
	
	//  1: if not available, 0: available
	public static function checkDateEnable($employee, $start_date){
		$maintenanceweek = self::where('employee', $employee) 
							   ->first(); 
		if(isset($maintenanceweek))
			return 1;
		return 0; 
	}	
}
