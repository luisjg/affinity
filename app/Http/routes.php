<?php

$app->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers'], function() use ($app) {
	// badges requests
	$app->get('badges', 'BadgesController@getAllBadges');
	$app->get('badges/members', 'BadgesController@getBadgesMember');
	$app->get('badges/{id}', 'BadgesController@getBadge');

	// Intersest requests
	$app->get('interests', 'InterestsController@getInterestAll');
	$app->get('interests/projects', 'InterestsController@getInterestwithProjects');
	$app->get('interests/projects/{id}', 'InterestsController@getInterestProject');

	$app->get('interests/members', 'InterestsController@getInterestWithMembers');


	$app->get('interests/{type}', 'InterestsController@getInterestType');
	$app->get('interests/{type}/projects', 'InterestsController@getInterestTypeProjects');
	$app->get('interests/{type}/members', 'InterestsController@getInterestwithMembers');

});

$app->get('/', function () {
    // return view('home');
});

$app->get('update-interests', function () {
	$interest = App\Models\Research::find('research:73');
	
	updateCount($interest);

	return "The count for $interest->attribute_id and its parents has been updated.";
});
