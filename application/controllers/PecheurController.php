<?php
class PecheurController extends ApplicationController{
    public function __construct(){

        parent::__construct();


        $this->application_component['header_component'] = $this->load->view('basic-structure/navbar.php', array('utilisateur' => array('nom' => $this->session->userdata('nom_utilisateur'),'identifiant'=> $this->session->userdata('identifiant'))), true);

        $this->application_component['footer_component'] = $this->load->view('basic-structure/footer.php', null, true);

    }

    public function index() {
        // redéfinition des paramètres parents pour l'adapter à la vue courante
    
        $this->root_states['title'] = 'Pêcheur';
    
        $this->root_states['custom_javascripts'] = array(
    
        'pages/pecheur/index.js',
    
        'pages/pecheur/insertion.js',
    
        'pages/pecheur/modification.js',

        'pages/pecheur/mot-de-passe.js'
    
        );

        
        // précision du route courant afin d'ajouter la "classe" active au lien du composant actif
    
        $etat_menu = array(
    
            'active_route' => 'pecheur/gestion-pecheur'
        
        );

        $etat_contexte_courant = array(
    
                'insert_modal_component' => $this->load->view('pecheur/modal-insertion.php',null,true),

                'update_modal_component' => $this->load->view('pecheur/modal-modification.php', null, true),

                'password_modal_component' => $this->load->view('pecheur/modal-mot-de-passe.php', null, true),
        
                'session' => $this->session->userdata()
    
        );
        // rassembler les vues chargées
    
        $this->application_component['aside_menu_component'] = $this->load->view('basic-structure/sidebar.php', $etat_menu, true);
    
        $this->application_component['context_component'] = $this->load->view('pecheur/index.php', $etat_contexte_courant, true);
    
        // affichage du composant dans la vue de base
    
        $this->root_states['routes'] = $this->load->view('basic-structure/application.php', $this->application_component, true);
    
        // importation des composants dans la vue racine

        if ($this->lib_autorisation->visualisation_autorise(2))
    
        $this->load->view('index.php', $this->root_states, false);
    }

    public function operation_datatable() {

        // requisition des données à afficher avec les contraintes
    
        $data_query = $this->db_pecheur->datatable($_POST);
    
        // chargement des données formatées
    
        $data = array();
    
        foreach ($data_query as $query_result) {

            $nom = $query_result['pecheur_nom'];
            if(is_null($query_result['pecheur_mot_de_passe'])){
                $nom = $nom.' <span class="badge bg-red"> </span>';
            }
            if ($this->lib_autorisation->modification_autorise(2) || $this->lib_autorisation->suppression_autorise(2)) {

                if(!$this->lib_autorisation->modification_autorise(2)){
                    $data[] = array(
    
                        $nom,
                
                        $query_result['pecheur_prenom'],
                
                        $query_result['pecheur_date_de_naissance'],
            
                        $query_result['pecheur_sexe'],
            
                        $query_result['pecheur_telephone'],
            
                        $query_result['pecheur_mail'],
                
                        '
                
                        <a class="btn btn-default btn-sm delete-button"  data-target="' . $query_result['id'] . '">
                
                            Supprimer
                
                        </a>
                
                        '
                
                      );
                }else if(!$this->lib_autorisation->suppression_autorise(2)){
                    $data[] = array(
    
                        $nom,
                
                        $query_result['pecheur_prenom'],
                
                        $query_result['pecheur_date_de_naissance'],
            
                        $query_result['pecheur_sexe'],
            
                        $query_result['pecheur_telephone'],
            
                        $query_result['pecheur_mail'],
                
                        '
                        
                        <a class="btn btn-default btn-sm update-button" data-target="#modal-modification" id="update-' . $query_result['id'] . '">
                
                            Modifier
                
                        </a>
                        <a class="btn btn-default btn-sm update-button" data-target="#modal-mot-de-passe" id="pass-' . $query_result['id'] . '">
                
                            Mot de passe
                
                        </a>
                
                        '
                
                      );
                }else{
                    $data[] = array(
    
                        $nom,
                
                        $query_result['pecheur_prenom'],
                
                        $query_result['pecheur_date_de_naissance'],
            
                        $query_result['pecheur_sexe'],
            
                        $query_result['pecheur_telephone'],
            
                        $query_result['pecheur_mail'],
                
                        '
                        
                        <a class="btn btn-default btn-sm update-button" data-target="#modal-modification" id="update-' . $query_result['id'] . '">
                
                            Modifier
                
                        </a>
                        <a class="btn btn-default btn-sm update-button" data-target="#modal-mot-de-passe" id="pass-' . $query_result['id'] . '">
                
                            Mot de passe
                
                        </a>
                        <a class="btn btn-default btn-sm delete-button"  data-target="' . $query_result['id'] . '">
                
                            Supprimer
                
                        </a>
                
                        '
                
                      );
                }
            }else{
                $data[] = array(
    
                    $nom,
            
                    $query_result['pecheur_prenom'],
            
                    $query_result['pecheur_date_de_naissance'],
        
                    $query_result['pecheur_sexe'],
        
                    $query_result['pecheur_telephone'],
        
                    $query_result['pecheur_mail'],
            
                    '
                    
                    <i class="fa fa-ban"></i>
            
                    '
            
                  );
            }
    
          
    
        }
    
        echo json_encode(array(
    
          'draw' => intval($this->input->post('draw')),
    
          'recordsTotal' => $this->db_pecheur->records_total(),
    
          'recordsFiltered' => $this->db_pecheur->records_filtered($_POST),
    
          'data' => $data
    
        ));
    
    }



