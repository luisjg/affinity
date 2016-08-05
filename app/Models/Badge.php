<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
	protected $table = 'exploration.badges';

	protected $primaryKey = 'name';

	protected $hidden = [
		'pivot'
	];

	public $incrementing = false;

	public function getPublishedAttribute()
	{
		return $this->pivot->published == 'TRUE' ? true : false;
	}

}