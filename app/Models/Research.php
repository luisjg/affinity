<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class research extends Model
{
	protected $table = 'research_interests';

	protected $primaryKey = 'attributes_id';

	public $incrementing = false;
}