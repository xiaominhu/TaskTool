<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{ 
	protected $fillable = [
        'date', 'status', 'employee', 'time',  'type', 'client' , 'deleted', 'maintenance_week_id', 'sign'
    ];
	
	public static function rules()
    {
        return[
			'name'         			=> 'required|max:255',
		    'status'        		=> 'nullable',
			'start_date' 			=> 'required',
			'end_date'     			=> 'required', 
			'worker'     			=> 'nullable', 
			'priority'     			=> 'required', 
			'type'     				=> 'required', 
			'client'     			=> 'required', 
			'address'     			=> 'required',  
        ];
    }
	
}
