<?php

$app->config(array(
    'debug' => true,
    'templates.path' => './public/templates',
    'view' => new App\Views\View('layouts/master.php'),
));

// Only invoked if mode is "development"
$app->configureMode('development', function () use ($app) {
    $app->config(array(
        'debug' => true,
    ));
});

// Only invoked if mode is "production"
$app->configureMode('production', function () use ($app) {
    $app->config(array(
        'debug' => false,
    ));
});