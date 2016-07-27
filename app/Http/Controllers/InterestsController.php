<?php namespace App\Http\Controllers;

use App\Models\User;

class InterestsController extends Controller 
{
	public function getInterest($type='all')
	{
		// Defines where the seearch will take place
		$table    	=  ['all'=>'App\Models\Interest','research'=>'App\Models\Research','teaching'=> 'App\Models\Teaching','personal'=>'App\Models\Personal','search-for'=>'App\Models\Interest'];
		if($type!="all"&&$type!="research"&&$type!="teaching"&&$type!="personal") {
			$query 		= 	$type;
			$type 		= 	"search-for";
			$data 		=	$table[$type]::find($query);
		}
		else{
			$data 	   =  $table[$type]::all();
		}
		return $this->sendResponse($data,"$type-interest");
	}
}