<?php

class UploadController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
     // action body
         $this->view->headTitle('Home');
        $this->view->title = 'Zend_Form_Element_File Example';
        $this->view->bodyCopy = "<p>Please fill out this form.</p>";

        $form = new Application_Form_Upload();

        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {

                // success - do something with the uploaded file
                $uploadedData = $form->getValues();
                $fullFilePath = $form->file->getFileName();
               
$upload=new Zend_File_Transfer_Adapter_Http();

	$upload->setDestination(APPLICATION_PATH.'/uploads/');

print_r(APPLICATION_PATH . '/uploads/dir');

            try {
 // upload received file(s)
$upload->receive();
exec(rename($fullFilePath, APPLICATION_PATH . '/uploads/dir/'.$form->description->getValue().'.png'));
$this->_redirect('/');

 } catch (Zend_File_Transfer_Exception $e) {
 echo "error";
 }
                


            } else {
                $form->populate($formData);
            }
        }

        $this->view->form = $form;
    }
    	
   

    public function uploadAction()
    {
       
 }
}



