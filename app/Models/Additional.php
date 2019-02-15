<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    //
		protected $fillable = [
        'task_id', 'job_description', 'comments'
    ]; 
}
