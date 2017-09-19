<?php
$router->get('/',function(){
    dd(url('testing'));
});
// $router->get('/', function () {
//     $email = [
//         'steve'=>'steven.fitzgerald@csun.edu',
//         'alexandra'=>'alexandra.monchick@csun.edu'
//     ];
//     if(env('APP_ENV')=='local'){
//         $email['steve']  = 'nr_'.$email['steve'];
//         $email['alexandra'] = 'nr_'.$email['alexandra'];
//     }
//     return view('home',compact('email'));
// });

// $router->group(['prefix' => '/1.0', 'namespace' => 'App\Http\Controllers'], function() use ($router) {
//     // Badge requests
//     $router->get('badges', 'BadgesController@getAllBadges');
//     $router->get('badges/{email}', 'BadgesController@getPersonsBadges');

//     // Interest requests
//     $router->get('interests', 'InterestsController@getAllInterests');
//     $router->get('interests/{type}', 'InterestsController@handleInterestType');

// });


