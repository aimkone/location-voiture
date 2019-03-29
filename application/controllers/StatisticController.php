<?php

class StatisticController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // 
    }

    public function preDispatch()
    {
        $auth = Zend_Auth::getInstance();
                
                		if (!$auth->hasIdentity()) {
                			
                			$this->_redirect('/login/login');
    }
    }
    public function grapheAction()
    {
        // action body
    }

    public function allvoiturestatisticAction()
    {
        // action body
        
                $year=new Zend_Date(Zend_Date::now());
               
               $year= $year->toString('yyyy');
                $this->view->vStat=$this->chiffreAv('voiture','voiture_id','nb_jour');
                $this->view->vStatch=$this->chiffreAv('voiture','voiture_id','prix');
                $this->view->cStatch=$this->chiffreAv('client','client_id','prix');
                  $this->view->cStatclj=$this->chiffreAv('client','client_id','nb_jour');
                 $this->view->vStatJ=$this->mois($year.'-01-01', $year.'-01-31');
                 $this->view->vStatF=$this->mois($year.'-02-01', $year.'-02-28');
                   $this->view->vStatM=$this->mois($year.'-03-01', $year.'-03-31');
                 $this->view->vStatA=$this->mois($year.'-04-01', $year.'-04-30');
                   $this->view->vStatMy=$this->mois($year.'-05-01', $year.'-05-31');
                 $this->view->vStatJu=$this->mois($year.'-06-01', $year.'-06-30');
                   $this->view->vStatJul=$this->mois($year.'-07-01', $year.'-07-31');
                 $this->view->vStatAo=$this->mois($year.'-08-01', $year.'-08-31');
                   $this->view->vStatS=$this->mois($year.'-09-01', $year.'-09-30');
                 $this->view->vStatO=$this->mois($year.'-10-01', $year.'-02-31');
                   $this->view->vStatN=$this->mois($year.'-11-01', $year.'-11-30');
                 $this->view->vStatD=$this->mois($year.'-12-01', $year.'-12-31');
              ;
    }
    private function mois($debut_mois,$fin_mois){
    	$vStat=new Application_Model_Contrat();
    	$select=$vStat->select();
                $select->from($vStat,array('date_fin','chA'=>'SUM(prix)'));
                $select->where('date_fin >= ?', $debut_mois)->where('date_fin <= ?', $fin_mois);
                $vStatv=$vStat->fetchAll($select);
    if ($vStatv==NULL){
                return null;	
                }
               else  return $vStatv;
                 
    }
    private function chiffreAv($tv,$gr,$var){
    	  $vStat=new Application_Model_Contrat();
                $select=$vStat->select();
                $select->from($vStat,array($tv,$gr,'nbj'=>'SUM('.$var.')'));
                $select->group($gr);
                $vStatv=$vStat->fetchAll($select);
                return $vStatv;
    }


}





