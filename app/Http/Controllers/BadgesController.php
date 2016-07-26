<?php namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\User;

class BadgesController extends Controller 
{
	// return a list of all the badges
	public function badges()
	{
		$response = [
			'status'  => app('Illuminate\Http\Response')->status(),
			'success' => count(Badge::all()) > 0 ? true : false,
			'version' => 'attributes-1.0',
			'type'    => 'badges',
		];

		if($response['status'] == 200)
		{
			$response['badges'] = Badge::all();
		}

		if($response['status'] != 200)
		{
			$response['messages']['server_error'] = 'We encountered an error on our server.';
		}

		if($response['success'] == false)
		{
			$response['messages']['data'] = 'We could not find any records.';
		}

		return $response;
	}

	// return all the badges associated with specified email
	public function facultyBadge($email)
	{
		$user = User::with('badges')->where('email', $email)->first();
		
		$response = [
			'status'  => app('Illuminate\Http\Response')->status(),
			'success' => count(Badge::all()) > 0 ? true : false,
			'version' => 'attributes-1.0',
			'type'    => 'badges',
		];

		if($user)
		{
			$response['members_id'] = $user->user_id;
			$response['email']      = $user->email;
			$response['badges']     = $user->badges;
		}

		if(!$user)
		{
			$response['messages']['user'] = 'No user could be found with that email.';
		}

		return $response;
	}
}