<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class research extends Model
{
	protected $table = 'research_interests';

	protected $primaryKey = 'attribute_id';

	protected $fillable = [
		'attribute_id',
		'title',
		'short_name',
		'parent_attribute_id',
		'hiearchy',
		'count'
	];

	public $incrementing = false;
}