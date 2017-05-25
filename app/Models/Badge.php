<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    /**
     * @var string
     */
    protected $table = 'exploration.badges';

    /**
     * @var string
     */
    protected $primaryKey = 'badges_Id';

    /**
     * @var array
     */
    protected $hidden = [
        'badges_id',
        'pivot',
        'updated_at',
        'created_at',
        'active'
    ];

    /**
     * @var bool
     */
    public $incrementing = false;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members()
    {
        return $this->hasMany('App\Models\BadgeAwarded', 'badge_name','name');
    }

}
