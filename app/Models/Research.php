<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class research extends Model
{
	protected $table = 'fresco.research_interests';

	protected $primaryKey = 'attribute_id';

	protected $fillable = [
		'attribute_id',
		'title',
		'short_name',
		'parent_attribute_id',
		'hiearchy',
		'count'
	];

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