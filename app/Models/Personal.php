<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class personal extends Model
{
	protected $table = 'personal_interests';

	protected $primaryKey = 'attributes_id';

	public $incrementing = false;
}