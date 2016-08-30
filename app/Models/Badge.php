<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
	protected $table = 'exploration.badges';

	protected $primaryKey = 'badges_id';

	protected $hidden = [
		'pivot'
	];

	public $incrementing = false;

	public function getPublishedAttribute()
	{
		return $this->pivot->published == 'TRUE' ? true : false;
	}
	public function members()
	{
		return $this->hasMany('App\Models\BadgesAwarded', 'badge_name','name');
	}

}