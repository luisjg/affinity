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
		// Projects and Members serve as flags to activate the addition
		// of such interest with associated projects / members
		$request = $request->only('projects','members');
		
		$table = [
			'all'        => 'App\Models\Interest',
			'research'   => 'App\Models\Research',
			'teaching'   => 'App\Models\Teaching',
			'personal'   => 'App\Models\Personal',
		];
		if(str_contains($type, ':')){
			$query = $type;
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
	public function getInterestProject($id)
	{
		$data = InterestEntity::where('entities_id',$id)->with('interest')->get();
		foreach ($data as $connection ) {
			$interest[] = $connection->interest[0];
		}
		return $this->sendResponse($interest, "project-interest");

	}
	public function getInterestMember($id)
	{
		$user = User::email($id)->first();
		$userInfo = [
			'email' => $id
		];
		if($user){
			$data = InterestEntity::where('entities_id',$user->user_id)->with('interest')->get();
			foreach ($data as $connection ) {
				$interest[] = $connection->interest[0];
			}
			return $this->sendResponse($interest, "member-interest", $userInfo);
		}
	}
}