<?php

class LoginController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
    	
    	
        // action body
         $form = new Application_Form_Login();
   $this->view->form = $form;
    if ($this->getRequest()->isPost()) {
        
   
            $user = $this->getRequest()->getPost('username');
            $pwd = $this->getRequest()->getPost('password');
            $authAdapter=$this->getAuthAdapter();
            $username=$user;
            $pass=md5($pwd);
            $authAdapter->setIdentity($username)
            			->setCredential($pass);
        $auth=Zend_Auth::getInstance();
        $authentification=$auth->authenticate($authAdapter);
        
        if($authentification->isValid()){
        	$identity=$authAdapter->getResultRowObject();
        	$authStorage=$auth->getStorage();
        	$authStorage->write($identity);
        	$this->_redirect('/');
        }else{
        	echo "invalid combinaison utilisateur/mot de passe ";
        }
        

      
    } 
  
    }
 public function logoutAction()
    {
    	Zend_Auth::getInstance()->clearIdentity();
    $this->_helper->redirector('login');
    }
    private function getAuthAdapter(){
    	$authAdapter=new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
    	$authAdapter->setTableName('users')
    				->setIdentityColumn('username')
    				->setCredentialColumn('password');
    		return $authAdapter;
    }

    }






