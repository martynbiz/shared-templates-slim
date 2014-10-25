<?php

namespace App\Controllers;

use App\Models\Account;

class AccountsController extends BaseController
{
    public function index()
    {
        $accounts = Account::all();
        
        $this->app->render('accounts/index.php', array(
            'accounts' => $accounts->toArray(),
        ));
    }
    
    public function show($id)
    {
        $account = Account::find($id);
        
        $this->app->render('accounts/show.php', array(
            'account' => $account->toArray(),
        ));
    }
    
    public function create()
    {
        $params = $this->app->request->post();
        
        if ($this->app->request->isPost()) {
            
            $account = new Account();
            
            $account->name = $params['name'];
            $account->amount = $params['amount'];
            $account->user_id = 1;
            
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
            
            $account = Account::find($id);
            
            $account->name = $params['name'];
            $account->amount = $params['amount'];
            
            if($account->save()) {
                $this->app->redirect('/accounts/' . $id);
            } else {
                // set some errors
            }
        }
        
        $account = Account::find($id);
        
        $account = array_merge($account->toArray(), $params);
        
        $this->app->render('accounts/update.php', array(
            'account' => $account,
        ));
    }
    
    public function delete($id)
    {
        if ($this->app->request->isDelete()) {
            Account::destroy($id);
            $this->app->redirect('/accounts');
        }
        
        $account = Account::find($id);
        
        $this->app->render('accounts/delete.php', array(
            'account' => $account,
        ));
    }
    
}