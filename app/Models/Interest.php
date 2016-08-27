<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
	protected $table = 'fresco.interests';

	protected $primaryKey = 'attribute_id';

	public $incrementing = false;

    public function projects()
    {
        return $this->belongsToMany('App\Models\Project', 'fresco.expertise_entity', 'expertise_id', 'entities_id');
    }

    public function members()
    {
        return $this->belongsToMany('App\Models\User', 'fresco.expertise_entity', 'expertise_id', 'entities_id');
    }
}