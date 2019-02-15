<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    //
	protected $table = 'maintenance';
	protected $fillable = [
        'task_id', 'chlorine', 'ph', 'total_alkalinity', 'salt', 'other', 'serviced_comments', 'pool_comments', 'other_action_taken',  'salt_action_taken',  'stabilizer_action_taken',  'stabilizer',  'total_alkalinity_action_taken', 'ph_action_taken','chlorine_action_taken',  'sign'
    ];
	
	
}
