<?php

class ConnexionAPI extends CI_Controller {
    public function __construct() {
        parent::__construct();
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Header:*');
    }

    public function login(){
        if(isset($_GET['mail'])&&$_GET['mail']!=""&&isset($_GET['pass'])&&$_GET['pass']!=""){

            $donnees_formulalire = array('pecheur_mail' =>$_GET['mail'], 'pecheur_mot_de_passe' => $_GET['pass']);

            $existe = $this->db_pecheur->verifier_donnees_de_connexion($donnees_formulalire);

            $autorise = true;

            $message = 'Connexion établie';

            $id = 0;

            $info_user = null;

            if ($existe) {

            $information_login = $this->db_pecheur->information_pecheur_complet($donnees_formulalire);
            $info_user = $information_login;

            } else {
                $id = 1;

                $autorise = false;

            }

	        //$this->db_historique->archiver("Connexion");
            echo json_encode(array('autorise'=> $autorise,'user'=>$info_user), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        }
    }

    public function signup(){
        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);
        $confidentiel = false;
        if($obj['pecheur_confidentialite'] == 't'){
            $confidentiel = true;
        }
        $pecheur = array(

            'pecheur_nom' => $obj['pecheur_nom'],
    
            'pecheur_prenom' => $obj['pecheur_prenom'],
      
            'pecheur_date_de_naissance' => $obj['pecheur_date_de_naissance'],
      
            'pecheur_sexe' => $obj['pecheur_sexe'],
  
            'pecheur_telephone' => $obj['pecheur_telephone'],
  
            'pecheur_mail' => $obj['pecheur_mail'],
  
            'pecheur_numero_permis' => $obj['pecheur_numero_permis'],
  
            'pecheur_confidentialite' => $confidentiel,
            
            'pecheur_mot_de_passe' => $obj['pecheur_mot_de_passe']
        );

        $erreurProduite = false;
        $message = '';
        $identifiant_existant = $this->db_pecheur->existe($pecheur['pecheur_mail']);

        if (!$identifiant_existant) {
            
            $this->db->trans_begin();
    
            $insertion = $this->db_pecheur->insertion($pecheur);
    
            if (!$insertion)
                $erreurProduite = true;
                $message = 'Une erreur est survenue lors de l\'insertion des données au serveur';
                $success = false;
    
    
          if ($erreurProduite){
            $this->db->trans_rollback();
          }else{
            $this->db->trans_commit();
          }
    
            
        }else{
            $erreurProduite = true;
      
            $message = 'L\'adresse email existe déjà, veuillez en choisir un autre parce que ce propriété doit être unique pour chaque utilisateur';
      
        }

        $success = true;
        if($erreurProduite) $success = false;

        echo json_encode(array('success' => $success,'message'=>$message), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        // echo json_encode(array('success' => 'success','donnees'=>$json), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}