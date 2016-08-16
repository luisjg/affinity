<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
	protected $table = 'exploration.projects';

	protected $primaryKey = 'project_id';

	public $incrementing = false;
}