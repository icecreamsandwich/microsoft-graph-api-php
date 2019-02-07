<?php

require_once __DIR__ . '/vendor/autoload.php';

use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

//get the username from graph api
$graph = new Graph();
$graph->setAccessToken($accessToken);

$messages = $graph->createRequest("GET", "/me/messages")
                ->setReturnType(Model\User::class)
                ->execute();

echo $messages; exit;
