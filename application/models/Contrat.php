<?php

class Application_Model_Contrat extends Zend_Db_Table_Abstract
{

protected $_name = 'contrat';

    public function obtenirContrat($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Count not find row $id");
        }
        return $row->toArray();
    }

    public function ajouterContrat($id,$client,$client_id,$voiture,$voiture_id,$date_debut,$date_fin,$prix,$etat)
    {
    	$nbjour=$this->date_diff($date_debut, $date_fin);
    	
        $data = array(
        'id'=>$id,
        	'client'=>$client,
        	'client_id' => $client_id,
        
        	'voiture'=>$voiture,
        	'voiture_id' =>$voiture_id,
        	
            'date_debut' => $date_debut,
        	'date_fin' => $date_fin,
            'nb_jour' =>$nbjour,
        	'prix' => $prix*$nbjour,
        	'etat' => "0",
        
        	
        );
        $this->insert($data);
    }

    public function modifierContrat($id,$client,$client_id,$voiture,$voiture_id,$date_debut,$date_fin,$prix,$etat)
    {
    	$nbjour=$this->date_diff($date_debut, $date_fin);
        $data = array(
        'client'=>$client,
        	 'client_id' => $client_id,
        	'voiture'=>$voiture,
        	'voiture_id' =>$voiture_id,
            'date_debut' => $date_debut,
        	'date_fin' => $date_fin,
        'nb_jour' =>$nbjour,
        	'prix' => $prix*$nbjour,
        	'etat' => $etat,
        	
        );
        $this->update($data, 'id = '. (int)$id);
    }

    public function supprimerContrat($id)
    {
        $this->delete('id =' . (int)$id);
    }
public function date_diff($date1, $date2)  
{
 $s = strtotime($date2)-strtotime($date1)-1;
 $d = intval($s/86400)+1;  
 return "$d";
}
public function regler($id,$etat){
        $data = array(
        'etat'=>$etat,
);
$this->update($data, 'id = '. (int)$id);
}
} 

	
