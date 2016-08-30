<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Badge;
use App\Models\User;

class BadgesController extends Controller 
{
	public function __construct()
	{
		$this->middleware('badge');
	}

	public function getAllBadges(Request $request)
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
	 		return $this->sendResponse(Badge::all(), 'badges');
		}
	}

	public function getBadgesMember()
	{
		return Badge::with('members')->get();
	}

	public function getBadge($id)
	{
		$badge = Badge::findOrFail($id);	
		return $this->sendResponse($badge,'badge');
	}

}