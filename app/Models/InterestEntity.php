<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestEntity extends Model
{
	protected $table = 'fresco.expertise_entity';

	protected $primaryKey = 'entities_id';

	public $incrementing = false;
}