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
	
	public function badges(Request $request)
	{
		// request has ?member={email} in url
		if($request['member'])
		{
			$user = User::with('badges')->email($request['member'])->first();

			$userInfo = [
				'members_id' => $user->user_id, 
				'email'      => $user->email
			];

			return $this->sendResponse($user->badges, 'badges', $userInfo);
		}

		// request has no search queries in url
		return $this->sendResponse(Badge::all(), 'badges');
	}
}