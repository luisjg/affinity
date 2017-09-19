<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return url('test/test');
});

$router->get('/', function () {
    $email = [
        'steve'=>'steven.fitzgerald@csun.edu',
        'alexandra'=>'alexandra.monchick@csun.edu'
    ];
    if(env('APP_ENV')=='local'){
        $email['steve']  = 'nr_'.$email['steve'];
        $email['alexandra'] = 'nr_'.$email['alexandra'];
    }
    return view('home',compact('email'));
});

$router->group(['prefix' => '/1.0'], function() use ($router) {
    // Badge requests
    $router->get('badges', 'BadgesController@getAllBadges');
    $router->get('badges/{email}', 'BadgesController@getPersonsBadges');

    // Interest requests
    $router->get('interests', 'InterestsController@getAllInterests');
    $router->get('interests/{type}', 'InterestsController@handleInterestType');

});
