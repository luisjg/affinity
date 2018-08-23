<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the API routes for the application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => '1.0', 'middleware' => 'cors'], function() use ($router) {
    // Badge requests
    $router->get('badges', 'BadgesController@handleBasedOnQuery');
    $router->get('badges/{email}', 'BadgesController@getPersonsBadges');

    // Interest requests
    $router->get('interests', 'InterestsController@getAllInterests');
    $router->get('interests/{type}', 'InterestsController@handleInterestType');
});
