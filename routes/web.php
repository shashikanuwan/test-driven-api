<?php

use Google\Client;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/drive', function () {
    $client = new Client();
    $client->setClientId('402045549560-ap4pj1o1tocjqpjeb062otqmf2mns91v.apps.googleusercontent.com');
    $client->setClientSecret('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');
    $client->setRedirectUri('http://localhost:8000/google-drive/callback');
    $client->setScopes([
        'https://www.googleapis.com/auth/drive',
        'https://www.googleapis.com/auth/drive.file',
    ]);
    $url =  $client->createAuthUrl();
    return redirect($url);
});

Route::get('/google-drive/callback', function () {
    $client = new Client();
    $code = request('code');
    $access_token = $client->fetchAccessTokenWithAuthCode($code);
    return $access_token;
});
