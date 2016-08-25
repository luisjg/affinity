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
	
	public function badges($id='',Request $request)
	{
		// request has ?member={email} in url
		if($request->has('email'))
		{
			$user = User::with('badges')->email($request['email'])->first();

			$userInfo = [
				'email' => $request['email']
			];

			return $this->sendResponse($user->badges, 'badges', $userInfo);
		}
		if($id){
			return $this->sendResponse(Badge::where('badges_id',$id)->firstOrFail(), 'badges');
		}
		// request has no search queries in url
		return $this->sendResponse(Badge::all(), 'badges');
	}
}