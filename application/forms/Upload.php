<?php

class Application_Form_Upload extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	$this->setName('upload');
        $this->setAttrib('enctype', 'multipart/form-data');
    	$description = new Zend_Form_Element_Text('description');
        $description->setLabel('Description')
                  ->setRequired(true)
                  ->addValidator('NotEmpty');
    	$file = new Zend_Form_Element_File('file');
        $file->setLabel('File')
        	->addValidator('Size',false,'2MB');
         
            
    	 $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Upload');
         $this->addElements(array($description, $file, $submit));
    }


}

