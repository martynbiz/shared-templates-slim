<?php

namespace App\Controllers;

abstract class BaseController
{
    protected $app;
    protected $user;
    
    public function __construct(\Slim\Slim $app)
    {
        $this->app = $app;
    }
    
    /**
     * Get the current user from the database. Also, cache so we don't have to made redundant queries.
     *
     * @return object User record
     * @author Martyn Bissett
     **/
    public function getUser()
    {
        $userTable = $this->app->config('service.App\Models\User');
        
        if(is_null($this->user)) {
            $this->user = $userTable->find(1);
        }
        
        return $this->user;
    }
    
    // these are just some helper functions to aid controller and make it
    // clearer and neater when performing operations
    
    public function getParams()
    {
        $request = $this->app->request;
        
        if (strpos($request->getContentType(), 'application/json') !== false) {
            // json
            return json_decode($this->app->request->getBody(), true);
        } else {
            // form
            return $request->post();
        }
    }
    
    public function getRequest()
    {
        return $this->app->request;
    }
    
    public function getResponse()
    {
        return $this->app->response;
    }
    
    public function render($templatePath, $data=array())
    {
        return $this->app->render($templatePath, $data);
    }
    
}