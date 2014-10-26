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
        $accounts = $this->getUser()->accounts;
        
        $this->app->render('accounts/index.php', array(
            'accounts' => $accounts->toArray(),
        ));
    }
    
    public function show($id)
    {
        $accounts = $this->getUser()->accounts;
        $account = $accounts->find($id);
        
        $this->app->render('accounts/show.php', array(
            'account' => $account->toArray(),
        ));
    }
    
    public function create()
    {
        $params = $this->app->request->post();
        
        if ($this->app->request->isPost()) {
            
            $account = $this->accountsTable->create(array(
                'name' => $params['name'],
                'amount' => $params['amount'],
                'user_id' => 1,
            ));
            
            if($account->save()) {
                $this->app->redirect('/accounts');
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