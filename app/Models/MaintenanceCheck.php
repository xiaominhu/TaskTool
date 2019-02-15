<?php

namespace App\Models; 
use Illuminate\Database\Eloquent\Model; 
class MaintenanceCheck extends Model
{
	protected $table = 'maintenance_check';
	protected $fillable = ['task_id', 'property', 'property_value', 'deleted']; 
}
