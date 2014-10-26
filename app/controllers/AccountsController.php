<?php

namespace App\Controllers;

use App\Models\Account;

class AccountsController extends BaseController
{
    protected $accountsTable;
    
    public function __construct($app)
    {
        parent::__construct($app);
        
        $this->accountsTable = $this->app->config('service.App\Models\Account');
    } 
    
    public function index()
    {
        $request = $this->app->request;
        $response = $this->app->response;
        
        $accounts = $this->getUser()->accounts;
        
        if ($request->isAjax()) {
            $response->setStatus(200);
            return $response->setBody( json_encode($accounts->toArray()) );
        } else {    
            $this->app->render('accounts/index.php', array(
                'accounts' => $accounts->toArray(),
            ));
        }
    }
    
    public function show($id)
    {
        $request = $this->app->request;
        $response = $this->app->response;
        
        $accounts = $this->getUser()->accounts;
        $account = $accounts->find($id);
        
        if ($request->isAjax()) {
            //$response->setStatus(200);
            //return $response->setBody( json_encode($account->toArray()) );
        } else {    
            $this->app->render('accounts/show.php', array(
                'account' => $account->toArray(),
            ));
        }
    }
    
    public function create()
    {
        $request = $this->app->request;
        $response = $this->app->response;
        
        $params = $this->getParams();
        
        if ($request->isPost()) { 
            
            $user = $this->getUser(); 
            
            $account = $this->accountsTable->create(array(
                'name' => $params['name'],
                'amount' => $params['amount'],
                'user_id' => $user->id,
            ));
            
            if($account->save()) {
                if ($request->isAjax()) {
                    $response->setStatus(201);
                    return $response->setBody( json_encode($account->toArray()) );
                } else {
                    $this->app->redirect('/accounts');
                }
            } else {
                // set some errors
            }
        }
        
        $this->app->render('accounts/create.php', array(
            'account' => $params,
        ));
    }
    
    public function update($id)
    {
        $request = $this->app->request;
        $response = $this->app->response;
        
        $params = $this->app->request->post();
        
        if ($this->app->request->isPut()) {
            
            $accounts = $this->getUser()->accounts;
            $account = $accounts->find($id);
            
            $account->name = $params['name'];
            $account->amount = $params['amount'];
            
            if($account->save()) {
                $this->app->redirect('/accounts/' . $id);
            } else {
                // set some errors
            }
        }
        
        $account = $this->accountsTable->find($id);
        
        $account = array_merge($account->toArray(), $params);
        
        $this->app->render('accounts/update.php', array(
            'account' => $account,
        ));
    }
    
    public function delete($id)
    {
        if ($this->app->request->isDelete()) {
            $this->accountsTable->destroy($id);
            $this->app->redirect('/accounts');
        }
        
        $accounts = $this->getUser()->accounts;
        $account = $accounts->find($id);
        
        $this->app->render('accounts/delete.php', array(
            'account' => $account,
        ));
    }
    
}