<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestEntity extends Model
{
    /**
     * @var string
     */
    protected $table = 'fresco.expertise_entity';

    /**
     * @var string
     */
    protected $primaryKey = 'entities_id';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $hidden = [
        'expertise_entity_id',
        'created_at',
        'updated_at'
    ];

}
