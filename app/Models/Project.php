<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * @var string
     */
    protected $table = 'exploration.projects';

    /**
     * @var string
     */
	protected $primaryKey = 'project_id';

    /**
     * @var bool
     */
	public $incrementing = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function interests()
	{
		return $this->belongsToMany('App\Models\Interest', 'fresco.expertise_entity', 'entities_id', 'expertise_id');
	}
}
