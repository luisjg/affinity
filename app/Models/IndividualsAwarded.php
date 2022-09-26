<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndividualsAwarded extends Model
{
    /**
     * @var string
     */
    protected $table = 'exploration.badges_awarded';

    /**
     * @var array
     */
    protected $hidden = [
        'id',
        'updated_at',
        'created_at'
    ];

    public function scopegetPublishedBadgeHolders($query, $badgeName){
        return $query->where('badge_name', $badgeName)->where('published', 'TRUE')->get();
    }

}
