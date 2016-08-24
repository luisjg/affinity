<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
	protected $table = 'exploration.projects';

	protected $primaryKey = 'project_id';

	public $incrementing = false;

	public function interests()
	{
		return $this->belongsToMany('App\Models\Interest', 'fresco.expertise_entity', 'expertise_id', 'entites_id');
	}
}