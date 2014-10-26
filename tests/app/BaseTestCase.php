<?php

// use Slim\Environment;

// class BaseTestCase extends PHPUnit_Framework_TestCase {
    
//     public function setUp()
//     {
//         $_SESSION = array();
//     }
    
//     public static function get($path)
//     {
//         Environment::mock(array(
//             'REQUEST_METHOD' => 'GET',
//             'PATH_INFO' => $path,
//         ));
        
//         $app = App::getInstance();
        
//         //$app->middleware[0]->call();
//         $app->response()->finalize();
//         return $app->response();
//     }
// }