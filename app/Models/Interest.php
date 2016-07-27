<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
	protected $table = 'expertises';

	protected $primaryKey = 'attribute_id';

	public $incrementing = false;
}