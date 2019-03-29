<?php

class Application_Form_Login extends Zend_Form
{


public function init()

    {

       $this->setName('users');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        
        $user = new Zend_Form_Element_Text('username');
        $user->setLabel('utilisateur')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs")
				;
                $pwd = new Zend_Form_Element_Password('password');
        $pwd->setLabel('mot de passe')
        
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')-> addErrorMessage("vous devez remplir ce champs");
               
                
        $login = new Zend_Form_Element_Submit('login');
        $login->setAttrib('id', 'button');
       
               
               
                $this->addElements(array($id,$user,$pwd,$login));
 

    }

}




