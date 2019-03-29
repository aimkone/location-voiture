<?php

class Application_Form_Client extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	$this->setName('client');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        
        $cin = new Zend_Form_Element_Text('cin');
        $cin->setLabel('CIN')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs")
				;
                $permis = new Zend_Form_Element_Text('n_permis');
        $permis->setLabel('n°permis')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");
                $passport = new Zend_Form_Element_Text('passport');
        $passport->setLabel('passport')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");
        
                
                
       $nom = new Zend_Form_Element_Text('nom');
        $nom->setLabel('Nom')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");

        $prenom = new Zend_Form_Element_Text('prenom');

        $prenom->setLabel('Prenom')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");
              
               $date_ne = new Zend_Form_Element_Text('Date_naissance');

        $date_ne->setLabel('date de naissance:')
              ->setRequired(true)
              ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");
              
                $adresse = new Zend_Form_Element_Text('adresse');
              $adresse->setLabel('Adresse')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");

        $telephone= new Zend_Form_Element_Text('telephone');

        $telephone->setLabel('Telephone')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs")
        	
              ;


        $envoyer = new Zend_Form_Element_Submit('envoyer');
        $envoyer->setAttrib('id', 'boutonenvoyer');
        
     
     

        $this->addElements(array($id, $nom, $prenom,$date_ne,$cin,$passport,$permis,$adresse,$telephone, $envoyer));
    }


}

