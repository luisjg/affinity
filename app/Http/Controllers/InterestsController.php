<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Interest;
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
		$data = Interest::whereNotNull('attribute_id');
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
		return $interestProject = Interest::with('projects',function ($query) use ($id) {
				$query->where('project_id',$id);})->get();
		return $this->sendResponse($interestProject, "interests");
	}
	public function getInterestWithProject($type='all')
	{
		return $this->getInterestType($flag='project',$type);
	}


	
	public function getInterestWithMembers($type='all',Request $request)
	{
		if($request->has('email')){
			$email = $request['email'];
			return $this->getInterestMember($email, $type);
		}
		return $this->getInterestType($flag='member',$type);
	}
	public function getInterestWithMembersEmail($type,$email)
	{
		return $this->getInterestMember($email, $type);
	}




	public function getInterestType($flag='', $type='all')
	{
		// Projects and Members serve as flags to activate the addition
		// of such interest with associated projects / members
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
		if($flag == "member"){
			$data = $data->with('members');
		}
		if($flag == "project"){
			$data = $data->with('projects');
		}
		// return $data;
		return $this->sendResponse($data->get(), "$type-interest");
	}

	public function getInterestMember($email, $type="all")
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