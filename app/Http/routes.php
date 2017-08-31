<?php

$app->get('/', function () {
    $email  = 'steven.fitzgerald@csun.edu';
    $email2 = 'alexandra.monchick@csun.edu';
    if(env('APP_ENV')=='local'){
        $email  = 'nr_'.$email;
        $email2 = 'nr_'.$email2;
    }
    return view('home',compact('email','email2'));
});

$app->group(['prefix' => '/1.0', 'namespace' => 'App\Http\Controllers'], function() use ($app) {
    // Badge requests
    $app->get('badges', 'BadgesController@getAllBadges');
    $app->get('badges/{email}', 'BadgesController@getPersonsBadges');

    // Interest requests
    $app->get('interests', 'InterestsController@getAllInterests');
    $app->get('interests/{type}', 'InterestsController@handleInterestType');

});


