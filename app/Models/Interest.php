<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
	protected $table = 'expertises';

	protected $primaryKey = 'attributes_id';

	public $incrementing = false;
}