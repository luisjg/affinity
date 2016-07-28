<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class personal extends Model
{
	protected $table = 'personal_interests';

	protected $primaryKey = 'attribute_id';

	public $incrementing = false;
}