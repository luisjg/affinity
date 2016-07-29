<?php

$app->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers'], function() use ($app) {
	// badges requests
	$app->get('badges', 'BadgesController@badges');
	$app->get('badges/{email}', 'BadgesController@badges');

	// interests requests
	$app->get('interests', 'InterestsController@getInterest');
	$app->get('interests/{type}', 'InterestsController@getInterest');
});

$app->get('/', function () use ($app) {
    return app()->environment();
});
