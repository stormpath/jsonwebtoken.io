<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

Route::get('/', function () {
    return view('home');
});

Route::post('/generatedCode', function () {
    $request = Request::all();



    $package = str_replace('/','-',$request['jwtPackage']);
    $decode = View::make('code/'.$package.'/decode', compact('request'))->render();
    $encode = View::make('code/'.$package.'/encode', compact('request'))->render();

    return [
        'encode' => $encode,
        'decode' => $decode
    ];
});


Route::get('jwt101', function() {
    return view('101');
});