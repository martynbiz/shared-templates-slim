<?php
 
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname('../'));

// require composer autoloader for loading classes
require 'vendor/autoload.php';

use Slim\Environment;

class RoutesTest extends PHPUnit_Framework_TestCase
{
    public function request($method, $path, $options = array())
    {
        // Capture STDOUT
        ob_start();
         
        // Prepare a mock environment
        Environment::mock(array_merge(array(
            'REQUEST_METHOD' => $method,
            'PATH_INFO' => $path,
            'SERVER_NAME' => 'slim-test.dev',
        ), $options));
         
        $app = new \Slim\Slim();
        $this->app = $app;
        $this->request = $app->request();
        $this->response = $app->response();
         
        // Return STDOUT
        return ob_get_clean();
    }
     
    public function get($path, $options = array())
    {
        $this->request('GET', $path, $options);
    }
     
    public function testIndex()
    {
        $viewMock = $this->getMockBuilder('service.App\Models\Account')
            ->disableOriginalConstructor()
            ->getMock();
        $viewMock->expects( $this->once() )
            ->method('all')
            ->will( $this->returnValue('<h2>Accounts</h2>') );
        
        // set up app
        
        $app->config('service.App\Models\Account');
        
        // 
        
        $this->get('/accounts');
        
        $this->assertEquals('200', $this->response->status());
    }
}

// use Slim\Environment;

// class AccountsControllerTest extends PHPUnit_Framework_TestCase {
    
//     // public function testGetMethod()
//     // {
//     //     $env = \Slim\Environment::mock(array(
//     //         'REQUEST_METHOD' => 'GET'
//     //     ));
//     //     $req = new \Slim\Http\Request($env);
//     //     $this->assertEquals('GET', $req->getMethod());
        
//     //     $response = $this->get('/accounts');
//     // }
    
//     // // public function setUp()
//     // // {
//     // //     $_SESSION = array();
//     // // }
    
//     public static function get($path)
//     {
//         Environment::mock(array(
//             'REQUEST_METHOD' => 'GET',
//             'PATH_INFO' => $path,
//         ));
        
//         $app = App::getInstance();
        
//         //$app->middleware[0]->call();
//             $app->response()->finalize(); // http://docs.slimframework.com/#Response-Helpers
//         return $app->response();
//     }
    
//     public function testIndex() {
        
//         $response = $this->get('/accounts');

//         $this->assertContains('Accounts', $response->getBody());
//     }
    
//     // $env = \Slim\Environment::mock(array(
//     //     'REQUEST_METHOD' => 'POST',
//     //     'slim.input' => 'foo=bar&abc=123',
//     //     'CONTENT_TYPE' => 'application/x-www-form-urlencoded',
//     //     'CONTENT_LENGTH' => 15
//     //     ));
//     //     $req = new \Slim\Http\Request($env);
//     //     $this->assertEquals(2, count($req->post()));
//     //     $this->assertEquals('bar', $req->post('foo'));
//     //     $this->assertNull($req->post('xyz'));
//     //     $this->assertFalse($req->post('xyz', false));
//     // }
// }