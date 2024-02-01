<?php
class TechniqueController extends ApplicationController{
    public function __construct(){

        parent::__construct();


        $this->application_component['header_component'] = $this->load->view('basic-structure/navbar.php', array('utilisateur' => array('nom' => $this->session->userdata('nom_utilisateur'),'identifiant'=> $this->session->userdata('identifiant'))), true);

        $this->application_component['footer_component'] = $this->load->view('basic-structure/footer.php', null, true);

    }

    public function index() {
        // redéfinition des paramètres parents pour l'adapter à la vue courante
    
        $this->root_states['title'] = 'Techniques de pêche';
    
        $this->root_states['custom_javascripts'] = array(
    
        'pages/technique/index.js',
    
        'pages/technique/insertion.js',
    
        'pages/technique/modification.js',
    
        );

        // précision du route courant afin d'ajouter la "classe" active au lien du composant actif
    
        $etat_menu = array(
    
            'active_route' => 'technique/gestion-technique'
        
        );

        $etat_contexte_courant = array(
    
            'insert_modal_component' => $this->load->view('technique/modal-insertion.php',null,true),

            'insert_modal_component_2' => $this->load->view('technique/modal-insertion-2.php',array(
                'techniques_niv_1' => $this->db_technique->liste_technique_niv_1(),
            ),true),

            'update_modal_component' => $this->load->view('technique/modal-modification.php', null, true),
    
            'session' => $this->session->userdata()

        );

        // rassembler les vues chargées
    
        $this->application_component['aside_menu_component'] = $this->load->view('basic-structure/sidebar.php', $etat_menu, true);
    
        $this->application_component['context_component'] = $this->load->view('technique/index.php', $etat_contexte_courant, true);
    
        // affichage du composant dans la vue de base
    
        $this->root_states['routes'] = $this->load->view('basic-structure/application.php', $this->application_component, true);

        // importation des composants dans la vue racine

        if ($this->lib_autorisation->visualisation_autorise(3))
    
        $this->load->view('index.php', $this->root_states, false);
    }

