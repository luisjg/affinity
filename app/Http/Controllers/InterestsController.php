<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\InterestEntity;

class InterestsController extends Controller 
{
	public function __construct()
	{
		$this->middleware('interest');
	}

	public function getInterest(Request $request, $type='all')
	{
		$request = $request->only('projects','members','id');
		
		$table = [
			'all'        => 'App\Models\Interest',
			'research'   => 'App\Models\Research',
			'teaching'   => 'App\Models\Teaching',
			'personal'   => 'App\Models\Personal',
		];
	 	if($request['id']){
			$query = $request['id'];
			$type  = strtok($query, ':');
			$data  = $table[$type]::where('attribute_id',$query);
		} else{
			$data = $table[$type]::whereNotNull('attribute_id');
		}
		if($request['members'] == "true"){
			$data = $data->with('members');
		}
		if($request['projects'] == "true"){
			$data = $data->with('projects');
		}
		// return $data;
		return $this->sendResponse($data->get(), "$type-interest");
	}

}