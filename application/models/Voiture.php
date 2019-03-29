<?php

class Application_Model_Voiture extends Zend_Db_Table_Abstract
{
 protected $_name = 'voiture';

    public function obtenirVoiture($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Count not find row $id");
        }
        return $row->toArray();
    }
public function obtenirIAllVoiture()
    {
    	$select=$this->select()
			->from($this,array('id','modele','matricule'))
			-> where('disponible=1');
			$col=$this->fetchAll($select);
    	$col=$col->toArray();
      for($i=0;$i<sizeof($col);$i++){
        $designation[$i]=$col[$i]['modele']." : ".$col[$i]['matricule'];
        $id[$i]=$col[$i]['id'];
        $p[$i][0]=$designation[$i];
         $p[$i][1]= $id[$i];
        }

        
        
        return $p;
    }

    public function ajouterVoiture($modele,$matricule,$couleur,$vidange,$date_assur,$date_change,$nb_cylind,$nb_port,$prix)
    {
        $data = array(
        	'modele' => $modele,
        	'matricule' =>$matricule,
            'couleur' => $couleur,
        	'vidange' => $vidange,
        	'date_assur'=>$date_assur,
        	'date_change'=>$date_change,
        	'nb_cylindre'=>$nb_cylind,
        	'nb_porte'=>$nb_port,
        	'prix'=>$prix,
        
        	
        );
        $this->insert($data);
    }

    public function modifierVoiture($id,$modele,$matricule,$couleur,$vidange,$date_assur,$date_change,$nb_cylind,$nb_port,$prix)
    {
        $data = array(
        	 'modele' => $modele,
        	'matricule' =>$matricule,
            'couleur' => $couleur,
        	'vidange' => $vidange,
        	'date_assur'=>$date_assur,
        	'date_change'=>$date_change,
        	'nb_cylindre'=>$nb_cylind,
        	'nb_porte'=>$nb_port,
        	'prix'=>$prix,
        	
        );
        $this->update($data, 'id = '. (int)$id);
    }
public function reglerassur($id,$date){
	$datez=new Zend_Date($date);
	$datef=$datez->addYear(1);
        $data = array(
        'date_assur'=>$datef->toString('yyyy-MM-dd'),
);
$this->update($data, 'id = '. (int)$id);
}
    public function supprimerVoiture($id)
    {
        $this->delete('id =' . (int)$id);
    }
public function  dispVoiture($id,$d){
   	$data = array(
        	'disponible' =>$d,);
   	$this-> update($data,'id = '. (int)$id);
   }
}

