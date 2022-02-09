<?php

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/drive', function () {
    $client = new Client();
    $client->setClientId('402045549560-gck8s60du9u1kj3e1m0leq1bc1v2jqaf.apps.googleusercontent.com');
    $client->setClientSecret('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');
    $client->setRedirectUri('http://localhost:8000/google-drive/callback');
    $client->setScopes([
        'https://www.googleapis.com/auth/drive',
        'https://www.googleapis.com/auth/drive.file',
    ]);
    $url =  $client->createAuthUrl();
    return $url;
});

Route::get('/google-drive/callback', function () {
    return request('code');
    // $client = new Client();
    // $client->setClientId('402045549560-gck8s60du9u1kj3e1m0leq1bc1v2jqaf.apps.googleusercontent.com');
    // $client->setClientSecret('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');
    // $client->setRedirectUri('http://localhost:8000/google-drive/callback');
    // $code = request('code');
    // $access_token = $client->fetchAccessTokenWithAuthCode($code);
    // return $access_token;
});

Route::get('upload', function () {
    $client = new Client();
    $access_token = 'ya29.A0ARrdaM9mgF-Fv5mc8KqAViILu5rWdIYd1opltEUf7GOhDw8qBSWNMO6iTkLGtmCtbOH3c3ioHvjjZ3rMlZB1Cmhj__vQK9Qm-5ox-0JfFUYFQBpWyvZfTP06w2B2JSfgSZmUFiErv1jhiSgEQUQcl3ex1nB-';

    $client->setAccessToken($access_token);
    $service = new Drive($client);
    $file = new DriveFile();

    DEFINE("TESTFILE", 'test.txt');
    if (!file_exists(TESTFILE)) {
        $fh = fopen(TESTFILE, 'w');
        fseek($fh, 1024 * 1024);
        fwrite($fh, "!", 1);
        fclose($fh);
    }

    $file->setName("Hello World!");
    $resualt2 = $service->files->create(
        $file,
        array(
            'data' => file_get_contents(TESTFILE),
            'mimeType' => 'application/octet-stream',
            'uploadType' => 'multipart'
        )
    );
});
