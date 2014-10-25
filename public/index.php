<?php

function loadConfig($dirs) {
    $config = array();
    
    foreach($dirs as $dir) {
        if (is_dir($dir)) {
            foreach (new \DirectoryIterator($dir) as $fileInfo) {
                if($fileInfo->isDot() or $fileInfo->isDir()) continue;
                $config = array_merge($config, require($dir . $fileInfo->getFilename()));
            }
        } elseif (is_file($dir)) {
            $config = array_merge($config, require($dir));
        } else {
            
        }
    }
    
    return $config;
}

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// require composer autoloader for loading classes
require 'vendor/autoload.php';

// get configs
$config = loadConfig(array(
    'app/config/', // global configuration (should come first)
    'app/config/' . $env . '/', // environment configuration
));

// Instantiate a Slim application:
$app = new \Slim\Slim($config);

// include the routes (always after we've instantiated our app instance)
require 'app/routes.php';

// Run the Slim application:
$app->run();
