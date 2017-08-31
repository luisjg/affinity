<?php

$app->get('/', function () {
    return view('home');
});

$app->group(['prefix' => '/1.0', 'namespace' => 'App\Http\Controllers'], function() use ($app) {
    // Badge requests
    $app->get('badges', 'BadgesController@getAllBadges');
    $app->get('badges/{email}', 'BadgesController@getPersonsBadges');

    // Interest requests
    $app->get('interests', 'InterestsController@getAllInterests');
    $app->get('interests/{type}', 'InterestsController@handleInterestType');

});


