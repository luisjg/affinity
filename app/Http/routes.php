<?php

$app->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers'], function() use ($app) {
	// badges requests
	$app->get('badges', 'BadgesController@badges');
	$app->get('badges/member/{email}', 'BadgesController@badges');

	// Intersest requests
	$app->get('interests', 'InterestsController@getInterestAll');
	$app->get('interests/{type}', 'InterestsController@getInterestType');

	$app->get('interests/project/{id}', 'InterestsController@getInteresType');

	$app->get('interests/member/{email}', 'InterestsController@getInterestMember');
	$app->get('interests/{type}/member/{email}', 'InterestsController@getInterestMember');

});

$app->get('/', function () use ($app) {
    return app()->environment();
});

$app->get('update-interests', function () {
	$interest = App\Models\Research::find('research:73');
	
	updateCount($interest);

	return "The count for $interest->attribute_id and its parents has been updated.";
});
