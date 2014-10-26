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
}