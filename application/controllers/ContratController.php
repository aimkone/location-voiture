<?php

class ContratController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
                        
                        $this->view->title = "gestion de contrat";
                    $this->view->headTitle($this->view->title, 'PREPEND');
                    $contrat = new Application_Model_Contrat();
                    $this->view->contrat = $contrat->fetchAll(null,"id DESC",null,null);
    }

    public function supprimerAction()
    {
        // action body
                    
                        // action body
                    if ($this->getRequest()->isPost()) {
                        $supprimer = $this->getRequest()->getPost('supprimer');
                        if ($supprimer == 'Oui') {
                            $id = $this->getRequest()->getPost('id');
                            $contrat = new Application_Model_Contrat();
                             
                            $ctr=$contrat->fetchRow('id = '.$id);
                            $contrat->supprimerContrat($id);
                            $client=new Application_Model_Client();
                            $voiture=new Application_Model_Voiture();
                            $client-> dispClient($ctr['client_id'],1); 
               				$voiture-> dispVoiture($ctr['voiture_id'],1)  ;
                        }
                
                        $this->_helper->redirector('index');
                    } else {
                        $id = $this->_getParam('id', 0);
                        $contrat = new Application_Model_Contrat();
                        $this->view->contrat = $contrat->obtenirContrat($id);
                    }
    }

    public function ajouterAction()
    {
        // action body
                     $form = new Application_Form_Contrat();
                    $form->envoyer->setLabel('Ajouter');
                   $client = new Application_Model_Client();
                   $t=$client->fetchAll();
                    $this->view->form = $form;
                
                    if ($this->getRequest()->isPost()) {
                        $formData = $this->getRequest()->getPost();
                        if ($form->isValid($formData)) {
                        	$id=$form->getValue('id');
                        	$date_debut = $form->getValue('date_debut');
                            $date_fin = $form->getValue('date_fin');
                        	if($date_debut<= $date_fin){
                        	/////////////////////////////////////////////////////
                        	$client_id = $form->getValue('selectC');
                        	$client=new Application_Model_Client();
                        	$Client=$client->obtenirClient($client_id);
                        	$Client=$Client['nom'];
                //////////////////////////////////////////////////////
                            $voiture_id = $form->getValue('selectV');
                            $voiture=new Application_Model_Voiture();
                        	$Voiture=$voiture->obtenirVoiture($voiture_id);
                        	$vmodele=$Voiture['modele'];
                           
                            if($form->getValue('prix')==0){
                            	 $prix=$Voiture['prix'];
                            	
                            }else{
                            	$prix=$form->getValue('prix');
                            }
                            
                            
                            $contrat = new Application_Model_Contrat();
                            $contrat->ajouterContrat($id,$Client,$client_id,$vmodele, $voiture_id, $date_debut, $date_fin
                            , $prix);
               $client-> dispClient($client_id,0)  ;
               $voiture-> dispVoiture($voiture_id,0)  ;
                            $this->_helper->redirector('index');
                        	}
                        else{
                        	echo "verifier date debut et date fin";
                        }
                        } else {
                            $form->populate($formData);
                        }
    }
    }
    public function modifierAction()
    {
        // action body
                     $form = new Application_Form_Contrat();
                    $form->envoyer->setLabel('Sauvegarder');
                    $this->view->form = $form;
                
                    if ($this->getRequest()->isPost()) {
                        $formData = $this->getRequest()->getPost();
                        if ($form->isValid($formData)) {
                        	$id = $this->_getParam('id', 0);
                        	$client_id = $form->getValue('selectC');
                        	$Client=new Application_Model_Client();
                        	$Client=$Client->obtenirClient($client_id);
                        	$Client=$Client['nom'];
                ////////////////////////////////////////////////////////////
                            $voiture_id = $form->getValue('selectV');
                            $voiture=new Application_Model_Voiture();
                        	$voiture=$voiture->obtenirVoiture($voiture_id);
                        	$vmodele=$voiture['modele'];
                            $prix=$voiture['prix'];
                            
                            $date_debut = $form->getValue('date_debut');
                            $date_fin = $form->getValue('date_fin');
                           // $prix = $form->getValue('prix');
                            $contrat = new Application_Model_Contrat();
                            $contrat->modifierContrat($id,$Client,$client_id,$vmodele, $voiture_id, $date_debut, $date_fin, $prix);
                
                            $this->_helper->redirector('index');
                        } else {
                		
                         $form->populate($formData);
                        }
                    } else {
                        $id = $this->_getParam('id', 0);
                        if ($id > 0) {
                            $contrat = new Application_Model_Contrat();
                            $cont=$contrat->obtenirContrat($id);
                            
                            $this->view->contrat=$cont;
                            
                            $form->populate($cont);
                            
                            
                        }
    }
    }
    public function obtenirAction()
    {
        // action body
    }

    

    public function imprimerAction()
    {
        // action body
                $id = $this->_getParam('id', 0);
                        $contrat = new Application_Model_Contrat();
                        $contra=$contrat->obtenirContrat($id);
                       $client=new Application_Model_Client();
                      $client=$client->obtenirClient($contra['client_id']);
                       $voiture=new Application_Model_Voiture();
                      $voiture=$voiture->obtenirVoiture($contra['voiture_id']);
                        $this->view->contrat =$contra ;
                         $this->view->client =$client ;
                        $this->view->voiture =$voiture ;
    }
    
    public function reglerAction()
    {
      //
     if ($this->getRequest()->isPost()) {
                        $regle = $this->getRequest()->getPost('regler');
                        if ($regle == 'reg') {
                            $id = $this->getRequest()->getPost('id');
                             $regler=new Application_Model_Contrat();
     							 $regler-> regler($id,1); 
     							 $regler=$regler->fetchRow('id = '.$id);
     							 $client=new Application_Model_Client();
                            $voiture=new Application_Model_Voiture();
                            $client-> dispClient($regler['client_id'],1); 
               				$voiture-> dispVoiture($regler['voiture_id'],1);
     					
                        }
     if ($regle == 'n-reg') {
                            $id = $this->getRequest()->getPost('id');
                             $regler=new Application_Model_Contrat();
     							 $regler-> regler($id,0);
     							 $regler=$regler->fetchRow('id = '.$id);
     							 $client=new Application_Model_Client();
                            $voiture=new Application_Model_Voiture();
                            $client-> dispClient($regler['client_id'],1); 
               				$voiture-> dispVoiture($regler['voiture_id'],1);
     					
                        }
    $this->_helper->redirector('index');
                    } else {
                        $id = $this->_getParam('id', 0);
                        $contrat = new Application_Model_Contrat();
                        $this->view->contrat = $contrat->obtenirContrat($id);
                    }
    }

public function preDispatch()
    {
        $auth = Zend_Auth::getInstance();
                
                		if (!$auth->hasIdentity()) {
                			$this->_redirect('/login/login');
    }
    }

    
}