    public function operation_insertion() {

        $pecheur = array(
    
          'pecheur_nom' => $_POST['pecheur_nom'],
    
          'pecheur_prenom' => $_POST['pecheur_prenom'],
    
          'pecheur_date_de_naissance' => $_POST['pecheur_date_de_naissance'],
    
          'pecheur_sexe' => $_POST['pecheur_sexe'],

          'pecheur_telephone' => $_POST['pecheur_telephone'],

          'pecheur_mail' => $_POST['pecheur_mail'],

          'pecheur_numero_permis' => $_POST['pecheur_numero_permis'],

          'pecheur_confidentialite' => $_POST['pecheur_confidentialite'],
    
        );

    
        $erreurProduite = false;
    
        $message = '';
        $identifiant_existant = $this->db_pecheur->existe($pecheur['pecheur_mail']);

        if (!$identifiant_existant) {
    
       
          $this->db->trans_begin();
    
          $insertion = $this->db_pecheur->insertion($pecheur);
    
          if (!$insertion)
            $erreurProduite = true;
    
    
          if ($erreurProduite)
    
            $this->db->trans_rollback();
    
          else
          {
            $nom = $pecheur['pecheur_nom'];
            $prenom = $pecheur['pecheur_prenom'];
            $this->db_historique->archiver("Insertion", "Insertion d'un nouveau pêcehur $nom $prenom");
            $this->db->trans_commit();
          }
        
        }else{
            $erreurProduite = true;
    
          $message = 'L\'adresse email a déjà été utilisée, veuillez en choisir une autre parce que ce propriété doit être unique pour chaque utilisateur';
        }
            
    
        echo json_encode(array('succes' => !$erreurProduite, 'message' => $message));
    
    }



    public function operation_modification() {

        $pecheur = array(
    
            'pecheur_nom' => $_POST['pecheur_nom'],
    
            'pecheur_prenom' => $_POST['pecheur_prenom'],
      
            'pecheur_date_de_naissance' => $_POST['pecheur_date_de_naissance'],
      
            'pecheur_sexe' => $_POST['pecheur_sexe'],
  
            'pecheur_telephone' => $_POST['pecheur_telephone'],
  
            'pecheur_mail' => $_POST['pecheur_mail'],
  
            'pecheur_numero_permis' => $_POST['pecheur_numero_permis'],
  
            'pecheur_confidentialite' => $_POST['pecheur_confidentialite'],
    
        );
    
        $erreurProduite = false;
    
        $message = '';
    
        $identifiant_existant = $this->db_pecheur->existe($pecheur['pecheur_mail'], $_POST['pecheur_id']);
    
        if (!$identifiant_existant) {
    
          $this->db->trans_begin();
    
          $modification = $this->db_pecheur->modifier($_POST['pecheur_id'], $pecheur);
    
          if (!$modification) {
    
            $erreurProduite = true;
    
          }
    
          if ($erreurProduite) {
    
            $this->db->trans_rollback();
    
          } else {
            $nom = $pecheur['pecheur_nom'];
            $prenom = $pecheur['pecheur_prenom'];
            $this->db_historique->archiver("Modification", "Modification du pêcheur $nom $prenom");
            $this->db->trans_commit();
    
          }
    
        } else {
    
          $erreurProduite = true;
    
          $message = 'Le nom d\'utilisateur existe déjà, veuillez en choisir un autre parce que ce propriété doit être unique pour chaque utilisateur';
    
        }
    
        echo json_encode(array('succes' => !$erreurProduite, 'message' => $message));
    
      }


      public function operation_mot_de_passe(){
          $pecheur_mdp = array(
              'pecheur_mot_de_passe' => $_POST['pecheur_mot_de_passe'],
              'pecheur_nom' => $_POST['pecheur_nom'],
              'pecheur_prenom' => $_POST['pecheur_prenom']
          );

          $erreurProduite = false;
    
            $message = '';

          $this->db->trans_begin();
    
          $modification = $this->db_pecheur->modifier($_POST['pecheur_id'], $pecheur_mdp);

          if (!$modification) {
    
            $erreurProduite = true;
    
          }

          if ($erreurProduite) {
    
            $this->db->trans_rollback();
    
          } else {
            $nom = $pecheur_mdp['pecheur_nom'];
            $prenom = $pecheur_mdp['pecheur_prenom'];
            $this->db_historique->archiver("Modification", "Modification du mot de passe du pêcheur $nom $prenom");
            $this->db->trans_commit();
    
          }

          echo json_encode(array('succes' => !$erreurProduite, 'message' => $message));
      }



    public function operation_selection($id) {

        echo json_encode(array('pecheur' => $this->db_pecheur->selection_par_id($id)));
    
    }

    public function operation_suppression($id) {
        $nom= $this->db_pecheur->selection_par_id($id)['pecheur_nom'];
        $prenom= $this->db_pecheur->selection_par_id($id)['pecheur_prenom'];
        $this->db_historique->archiver("Suppression", "Suppression du pêcheur $nom $prenom ");
        echo json_encode($this->db_pecheur->supprimer($id));

    }
}
