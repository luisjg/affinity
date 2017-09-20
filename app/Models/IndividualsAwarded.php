<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndividualsAwarded extends Model
{
    /**
     * @var string
     */
    protected $table = 'exploration.badges_awarded';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    /**
     * @var bool
     */
    public $incrementing = true;

    public function scopegetIndividualsByBadge($query, $badgeName){
        return $query->where('badge_name', $badgeName)->get();
    }

}
