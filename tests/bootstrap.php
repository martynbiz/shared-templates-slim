<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname('../'));

// require composer autoloader for loading classes
require 'vendor/autoload.php';

















// app container class - singleton pattern
class App
{
     // Hold an instance of the class
    private static $instance;
    
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            // Instantiate a Slim application:
            $app = new \Slim\Slim(array(
                'mode' => 'development', //getenv('APPLICATION_ENV') ?: 'production',
            ));

            // set configuration
            require 'app/config.php';
            
            // include the routes (always after we've instantiated our app instance)
            require 'app/routes.php';
            
            self::$instance = $app;
        }
        return self::$instance;
    }
}

















// use Slim\Slim;

// class App extends Slim {
    
//     function __construct(array $userSettings = array())
//     {
//         parent::__construct($userSettings);

//         $this->get('/', function(){
//             echo 'home';
//         })->name('home');

//         $this->get('/hello/:name', function($name){
//             echo "hello $name";
//         })->name('hello');

//         $this->map('/login', function() {
//             if($this->request()->params('login')) {
//                 $this->flash('success', 'Successfully logged in');
//                 $this->redirect($this->urlFor('hello', array('name' => $this->request()->params('login'))));
//             } else {
//                 $this->flash('error', 'Wrong login');
//                 $this->redirect($this->urlFor('home'));
//             }
//         })->via('GET', 'POST');
//     }

//     /**
//      * @return \Slim\Http\Response
//      */
//     public function invoke() {
//         $this->middleware[0]->call();
//         $this->response()->finalize();
//         return $this->response();
//     }
    
// }

// // instance container
// class App
// {
//     private static $app;
    
//     public static function getInstance($method, $path, $options)
//     {
//         // Prepare a mock environment
//         Slim\Environment::mock(array_merge(array(
//             'REQUEST_METHOD' => $method,
//             'PATH_INFO' => $path,   
//             'SERVER_NAME' => 'slim-test.dev',
//         ), $options));
        
//         if (! isset(self::$app)) {
            
//             // Instantiate a Slim application:
//             $app = new \Slim\Slim(array(
//                 'mode' => 'testing',
//             ));

//             // set configuration
//             require 'app/config.php';

//             // include the routes (always after we've instantiated our app instance)
//             require 'app/routes.php';
            
//             self::$app = $app;
//         }

//         return self::$app;
//     }
// }
