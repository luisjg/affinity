<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    /**
     * @var string
     */
    protected $table = 'fresco.research_interests';

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
        'updated_at',
        'created_at'
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

    public function user()
    {
        return $this->belongsToMany('App\Models\User', 'person_interest', 'individuals_id', 'expertise_id');
    }
}
