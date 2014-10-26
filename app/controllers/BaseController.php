<?php

namespace App\Controllers;

class BaseController
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
}