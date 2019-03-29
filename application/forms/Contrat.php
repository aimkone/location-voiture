<?php

class Application_Form_Contrat extends Zend_Form
{

    public function init()
    {$date_now=new Zend_Date(Zend_Date::now());
        /* Form Elements & Other Definitions Here ... */
  /* Form Elements & Other Definitions Here ... */
    	$this->setDisableLoadDefaultDecorators(true);
    	$this->setName('contrat');

        $id = new Zend_Form_Element_Text('id');
        $id->addFilter('Int');
        $id->setLabel('contrat numero:');
        $voiture_id = new Zend_Form_Element_Hidden('id');
        $voiture_id->addFilter('Int');

        $date_debut = new Zend_Form_Element_Text('date_debut');

        $date_debut->setLabel('date de debut:')
              ->setRequired(true)
              ->setValue($date_now->toString('yyyy-MM-dd'))
              ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");
              
              
                $date_fin = new Zend_Form_Element_Text('date_fin');
              $date_fin->setLabel('Date de fin')
              ->setValue($date_now->toString('yyyy-MM').'-')
                ->setRequired(true)
                
                ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");

        $prix= new Zend_Form_Element_Text('prix');

        $prix->setLabel('Prix')
              ->setRequired(true)
              ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs")
        	
              ;

		$clientid=new Application_Model_Client();
		$cl=$clientid-> obtenirAllClient();
		$selectC=new Zend_Form_Element_Select('selectC');
		
			$selectC->setLabel('client  : ');
			
		
	for($i=0;$i<sizeof($cl);$i++){
					$selectC->addMultiOptions(array($cl[$i][0]=>$cl[$i][1]));	
	}	
       
        
		$voitureid=new Application_Model_Voiture();
		

$vo=$voitureid->obtenirIAllVoiture();
		$selectV=new Zend_Form_Element_Select('selectV');
			
			$selectV->setLabel('voiture : ');
			for($i=0;$i<sizeof($vo);$i++){
			$selectV->addMultiOptions(array($vo[$i][1]=>$vo[$i][0]));
			}
			
			 $client_id = new Zend_Form_Element_Hidden('id');
        $client_id->addFilter('Int');
         $voiture_id = new Zend_Form_Element_Hidden('id');
        $voiture_id->addFilter('Int');
        $envoyer = new Zend_Form_Element_Submit('envoyer');
        $envoyer->setAttrib('id', 'boutonenvoyer');
        
     
     

        $this->addElements(array($id,$selectC,$selectV,$date_debut, $date_fin, $prix,$envoyer));
    }


}