    public function operation_datatable_niveau_1() {
        // requisition des données à afficher avec les contraintes
    
        $data_query = $this->db_technique->datatable($_POST);

        // chargement des données formatées
    
        $data = array();

        foreach ($data_query as $query_result) {
            $nom = $query_result['technique_niv_1_nom'];

            if ($this->lib_autorisation->modification_autorise(3) || $this->lib_autorisation->suppression_autorise(3)) {
                if(!$this->lib_autorisation->modification_autorise(3)){
                    $data[] = array(
    
                        $nom,
                
                        $query_result['technique_niv_1_description'],
                
                        '
                
                        <a class="btn btn-default btn-sm delete-button"  data-target="' . $query_result['id'] . '">
                
                            Supprimer
                
                        </a>
                
                        '
                
                      );
                }else if(!$this->lib_autorisation->suppression_autorise(3)){
                    $data[] = array(
    
                        $nom,
                
                        $query_result['technique_niv_1_description'],
                
                        '
                        
                        <a class="btn btn-default btn-sm update-button" data-target="#modal-modification" id="update-' . $query_result['id'] . '">
                
                            Modifier
                
                        </a>
                
                        '
                
                      );
                }else{
                    $data[] = array(
    
                        $nom,
                
                        $query_result['technique_niv_1_description'],
                
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
            }else{
                $data[] = array(
    
                    $nom,
                
                    $query_result['technique_niv_1_description'],
            
                    '
                    
                    <i class="fa fa-ban"></i>
            
                    '
            
                  );
            }

        }
        echo json_encode(array(
    
            'draw' => intval($this->input->post('draw')),
      
            'recordsTotal' => $this->db_technique->records_total(),
      
            'recordsFiltered' => $this->db_technique->records_filtered($_POST),
      
            'data' => $data
      
          ));
    }


    public function operation_datatable_niveau_2() {
        // requisition des données à afficher avec les contraintes
    
        $data_query = $this->db_technique->datatable_2($_POST);

        // chargement des données formatées
    
        $data = array();

        foreach ($data_query as $query_result) {
            $nom = $query_result['technique_niv_2_nom'];

            if ($this->lib_autorisation->modification_autorise(3) || $this->lib_autorisation->suppression_autorise(3)) {
                if(!$this->lib_autorisation->modification_autorise(3)){
                    $data[] = array(

                        $query_result['technique_niv_1_nom'],
    
                        $nom,
                
                        $query_result['technique_niv_2_description'],
                
                        '
                
                        <a class="btn btn-default btn-sm delete-button-2"  data-target="' . $query_result['id'] . '">
                
                            Supprimer
                
                        </a>
                
                        '
                
                      );
                }else if(!$this->lib_autorisation->suppression_autorise(3)){
                    $data[] = array(
    
                        $query_result['technique_niv_1_nom'],
    
                        $nom,
                
                        $query_result['technique_niv_2_description'],
                
                        '
                        
                        <a class="btn btn-default btn-sm update-button-2" data-target="#modal-modification-2" id="update-' . $query_result['id'] . '">
                
                            Modifier
                
                        </a>
                
                        '
                
                      );
                }else{
                    $data[] = array(
    
                        $query_result['technique_niv_1_nom'],
    
                        $nom,
                
                        $query_result['technique_niv_2_description'],
                
                        '
                        
                        <a class="btn btn-default btn-sm update-button-2" data-target="#modal-modification-2" id="update-' . $query_result['id'] . '">
                
                            Modifier
                
                        </a>
                        <a class="btn btn-default btn-sm delete-button-2"  data-target="' . $query_result['id'] . '">
                
                            Supprimer
                
                        </a>
                
                        '
                
                      );
                }
            }else{
                $data[] = array(
    
                    $query_result['technique_niv_1_nom'],
    
                    $nom,
            
                    $query_result['technique_niv_2_description'],
            
                    '
                    
                    <i class="fa fa-ban"></i>
            
                    '
            
                  );
            }
        }

        echo json_encode(array(
    
            'draw' => intval($this->input->post('draw')),
      
            'recordsTotal' => $this->db_technique->records_total_2(),
      
            'recordsFiltered' => $this->db_technique->records_filtered_2($_POST),
      
            'data' => $data
      
          ));
    }


    public function operation_insertion_niveau_1() {
        $technique = array(
    
            'technique_niv_1_nom' => $_POST['technique_niv_1_nom'],
      
            'technique_niv_1_description' => $_POST['technique_niv_1_description']
      
          );

          $erreurProduite = false;
    
          $message = '';
          $identifiant_existant = $this->db_technique->existe($technique['technique_niv_1_nom']);

          if (!$identifiant_existant) {
            $this->db->trans_begin();
            $insertion = $this->db_technique->insertion($technique);
            if (!$insertion) $erreurProduite = true;
            if ($erreurProduite){
                $this->db->trans_rollback();
            }else
            {
              $nom = $technique['technique_niv_1_nom'];
              $this->db_historique->archiver("Insertion", "Insertion d'une nouvelle technique de pêche '$nom'");
              $this->db->trans_commit();
            } 

          }else{
            $erreurProduite = true;
    
          $message = 'Une technique de pêche portant le même nom existe déjà dans la base';
        }
        echo json_encode(array('succes' => !$erreurProduite, 'message' => $message));
    }

    public function operation_insertion_niveau_2() {
        $technique = array(
    
            'technique_niv_2_nom' => $_POST['technique_niv_2_nom'],

            'technique_niv_2_technique_niv_1' => $_POST['technique_niv_2_technique_niv_1'],
      
            'technique_niv_2_description' => $_POST['technique_niv_2_description']
      
          );

          $erreurProduite = false;
    
          $message = '';
          $identifiant_existant = $this->db_technique->existe_2($technique['technique_niv_2_nom']);

          if (!$identifiant_existant) {
            $this->db->trans_begin();
            $insertion = $this->db_technique->insertion_2($technique);
            if (!$insertion) $erreurProduite = true;
            if ($erreurProduite){
                $this->db->trans_rollback();
            }else
            {
              $nom = $technique['technique_niv_2_nom'];
              $this->db_historique->archiver("Insertion", "Insertion d'une nouvelle technique de pêche de niveau 2 '$nom'");
              $this->db->trans_commit();
            } 

          }else{
            $erreurProduite = true;
    
          $message = 'Une technique de pêche portant le même nom existe déjà dans la base';
        }
        echo json_encode(array('succes' => !$erreurProduite, 'message' => $message));
    }

    public function operation_modification_niveau_1() {
        $technique = array(
    
                'technique_niv_1_nom' => $_POST['technique_niv_1_nom'],
        
                'technique_niv_1_description' => $_POST['technique_niv_1_description']
        
            );
            
            $erreurProduite = false;
    
            $message = '';
        
            $identifiant_existant = $this->db_technique->existe($technique['technique_niv_1_nom'], $_POST['technique_niv_1_id']);

            if (!$identifiant_existant) {

                $this->db->trans_begin();

                $modification = $this->db_technique->modifier($_POST['technique_niv_1_id'], $technique);
    
                if (!$modification) {
            
                    $erreurProduite = true;
            
                }

                if ($erreurProduite) {
    
                    $this->db->trans_rollback();
            
                } else {

                    $nom = $technique['technique_niv_1_nom'];
                    $this->db_historique->archiver("Modification", "Modification d'une technique de pêche de niveau 1 '$nom'");
                    $this->db->trans_commit();
        
                }

            }else {
    
                $erreurProduite = true;
          
                $message = 'Une technique de pêche portant le même nom existe déjà dans la base!';
          
              }
        
        echo json_encode(array('succes' => !$erreurProduite, 'message' => $message));
    }

    public function operation_selection_niveau_1($id) {

        echo json_encode(array('technique_niv_1' => $this->db_technique->selection_par_id($id)));
    
    }

    public function liste_niveau_1(){
        echo json_encode(array('technique_niv_1' => $this->db_technique->liste_technique_niv_1()));
    }

    public function operation_suppression_niveau_1($id) {
        $nom= $this->db_technique->selection_par_id($id)['technique_niv_1_nom'];
        $this->db_historique->archiver("Suppression", "Suppression d'une technique de pêche de niveau 1 $nom");
        echo json_encode($this->db_technique->supprimer($id));

    }



}