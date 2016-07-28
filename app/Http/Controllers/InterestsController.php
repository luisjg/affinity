<?php namespace App\Http\Controllers;

use App\Models\User;

class InterestsController extends Controller 
{
	public function getInterest($type = 'all')
	{
		// Defines where the search will take place
		$table = [
		'all'        => 'App\Models\Interest',
		'research'   => 'App\Models\Research',
		'teaching'   => 'App\Models\Teaching',
		'personal'   => 'App\Models\Personal',
		];
		
		// enforce type or type:

		if(str_contains($type, ':'))
		{
			$query = $type;
			$type  = strtok($type, ':');
			$data  = $table[$type]::find($query);
		}
		else
		{
			$data = $table[$type]::all();
		}

		return $this->sendResponse($data, "$type-interest");
	}
}