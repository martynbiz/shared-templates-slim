<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// require composer autoloader for loading classes
require 'vendor/autoload.php';

// Instantiate a Slim application:
$app = new \Slim\Slim(array(
    'mode' => getenv('APPLICATION_ENV') ?: 'production',
));

// set configuration
require 'app/config.php';

// include the routes (always after we've instantiated our app instance)
require 'app/routes.php';

// setup database for applcation

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => $app->config('database.driver') ?: 'mysql',
    'host'      => $app->config('database.host') ?: 'localhost',
    'database'  => $app->config('database.database'),
    'username'  => $app->config('database.username'),
    'password'  => $app->config('database.password'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

// Run the Slim application:
$app->run();
