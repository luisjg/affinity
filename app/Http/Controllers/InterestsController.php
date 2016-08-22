<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\InterestEntity;

class InterestsController extends Controller 
{
	public function __construct()
	{
		// $this->middleware('interest');
	}

	public function getInterestAll(Request $request)
	{
		$data = App\Models\Interest::whereNotNull('attribute_id');
		if($request['members'] == "true"){
			$data = $data->with('members');
		}
		if($request['projects'] == "true"){
			$data = $data->with('projects');
		}
		return $this->sendResponse($data->get(), "interest");
	}

	public function getInterestProject($id)
	{
		$interestProject = InterestEntity::where('entities_id',$id)->with('interest_project')->get();
		foreach($interestProject as &$interest){
			$data[] = $interest->interest_project;
		}
		return $this->sendResponse($data, "interests");
	}

	public function getInterestType(Request $request, $type='all')
	{
		// Projects and Members serve as flags to activate the addition
		// of such interest with associated projects / members
		$request = $request->only('projects','members');
		$table = [
			'all'		 =>	'App\Models\Interest',
			'research'   => 'App\Models\Research',
			'teaching'   => 'App\Models\Teaching',
			'personal'   => 'App\Models\Personal',
		];
		if(str_contains($type, ':')){
			$query = $type;
			$type  = strtok($query, ':');
			$data  = $table[$type]::where('attribute_id',$query);
		}else{
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

	public function getInterestMember(Request $request, $email, $type="all")
	{
		$table = [
			'all'		 =>	'App\Models\Interest',
			'research'   => 'App\Models\Research',
			'teaching'   => 'App\Models\Teaching',
			'personal'   => 'App\Models\Personal',
		];
		$user = User::email($email)->first();
		$userInfo = [
			'email' => $user->email
		];
		if($type=='all'){
			$data = InterestEntity::where('entities_id',$user->user_id)->with("interest")->get();
			foreach ($data as $connection ) {
				$interest[] = $connection["interest"][0];
			}
		return $this->sendResponse($interest, "member-interest", ['email' => $email]);
		}
		else{
			$data = InterestEntity::where('entities_id',$user->user_id)->where('expertise_id',"LIKE","$type:%")->with("interest_$type")->get();
			foreach ($data as $connection ) {
				$interest[] = $connection["interest_$type"][0];
			}
		return $this->sendResponse($interest, "member-interest $type", ['email' => $email]);
		}

	}
}