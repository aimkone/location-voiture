<?php

class Application_Form_Voiture extends Zend_Form
{
public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	$this->setName('voiture');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        
        $matricule = new Zend_Form_Element_Text('matricule');
        $matricule->setLabel('Matricule')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");

        $modele = new Zend_Form_Element_Text('modele');
        $modele->setLabel('Modele')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");

        $couleur = new Zend_Form_Element_Text('couleur');

        $couleur->setLabel('Couleur')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");
              
               $vidange= new Zend_Form_Element_Text('vidange');
               $vidange->setLabel('Vidange')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");
              
              $date_assur= new Zend_Form_Element_Text('date_assur');
               $date_assur->setLabel('date assurance')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");
              
              $date_change= new Zend_Form_Element_Text('date_change');
               $date_change->setLabel('date changement roues')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");
              
              $nb_cylindre= new Zend_Form_Element_Text('nb_cylindre');
               $nb_cylindre->setLabel('nombre de cylindre')
              ->setRequired(true)
             
              ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");
              
$nb_porte= new Zend_Form_Element_Text('nb_porte');
               $nb_porte->setLabel('nombre de portes')
              ->setRequired(true)
              
              ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");
              
              $prix= new Zend_Form_Element_Text('prix');
               $prix->setLabel('prix')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");

        $envoyer = new Zend_Form_Element_Submit('envoyer');
        $envoyer->setAttrib('id', 'boutonenvoyer');
        
     
     

        $this->addElements(array($id,$modele,$matricule,$couleur,$vidange,$date_assur,$date_change,$nb_cylindre,$nb_porte,$prix,$envoyer));

    }

	

}

