<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model
{
    protected $primaryKey = 'user_id';

    public $incrementing = false;

    protected $hidden = [
        'password',
    ];

    public function badges()
   {
       return $this->belongsToMany('App\Models\Badge', 'exploration.badges_awarded', 'members_id', 'badge_name')
                   ->withPivot('published')
                   ->select(['badges_id', 'name', 'url_image', 'url_web', 'award_date', 'published'])
                   ->orderBy('badges_id', 'ASC');
   }

    public function scopeEmail($q, $email)
    {
        if(app()->environment() != 'local')
        {
            $email = str_replace('nr_', '', $email);
        }

        return $q->whereEmail($email);
    }
    public function projects()
    {
        $data = $this->hasManyThrough('App\Models\Projects','App\Models\InterestEntity','expertise_id','project_id');
        return $data->where('entities_id','LIKE',"projects:%");
    }
    public function members()
    {
        $data = $this->hasManyThrough('App\Models\User','App\Models\InterestEntity','expertise_id','individuals_id');
        return $data->where('entities_id','LIKE',"members:%");
    }

    public function interests()
    {
        return $this->belongsToMany('App\Models\Interest', 'person_interest', 'attribute_id', 'user_id');
    }

}
