<?php

$app->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers'], function() use ($app) {
	// badges requests
	$app->get('badges', 'BadgesController@badges');
	$app->get('badges/members', 'BadgesController@badges');
	$app->get('badges/{id}', 'BadgesController@badges');

	// Intersest requests
	$app->get('interests', 'InterestsController@getInterestAll');
	
	$app->get('interests/projects', 'InterestsController@getInterestWithProject');
	$app->get('interests/projects/{id}', 'InterestsController@getInterestProject');

	$app->get('interests/members', 'InterestsController@getInterestWithMembers');


	$app->get('interests/{type}', 'InterestsController@getInterestType');
	$app->get('interests/{type}/projects', 'InterestsController@getInterestWithMembers');
	$app->get('interests/{type}/members', 'InterestsController@getInterestWithMembers');

});

$app->get('/', function () {
    return view('home');
});

$app->get('update-interests', function () {
	$interest = App\Models\Research::find('research:73');
	
	updateCount($interest);

	return "The count for $interest->attribute_id and its parents has been updated.";
});
