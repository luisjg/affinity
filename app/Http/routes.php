<?php

$app->get('/', function () {
    return view('home');
});

$app->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers'], function() use ($app) {
    // Badge requests
    $app->get('badges', 'BadgesController@getAllBadges');
    $app->get('badges/{email}', 'BadgesController@getPersonsBadges');

    // Interest requests
    $app->get('interests', 'InterestsController@getAllInterests');
//    $app->get('interests/{email}', 'InterestsController@getPersonsInterests');
//    $app->get('interests/{type}/{email}', 'InterestsController@getSpecificPersonsInterestType');
//    $app->get('interests/{email}/{type}', 'InterestsController@getSpecificPersonsInterestType');

//  Not sure if these routes will be used
//	$app->get('badges/members', 'BadgesController@getBadgesWithMembers');
//	$app->get('badges/{id}', 'BadgesController@getBadge');

//	$app->get('interests/projects', 'InterestsController@getInterestwithProjects');
//	$app->get('interests/projects/{id}', 'InterestsController@getInterestProject');
//	$app->get('interests/members', 'InterestsController@getInterestWithMembers');
//	$app->get('interests/{type}', 'InterestsController@getInterestType');
//	$app->get('interests/{type}/projects', 'InterestsController@getInterestTypeProjects');

});


