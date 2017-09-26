<?php

$app->get('/about/version-history', function() {
    return view('pages.about.version-history');
});

$app->get('/', function () {
    $email = [
        'steve'=>'steven.fitzgerald@csun.edu',
        'alexandra'=>'alexandra.monchick@csun.edu'
    ];
    if(env('APP_ENV') =='local' || env('APP_ENV') == 'demo'){
        $email['steve']  = 'nr_'.$email['steve'];
        $email['alexandra'] = 'nr_'.$email['alexandra'];
    }
    return view('home',compact('email'));
});

$app->group(['prefix' => 'api/1.0', 'namespace' => 'App\Http\Controllers'], function() use ($app) {
    // Badge requests
    $app->get('badges', 'BadgesController@handleBasedOnQuery');
    $app->get('badges/{email}', 'BadgesController@getPersonsBadges');

    // Interest requests
    $app->get('interests', 'InterestsController@getAllInterests');
    $app->get('interests/{type}', 'InterestsController@handleInterestType');

});


