<?php

namespace App\Controllers;

class BaseController
{
    protected $app;
    
    public function __construct(\Slim\Slim $app)
    {
        $this->app = $app;
    }
}