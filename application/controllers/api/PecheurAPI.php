<?php

class PecheurAPI extends CI_Controller {
    public function __construct() {
        parent::__construct();
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Header:*');
    }

    public function update(){
        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);
        $confidentiel = false;
        if($obj['pecheur_confidentialite'] == 't'){
            $confidentiel = true;
        }
        // Formatage de la date d'enquête
        // $date_create = date_create($obj['pecheur_date_de_naissance']);
        // $date_naissance = date_format($date,"Y/m/d");
        $pecheur = array(

            'pecheur_nom' => $obj['pecheur_nom'],
    
            'pecheur_prenom' => $obj['pecheur_prenom'],
      
            'pecheur_date_de_naissance' => $obj['pecheur_date_de_naissance'],
      
            'pecheur_sexe' => $obj['pecheur_sexe'],
  
            'pecheur_telephone' => $obj['pecheur_telephone'],
  
            'pecheur_mail' => $obj['pecheur_mail'],
  
            'pecheur_numero_permis' => $obj['pecheur_numero_permis'],
  
            'pecheur_confidentialite' => $confidentiel,
        );
        $erreurProduite = false;
        $message = '';
        $identifiant_existant = $this->db_pecheur->existe($pecheur['pecheur_mail'], $obj['pecheur_id']);
        if (!$identifiant_existant) {
            $this->db->trans_begin();
            $modification = $this->db_pecheur->modifier($obj['pecheur_id'], $pecheur);
            if (!$modification) {
    
                $erreurProduite = true;
        
            }else {
                $nom = $pecheur['pecheur_nom'];
                $prenom = $pecheur['pecheur_prenom'];
                $id = $obj['pecheur_id'];
                // $this->db_historique->archiver("Modification", "Modification des informations du pêcheur $nom $prenom ayant ID: $id depuis l'application mobile");
                $this->db->trans_commit();
        
            }
        }else {
    
            $erreurProduite = true;
      
            $message = 'L\'adresse email existe déjà, veuillez en choisir un autre parce que ce propriété doit être unique pour chaque utilisateur';
      
        }

        $success = 'success';

        if(!$erreurProduite) $success = '!success';

        echo json_encode(array('success' => 'success','donnees'=>$pecheur), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}