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
        $request = $this->getRequest();
        $user = $this->getUser();
        
        $accounts = $user->accounts;
        
        // this is what we return to the client/template
        $data = array(
            'accounts' => $accounts->toArray()
        );
        
        if ($request->isAjax()) {
            $response = $this->getResponse();
            
            $response->setStatus(200);
            return $response->setBody( json_encode($data) );
        } else {    
            $this->render('accounts/index.php', $data);
        }
    }
    
    public function show($id)
    {
        $request = $this->getRequest();
        $user = $this->getUser();
        
        $accounts = $user->accounts;
        $account = $accounts->find($id);
        
        // this is what we return to the client/template
        $data = $account->toArray();
        
        if ($request->isAjax()) {
            $response = $this->getResponse();
            
            $response->setStatus(200);
            return $response->setBody( json_encode($data) );
        } else {    
            $this->render('accounts/show.php', $data);
        }
    }
    
    public function create()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();
        
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
        
        // this is what we return to the client/template
        $data = $params->toArray();
        
        $this->render('accounts/create.php', $data);
    }
    
    public function update($id)
    {
        $request = $this->getRequest();
        $response = $this->getResponse();
        
        // we put this here as it is used for the merge later even if empty
        $params = $request->post();
        
        if ($this->getRequest()->isPut()) {
            
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
        
        $account = $this->accountsTable->find($id)->toArray();
        
        // this is what we return to the client/template
        $data = array_merge($account, $params);
        
        $this->render('accounts/update.php', $data);
    }
    
    public function delete($id)
    {
        if ($this->getRequest()->isDelete()) {
            $this->accountsTable->destroy($id);
            $this->app->redirect('/accounts');
        }
        
        $accounts = $this->getUser()->accounts;
        $account = $accounts->find($id);
        
        // this is what we return to the client/template
        $data = $account->toArray();
        
        $this->render('accounts/delete.php', $data);
    }
    
}