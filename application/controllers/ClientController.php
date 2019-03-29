<?php

class ClientController extends Zend_Controller_Action
{


    public function init()
    {
        
    }

    public function indexAction()
    {
        $this->view->title = "gestion client";
    $this->view->headTitle($this->view->title, 'PREPEND');
    $client = new Application_Model_Client();
    $order='ORDER BY contrat ASC';
    $this->view->client = $client->fetchAll(null);
    }

    public function ajouterAction()
    {
        // action body
    $form = new Application_Form_Client();
    $form->envoyer->setLabel('Ajouter');
   
    $this->view->form = $form;

    if ($this->getRequest()->isPost()) {
        $formData = $this->getRequest()->getPost();
        if ($form->isValid($formData)) {
        	$passport=$form->getValue('passport');
        	$permis=$form->getValue('n_permis');
        	$cin = $form->getValue('cin');
            $nom = $form->getValue('nom');
            $prenom = $form->getValue('prenom');
            $date_ne = $form->getValue('Date_naissance');
            $adresse = $form->getValue('adresse');
            $telephone = $form->getValue('telephone');
            $client = new Application_Model_Client();
            $client->ajouterClient($cin,$nom, $prenom,$date_ne,$adresse,$passport,$permis,$telephone);

            $this->_helper->redirector('index');
        } else {
            $form->populate($formData);
        }
    }
    }

    public function supprimerAction()
    {
        // action body
    if ($this->getRequest()->isPost()) {
        $supprimer = $this->getRequest()->getPost('supprimer');
       
        if ($supprimer == 'Oui') { 
            $id = $this->getRequest()->getPost('id');
            $client = new Application_Model_Client();
            $client->supprimerClient($id);
        }

        $this->_helper->redirector('index');
    } else {
    
        $id = $this->_getParam('id', 0);
        $client = new Application_Model_Client();
        $this->view->client = $client->obtenirClient($id);
    }
    }

    public function modifierAction()
    {
        // action body
    $form = new Application_Form_Client();
    $form->envoyer->setLabel('Sauvegarder');
    $this->view->form = $form;

    if ($this->getRequest()->isPost()) {
        $formData = $this->getRequest()->getPost();
        if ($form->isValid($formData)) {
        
            $id = $form->getValue('id');
            $passport=$form->getValue('passport');
        	$permis=$form->getValue('n_permis');
        	$cin = $form->getValue('cin');
            $nom = $form->getValue('nom');
            $prenom = $form->getValue('prenom');
            $date_ne = $form->getValue('Date_naissance');
            $adresse = $form->getValue('adresse');
            $telephone = $form->getValue('telephone');
            $client = new Application_Model_Client();
            $client->modifierClient($id,$cin,$nom, $prenom,$date_ne,$adresse,$passport,$permis,$telephone);
            

            $this->_helper->redirector('index');
        } else {
		
         $form->populate($formData);
        }
    } else {
        $id = $this->_getParam('id', 0);
        if ($id > 0) {
            $client = new Application_Model_Client();
            $form->populate($client->obtenirClient($id));
        }
    }
    }

    public function obtenirAction()
    {
        // action body
        
    	$id = $this->_getParam('id', 0);
    
        
        $client = new Application_Model_Client();
      
        $this->view->client=  $client->obtenirClient($id);
        
     
    }
function preDispatch()
	{
		$auth = Zend_Auth::getInstance();

		if (!$auth->hasIdentity()) {
			
			$this->_redirect('/login/login');
		}
	}

}









