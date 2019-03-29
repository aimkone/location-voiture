<?php

class Application_Model_Client extends Zend_Db_Table_Abstract
{
 protected $_name = 'client';
public  $ar=array();

    public function obtenirClient($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Count not find row $id");
        }
        return $row->toArray();
    }
public function obtenirAllClient()
    {
    	
$select=$this->select()
			->from($this,array('id','cin','nom','prenom'))
			->where('disponible = 1 ');
			$col=$this->fetchAll($select);
			$col=$col->toArray();
    for($i=0;$i<sizeof($col);$i++){
    	$id[$i]=$col[$i]['id'];
        $cin[$i]=$col[$i]['cin'];	
        $nom[$i]=$col[$i]['nom'];
        $pnom[$i]=$col[$i]['prenom'];
        $tot[$i]=$nom[$i]."  ".$pnom[$i]." ,cin: ".$cin[$i];
        $tf[$i][0]=$id[$i];
        $tf[$i][1]=$nom[$i]." ".$pnom[$i];
        }
       $this->ar=$tf;
        return $tf;
    }

    public function ajouterClient($cin,$nom, $prenom,$date_ne,$adresse,$passport,$permis,$telephone)
    {
        $data = array(
        	'cin' =>$cin,
            'nom' => $nom,
            'prenom' => $prenom,
        	'adresse' => $adresse,
        	'passport'=>$passport,
        	'n_permis'=>$permis,
            'telephone' => $telephone,
        	'Date_naissance'=>$date_ne,
        	
        );
        $this->insert($data);
    }

    public function modifierClient($id,$cin,$nom, $prenom,$date_ne,$adresse,$passport,$permis,$telephone)
    {
        $data = array(
        	'cin' =>$cin,
            'nom' => $nom,
            'prenom' => $prenom,
        	'adresse' => $adresse,
        	'passport'=>$passport,
        	'n_permis'=>$permis,
            'telephone' => $telephone,
        	'Date_naissance'=>$date_ne,
        	
        	
        );
        $this->update($data, 'id = '. (int)$id);
    }
   public function  dispClient($id,$d){
   	$data = array(
        	'disponible' =>$d,);
   	$this-> update($data,'id = '. (int)$id);
   }

    public function supprimerClient($id)
    {
        $this->delete('id =' . (int)$id);
    }
    

}

