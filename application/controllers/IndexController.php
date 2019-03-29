<?php

class IndexController extends Zend_Controller_Action
{

public function init()
	{
		
	}

    public function indexAction()
    {
   
    // notification en  cas fin d'assurence
    
			 $notVoiture=new Application_Model_Voiture();
			 $assur=$notVoiture->select()
			->from($notVoiture,array('id','date_assur'));
		
			$this->view->assur=$notVoiture->fetchAll($assur);
			
	//cacule de chiffre d'affaire global
			
			$notchiffre=new Application_Model_Contrat();
			 $chiffre=$notchiffre->select()
			->from($notchiffre,array('id','pr'=>'SUM(prix)'))
			->where('etat=1');
	$this->view->chiffreAf=$notchiffre->fetchAll($chiffre);
	
	//nombre de jour global d'utilisation   des voiture
	
	$typeVoiture=new Application_Model_Contrat();
	$chiffre2=$typeVoiture->select()
			->from($typeVoiture,array('id','bj'=>'SUM(nb_jour)'));
			$nbj=$typeVoiture->fetchAll($chiffre2);
	$this->view->nbj=$nbj;
	
	
	   }
function preDispatch()
	{
		$auth = Zend_Auth::getInstance();

		if (!$auth->hasIdentity()) {
			
			$this->_redirect('/login/login');
		}
		
	}
}

