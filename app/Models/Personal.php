<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    /**
     * @var string
     */
    protected $table = 'fresco.personal_interests';

    /**
     * @var string
     */
	protected $primaryKey = 'attribute_id';

    /**
     * @var bool
     */
	public $incrementing = false;

    /**
     * @var array
     */
	protected $hidden = [
	    'attribute_id',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function projects()
    {
        return $this->belongsToMany('App\Models\Project', 'fresco.expertise_entity', 'expertise_id', 'entities_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany('App\Models\User', 'fresco.expertise_entity', 'expertise_id', 'entities_id');
    }
}
