<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Interest;
use App\Models\User;
use App\Models\InterestEntity;

use Exception;

class InterestsController extends Controller 
{
	public function getInterestAll(Request $request)
	{
		$interests = Interest::whereNotNull('attribute_id');

		if($request['members'] == true)
		{
			$interests->with('members');
		}

		if($request['projects'] == true)
		{
			$interests->with('projects');
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

	public function getInterestType(Request $request, $type = NULL)
	{
		try
		{
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
			}
			else
			{
				$data = $table[$type]::all();
			}

			if($request['members'] == true)
			{
				$data = $data->with('members');
			}

			if($request['projects'] == true)
			{
				$data = $data->with('projects');
			}

			return $this->sendResponse($data, "$type-interest");
		}
		catch(Exception $e)
		{
			abort(404);
		}
	}

	public function getInterestMember(Request $request, $email, $type="all")
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
		catch(Exception $e)
		{
			abort(404);
		}
	}
}