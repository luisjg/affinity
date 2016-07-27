<?php namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\User;

class BadgesController extends Controller 
{
	// return a list of all the badges
	public function badges()
	{
		return $this->sendResponse(Badge::all(), 'badges');
	}

	// return all the badges associated with specified email
	public function facultyBadge($email)
	{
		$user = User::with('badges')->email($email)->first();

		$userInfo = [
		'members_id' => $user->user_id, 
		'email' => $user->email
		];

		return $this->sendResponse($user->badges, 'badges', $userInfo);
	}
}