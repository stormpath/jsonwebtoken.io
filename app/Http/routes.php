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

use GuzzleHttp\Client;
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


Route::post('register', function() {
    $request = Request::all();

    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'https://api.stormpath.com',

        'cookies' => true
    ]);

    $getRequest = $client->request('GET', '/register');

    $getResponseBody = json_decode($getRequest->getBody()->getContents(), true);

    $getResponseCookies = $getRequest->getHeaders();


    sleep(5);

    $data = [
        'givenName' => $request['data']['fname'],
        'surname' => $request['data']['lname'],
        'email' =>$request['data']['email'],
        'companyName' => $request['data']['fname'] . ' ' . $request['data']['lname'],
        'password' => $request['data']['password'],
        'confirmedPassword' => $request['data']['password'],
        'csrfToken' => $getResponseBody['csrfToken'],
        'hpvalue' => $getResponseBody['hpvalue']
    ];


    $response = $client->request('POST', 'https://api.stormpath.com/register', ['body' => json_encode($data), 'headers'=> ['content-type' => 'application/json']]);


    if($response->getStatusCode()) {
        return response(null, 200);
    }

    return response(null, 400);

});