<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Badge;
use App\Models\User;

class BadgesController extends Controller 
{
	public function __construct()
	{
		// $this->middleware('badge');
	}

	public function getAllBadges()
	{
 		return $this->sendResponse(Badge::all(), 'badges');
	}

	public function getBadgesMember(Request $request)
	{
		if($request->has('email')){
			$user = User::with('badges')->email($request['email'])->first();
			$userInfo = [
				'email' => $request['email']
			];
				if($user){
				 	return $this->sendResponse($user->badges, 'badges', $userInfo);
				}
				else{
					abort(404);
				}
		}
		else{
			return Badge::with('members')->get();
		}
	}

	public function getBadge($id)
	{
		$badge = Badge::where('badges_id',$id)->firstOrFail();	
		return $this->sendResponse($badge,'badge');
	}

}