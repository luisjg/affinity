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

$router->get('/', function () {
    $email = [
        'steve'=>'steven.fitzgerald@csun.edu',
        'alexandra'=>'alexandra.monchick@csun.edu'
    ];
    if (config('app.environment') !=='production') {
        $email['steve']  = 'nr_'.$email['steve'];
        $email['alexandra'] = 'nr_'.$email['alexandra'];
    }
    return view('home',compact('email'));
});

$router->get('/about/version-history', function() {
    return view('pages.about.version-history');
});
