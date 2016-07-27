<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class teaching extends Model
{
	protected $table = 'teaching_interests';

	protected $primaryKey = 'attributes_id';

	public $incrementing = false;
}