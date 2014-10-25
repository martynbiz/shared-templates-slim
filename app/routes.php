<?php

// Define a HTTP GET route:
$app->group('/accounts', function () use ($app) {
    
    $controller = new App\Controllers\AccountsController($app);
    
    require '_routes_resource.php';
    
});