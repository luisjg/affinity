<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    /**
     * @var string
     */
    protected $table = 'fresco.research_interest';
    
    
    public function academic()
    {
        return $this->belongsTo('App\Models\Research','fresco.expertise_entity','fresco.research_interest');
    }
    /**
     * @var string
     */
    protected $primaryKey = 'attribute_id';

    /**
     * @var bool
     */
    public $incrementing = false;

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
