<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class personal extends Model
{
	protected $table = 'fresco.personal_interests';

	protected $primaryKey = 'attribute_id';

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