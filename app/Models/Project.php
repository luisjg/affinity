<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $table = 'exploration.projects';

	protected $primaryKey = 'project_id';

	public $incrementing = false;

	public function interests()
	{
		return $this->belongsToMany('App\Models\Interest', 'fresco.expertise_entity', 'entities_id', 'expertise_id');
	}
}