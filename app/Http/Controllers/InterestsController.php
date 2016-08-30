<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Interest;
use App\Models\User;
use App\Models\InterestEntity;

use Exception;

class InterestsController extends Controller 
{

	public function getInterestAll()
	{
		$interests = Interest::whereNotNull('attribute_id');
		return $this->sendResponse($interests->get(), 'interests');
	}
	public function getInterestType(Request $request, $type = NULL){
		try{
			$table = [
				'all'	   => 'App\Models\Interest',
				'research' => 'App\Models\Research',
				'teaching' => 'App\Models\Teaching',
				'personal' => 'App\Models\Personal',
			];
			if(str_contains($type, ':'))
			{
				$query = $type;
				$type  = strtok($type, ':');
				$data  = $table[$type]::findOrFail($query);
				return $this->sendResponse($data, 'interests');
			}else
			{
				$data = $table[$type]::all();
				return $this->sendResponse($data, 'interests');
			}
		}
		catch(Exception $e)
		{
			abort(404);
		}
	}

	// Project Functions
	public function getInterestwithProjects()
	{
		$interests = Interest::whereNotNull('attribute_id')->with('projects');
		return $this->sendResponse($interests->get(), 'interests');
	}
	public function getInterestTypeProjects(Request $request, $type='all')
	{
		if($request->has('email')){
			return $this->getInterestMember($request['email'],$type);
		}
		else{
			return $this->getInterestMember($type,'projects');
		}
		return $this->sendResponse($interests->get(), 'interests');
	}
	public function getInterestProject($id)
	{
		try
		{
			$interestProject = InterestEntity::where('entities_id',$id)->with('interest_project')->get();
			foreach($interestProject as &$interest){
				$data[] = $interest->interest_project;
			}
			return $this->sendResponse($data, "interests");	
		}
		catch(Exception $e)
		{
			abort(404);
		}
	}

	// Member's Function
	public function getInterestwithMembers(Request $request, $type='all')
	{
		if($request->has('email')){
			return $this->getInterestMember($request['email'],$type);
		}
		else{
			$interests = Interest::whereNotNull('attribute_id')->with('members');
		}
		return $this->sendResponse($interests->get(), 'interests');
	}
	public function getInterestMember($email, $type)
	{
		try
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
				return $this->sendResponse($interest, "interest", ['email' => $email]);
			}
			else{
				$data = InterestEntity::where('entities_id',$user->user_id)->where('expertise_id',"LIKE","$type:%")->with("interest_$type")->get();
				foreach ($data as $connection ) {
					$interest[] = $connection["interest_$type"][0];
				}
			return $this->sendResponse($interest, "interest", ['email' => $email]);
			}
		}
		catch(Exception $e)
		{
			abort(404);
		}
	}
	
}