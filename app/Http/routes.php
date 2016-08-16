<?php

$app->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers'], function() use ($app) {
	// badges requests
	$app->get('badges', 'BadgesController@badges');
	// interests requests
	$app->get('interests', 'InterestsController@getInterest');
	$app->get('interests/{type}', 'InterestsController@getInterest');

});

$app->get('/', function () use ($app) {
    return app()->environment();
});

$app->get('update-interests', function () {
	$interest = App\Models\Research::find('research:73');
	
	updateCount($interest);

	return "The count for $interest->attribute_id and its parents has been updated.";
});
