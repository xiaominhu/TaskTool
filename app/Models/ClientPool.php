<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientPool extends Model
{
	protected $table = 'client_pool';
	protected $fillable = [
         'name', 'user_id', 'deleted'
    ];
}
