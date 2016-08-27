<?php

$app->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers'], function() use ($app) {
	// Badges 
	$app->get('badges', 'BadgesController@badges');
	$app->get('badges/member/{email}', 'BadgesController@badges');

	// Interests 
	$app->get('interests', 'InterestsController@getInterestAll');
	$app->get('interests/project/{id}', 'InterestsController@getInterestProject');
	$app->get('interests/{type}', 'InterestsController@getInterestType');
	$app->get('interests/member/{email}', 'InterestsController@getInterestMember');
	$app->get('interests/{type}/member/{email}', 'InterestsController@getInterestMember');
});