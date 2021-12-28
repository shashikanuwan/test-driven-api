<?php

use Google\Client;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/drive', function () {
    $client = new Client();
    $client->setClientId('402045549560-30jtb8ojh93f7p83on2hlga4t4kt4gn9.apps.googleusercontent.com');
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
    $code = request('code');
    return $code;
});
