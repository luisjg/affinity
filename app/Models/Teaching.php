<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class teaching extends Model
{
	protected $table = 'teaching_interests';

	protected $primaryKey = 'attribute_id';

	public $incrementing = false;
}