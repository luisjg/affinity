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
	
	public function badges($email = NULL)
	{
		// url is api/badges/member/{email}
		if($email)
		{
			$user = User::with('badges')->email($email)->first();

			$userInfo = [
				'email' => $email
			];

			return $this->sendResponse($user->badges, 'badges', $userInfo);
		}

		// url is api/badges
		return $this->sendResponse(Badge::all(), 'badges');
	}
}