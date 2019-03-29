<?php

class Application_Model_Login extends Zend_Db_Table_Abstract
{
protected $_name = 'users';
public function getLogin($user,$pwd)
    {
      $select=$this->select()
			->from($this,array('username','password'));
        $row = $this->fetchRow('username = ' . $user ,'password= '.$pwd);
        if (!$row) {
            return false;
        }else{
        return true;
        }
    }
}

