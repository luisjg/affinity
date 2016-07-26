<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
	protected $table = 'badges';

	protected $primaryKey = 'badge_id';

	public $incrementing = false;

	public function user()
	{
		return $this->belongsToMany('App\Models\User', 'entity_badge', 'badge_id', 'entity_id');
	}
}