<?php

// require composer autoloader for loading classes
require '../vendor/autoload.php';

// Instantiate a Slim application:
$app = new \Slim\Slim();

// Define a HTTP GET route:
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

// Run the Slim application:
$app->run();
