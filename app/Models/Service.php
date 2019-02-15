<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
	protected $fillable = [
        'task_id', 'job_description', 'complited', 'billed', 'comments', 'instructions'
    ]; 
}
