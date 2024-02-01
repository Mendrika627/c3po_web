<?php
class UtilisateurController extends ApplicationController{
    
    public function __construct(){

        parent::__construct();


        $this->application_component['header_component'] = $this->load->view('basic-structure/navbar.php', array('utilisateur' => array('nom' => $this->session->userdata('nom_utilisateur'),'identifiant'=> $this->session->userdata('identifiant'))), true);

        $this->application_component['footer_component'] = $this->load->view('basic-structure/footer.php', null, true);
    }

    public function index() {

            // redéfinition des paramètres parents pour l'adapter à la vue courante
        
            $this->root_states['title'] = 'Utilisateur';
        
            $this->root_states['custom_javascripts'] = array(
        
            'pages/utilisateur/index.js',
        
            'pages/utilisateur/insertion.js',
        
            'pages/utilisateur/modification.js',
        
            );
        
        
        
            // précision du route courant afin d'ajouter la "classe" active au lien du composant actif
        
            $etat_menu = array(
        
            'active_route' => 'utilisateur/gestion-utilisateur'
        
            );
        
            $etat_contexte_courant = array(
        
            'insert_modal_component' => $this->load->view('utilisateur/modal-insertion.php', array(
        
                'groupes' => $this->db_groupe->liste(),
        
        
            ), true),
        
            'update_modal_component' => $this->load->view('utilisateur/modal-modification.php', null, true),
        
                'session' => $this->session->userdata()
        
            );
        
            // rassembler les vues chargées
        
            $this->application_component['aside_menu_component'] = $this->load->view('basic-structure/sidebar.php', $etat_menu, true);
        
            $this->application_component['context_component'] = $this->load->view('utilisateur/index.php', $etat_contexte_courant, true);
        
            // affichage du composant dans la vue de base
        
            $this->root_states['routes'] = $this->load->view('basic-structure/application.php', $this->application_component, true);
        
            // importation des composants dans la vue racine

            if ($this->lib_autorisation->visualisation_autorise(1))
        
            $this->load->view('index.php', $this->root_states, false);
    
    }

    public function operation_datatable() {

        // requisition des données à afficher avec les contraintes
    
        $data_query = $this->db_utilisateur->datatable($_POST);
    
        // chargement des données formatées
    
        $data = array();
    
        foreach ($data_query as $query_result) {
    
          $data[] = array(
    
            $query_result['identifiant'],
    
            $query_result['nom'],
    
            $query_result['groupe'],
    
            '
    
              <a class="btn btn-default btn-sm update-button" data-target="#modal-modification" id="update-' . $query_result['id'] . '">
    
                Modifier
    
              </a>
    
              <a class="btn btn-default btn-sm delete-button"  data-target="' . $query_result['id'] . '">
    
                Supprimer
    
              </a>
    
            '
    
          );
    
        }
    
        echo json_encode(array(
    
          'draw' => intval($this->input->post('draw')),
    
          'recordsTotal' => $this->db_utilisateur->records_total(),
    
          'recordsFiltered' => $this->db_utilisateur->records_filtered($_POST),
    
          'data' => $data
    
        ));
    
    }

    public function operation_insertion() {

        $login = array(
    
          'login_nom_utilisateur' => $_POST['nomUtilisateur'],
    
          'login_identifiant' => $_POST['identifiant'],
    
          'login_mot_de_passe' => hash('sha256', $_POST['motDePasse']),
    
          'groupe' => $_POST['groupe'],
    
        );

    
        $erreurProduite = false;
    
        $message = '';
    
        $identifiant_existant = $this->db_utilisateur->existe($login['login_identifiant']);
    
        if (!$identifiant_existant) {
    
          $this->db->trans_begin();
    
          $insertion = $this->db_utilisateur->insertion($login);
    
          if (!$insertion)
            $erreurProduite = true;
    
    
          if ($erreurProduite)
    
            $this->db->trans_rollback();
    
          else
          {
            $this->db_historique->archiver("Insertion", "Insertion de nouvelle utilisateur \"".$login['login_identifiant']."\"");
            $this->db->trans_commit();
          }
            
    
        } else {
    
          $erreurProduite = true;
    
          $message = 'Le nom d\'utilisateur existe déjà, veuillez en choisir un autre parce que ce propriété doit être unique pour chaque utilisateur';
    
        }
    
        echo json_encode(array('succes' => !$erreurProduite, 'message' => $message));
    
    }

    public function operation_modification() {

      $login = array(
  
        'login_nom_utilisateur' => $_POST['nomUtilisateur'],
  
        'login_identifiant' => $_POST['identifiant'],
  
        'login_mot_de_passe' => hash('sha256', $_POST['motDePasse']),
  
        'groupe' => $_POST['groupe'],
  
      );
  
      $erreurProduite = false;
  
      $message = '';
  
      $identifiant_existant = $this->db_utilisateur->existe($login['login_identifiant'], $_POST['id']);
  
      if (!$identifiant_existant) {
  
        $this->db->trans_begin();
  
        $insertion = $this->db_utilisateur->modifier($_POST['id'], $login);
  
        if (!$insertion) {
  
          $erreurProduite = true;
  
        }
  
        if ($erreurProduite) {
  
          $this->db->trans_rollback();
  
        } else {
          $this->db_historique->archiver("Modification", "Modification de l' utilisateur \"".$login['login_identifiant']."\" ayant id:".$_POST['id']);
          $this->db->trans_commit();
  
        }
  
      } else {
  
        $erreurProduite = true;
  
        $message = 'Le nom d\'utilisateur existe déjà, veuillez en choisir un autre aprce que ce propriété doit être unique pour chaque utilisateur';
  
      }
  
      echo json_encode(array('succes' => !$erreurProduite, 'message' => $message));
  
    }
    
    public function operation_selection($id) {

      echo json_encode(array('utilisateur' => $this->db_utilisateur->selection_par_id($id)));
  
    }

    public function operation_suppression($id) {
      $this->db_historique->archiver("Suppression", "Suppression de l' utilisateur \"".$this->db_utilisateur->selection_par_id($id)['login_identifiant']."\" ayant id:".$id);
      echo json_encode($this->db_utilisateur->supprimer($id));
  
    }



}