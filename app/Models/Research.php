<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class research extends Model
{
	protected $table = 'fresco.research_interests';

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

	public function projects()
	{
		$data = $this->hasManyThrough('App\Models\Projects','App\Models\InterestEntity','expertise_id','project_id');
		return $data->where('entities_id','LIKE',"projects:%");
	}
	public function members()
	{
		$data = $this->hasManyThrough('App\Models\People','App\Models\InterestEntity','expertise_id','individuals_id');
		return $data->where('entities_id','LIKE',"members:%");
	}
}