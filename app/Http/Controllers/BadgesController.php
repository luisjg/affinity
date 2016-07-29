<?php namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\User;

class BadgesController extends Controller 
{
	public function __construct()
	{
		$this->middleware('badge');
	}

	// return a list of all the badges
	public function badges($email = NULL)
	{
		if(is_null($email))
		{
			return $this->sendResponse(Badge::all(), 'badges');
		}

		$user = User::with('badges')->email($email)->first();

		$userInfo = [
			'members_id' => $user->user_id, 
			'email'      => $user->email
		];

		return $this->sendResponse($user->badges, 'badges', $userInfo);
	}
}