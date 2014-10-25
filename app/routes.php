<?php

// Define a HTTP GET route:
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";  
});