<?php

class VoitureController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->title = "gestion de voiture";
            $this->view->headTitle($this->view->title, 'PREPEND');
            $voiture = new Application_Model_Voiture();
            $this->view->voiture = $voiture->fetchAll(null);
    }

    public function ajouterAction()
    {
        // action body
            $form = new Application_Form_Voiture();
            $form->envoyer->setLabel('Ajouter');
           
            $this->view->form = $form;
        
            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                	$matricule = $form->getValue('matricule');
                    $modele = $form->getValue('modele');
                    $couleur = $form->getValue('couleur');
                    $vidange = $form->getValue('vidange');
                    $date_assur = $form->getValue('date_assur');
                    $date_change = $form->getValue('date_change');
                    $nb_cylind = $form->getValue('nb_cylindre');
                    $nb_port = $form->getValue('nb_porte');
                    $prix = $form->getValue('prix');
                    $voiture = new Application_Model_Voiture();
                    $voiture->ajouterVoiture($modele,$matricule,$couleur,$vidange,$date_assur,$date_change,$nb_cylind,$nb_port,$prix);
        
                    $this->_helper->redirector('index');
                } else {
                $err="veuiller remplir le formulaire correctement";
                $this->view->err=$err;
                    //$form->populate($formData);
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
                    $voiture = new Application_Model_Voiture();
                    $voiture->supprimerVoiture($id);
                }
        
                $this->_helper->redirector('index');
            } else {
                $id = $this->_getParam('id', 0);
                $voiture= new Application_Model_Voiture();
                $this->view->voiture = $voiture->obtenirVoiture($id);
    }
    }
    public function modifierAction()
    {
        // action body
            $form = new Application_Form_Voiture();
            $form->envoyer->setLabel('Sauvegarder');
            $this->view->form = $form;
        
            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                	
                    $id = $form->getValue('id');
                    $matricule = $form->getValue('matricule');
                    $modele = $form->getValue('modele');
                    $couleur = $form->getValue('couleur');
                    $vidange = $form->getValue('vidange');
                    $date_assur = $form->getValue('date_assur');
                    $date_change = $form->getValue('date_change');
                    $nb_cylind = $form->getValue('nb_cylindre');
                    $nb_port = $form->getValue('nb_porte');
                    $prix = $form->getValue('prix');
                    $voiture = new Application_Model_Voiture();
                    $voiture->modifierVoiture($id,$modele,$matricule,$couleur,$vidange,$date_assur,$date_change,$nb_cylind,$nb_port,$prix);
                    
        
                    $this->_helper->redirector('index');
                } else {
        		
                 $form->populate($formData);
                }
            } else {
                $id = $this->_getParam('id', 0);
                if ($id > 0) {
                    $voiture = new Application_Model_Voiture();
                    $form->populate($voiture->obtenirVoiture($id));
                }
    }
    }

    public function obtenirAction()
    {
        // action body
                 
            	$id = $this->_getParam('id', 0);
            
                
                $voiture = new Application_Model_Voiture();
              
                $this->view->voiture=  $voiture->obtenirVoiture($id);
    }
    
    
    
 public function reglerassurAction()
    {
    $id = $this->_getParam('id', 0);
                if ($id > 0) {
                    $voiture = new Application_Model_Voiture();
                    $vo=$voiture->obtenirVoiture($id);
                    $voiture->reglerassur($id,$vo['date_assur']);
                }
                
                    $this->_redirect('/');
                
    }
    public function preDispatch()
    {
        $auth = Zend_Auth::getInstance();
        
        		if (!$auth->hasIdentity()) {
        			$this->_redirect('/login/login');
    }
    }
    
   


}

