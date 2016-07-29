<?php namespace App\Http\Controllers;

use App\Models\User;

class InterestsController extends Controller 
{
	public function __construct()
	{
		$this->middleware('interest');
	}

	public function getInterest($type = 'all')
	{
		$table = [
			'all'        => 'App\Models\Interest',
			'research'   => 'App\Models\Research',
			'teaching'   => 'App\Models\Teaching',
			'personal'   => 'App\Models\Personal',
		];

		// user is searching for ALL research, teaching, or personal
		$data = $table[$type]::all();
		
		// user has specified search based off interest id so return $data based off $type:id
		if(str_contains($type, ':'))
		{
			$query = $type;
			$type  = strtok($type, ':');
			$data  = $table[$type]::find($query);
		}

		return $this->sendResponse($data, "$type-interest");
	}
}