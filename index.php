<?php

// Autoload files using the Composer autoloader.
require_once __DIR__ . '/vendor/autoload.php';

use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;


//get the access token to access graph api
$tenantId = "f8cdef31-a31e-4b4a-93e4-5f571e91255a";
$clientId = "9b6e12c5-e8c1-481d-a6ea-7b562fb7ade1";
$clientSecret = "qbgKWPLP792%@yctoPL19}%";

$guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
$url = 'https://login.microsoftonline.com/' . $tenantId . '/oauth2/token?api-version=1.0';
$token = json_decode($guzzleClient->post($url, [
    'form_params' => [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'resource' => 'https://graph.microsoft.com/',
        'grant_type' => 'client_credentials',
    ],
])->getBody()->getContents());
$accessToken = $token->access_token;
//get the username from graph api
$graph = new Graph();
$graph->setAccessToken($accessToken);

$user = $graph->createRequest("GET", "/me/messages")
                ->setReturnType(Model\User::class)
                ->execute();
print_r($user); exit;
