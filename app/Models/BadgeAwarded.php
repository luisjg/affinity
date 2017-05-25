<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BadgeAwarded extends Model
{
    /**
     * @var string
     */
    protected $table = 'exploration.badge_award';

    /**
     * @var string
     */
    protected $primaryKey = 'badge_id';

    /**
     * @var array
     */
    protected $hidden = [
        'active',
        'email',
        'badges_id',
        'created_at',
        'updated_at'
    ];

    /**
     * @var bool
     */
    public $incrementing = false;

    public function scopeActive($query)
    {
        return $query->where('active', 'TRUE');
    }

    public function scopeEmail($query, $email)
    {
        $email = str_replace('nr_', '', $email);
        return $query->whereEmail($email)->Active();
    }
}
