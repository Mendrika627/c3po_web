<?php

	class OperationController extends ApplicationController {

		public function __construct() {

			parent::__construct();

            // Chargement des composants statiques de bases (header, footer)

            $this->application_component['header_component'] = $this->load->view('basic-structure/navbar.php', array('utilisateur' => array('nom' => $this->session->userdata('nom_utilisateur'),'identifiant'=> $this->session->userdata('identifiant'))), true);
            
			      $this->application_component['footer_component'] = $this->load->view('basic-structure/footer.php', null, true);
        }


        public function index(){
            
            $this->root_states['title'] = 'Opération';

            $this->root_states['custom_javascripts'] = array(

            'pages/operation/index.js',

            'pages/operation/insertion.js',

            'pages/operation/modification.js',

            );
            $etat_menu = array(

                'active_route' => 'operation/gestion-operation'
          
              );
          
              $etat_contexte_courant = array(
          
                'insert_modal_component' => $this->load->view('operation/modal-insertion.php', null, true),
          
                'update_modal_component' => $this->load->view('operation/modal-modification.php', null, true),
          
                //   'autorisation_creation' => $this->lib_autorisation->creation_autorise(22),
          
                //   'autorisation_modification' => $this->lib_autorisation->modification_autorise(22)
          
              );
          
              // rassembler les vues chargées
          
              $this->application_component['aside_menu_component'] = $this->load->view('basic-structure/sidebar.php', $etat_menu, true);
          
              $this->application_component['context_component'] = $this->load->view('operation/index.php', $etat_contexte_courant, true);
          
              // affichage du composant dans la vue de base
          
              $this->root_states['routes'] = $this->load->view('basic-structure/application.php', $this->application_component, true);
          
              // importation des composants dans la vue racine

              if ($this->lib_autorisation->visualisation_autorise(1))
          
              $this->load->view('index.php', $this->root_states, false);
        }

        public function operation_datatable() {

            // requisition des données à afficher avec les contraintes
        
            $data_query = $this->db_operation->datatable($_POST);
        
            // chargement des données formatées
        
            $data = array();
        
            foreach ($data_query as $query_result) {
        
              $creation = $query_result['operation_creation'] === 't' ? '<h5><span class="label  bg-green">Possible</span></h5>' : '<h5><span class="label bg-red">Impossible</span></h5>';
        
              $modification = $query_result['operation_modification'] === 't' ? '<h5><span class="label  bg-green">Possible</span></h5>' : '<h5><span class="label bg-red">Impossible</span></h5>';
        
              $visualisation = $query_result['operation_visualisation'] === 't' ? '<h5><span class="label  bg-green">Possible</span></h5>' : '<h5><span class="label bg-red">Impossible</span></h5>';
        
              $suppression = $query_result['operation_suppression'] === 't' ? '<h5><span class="label  bg-green">Possible</span></h5>' : '<h5><span class="label bg-red">Impossible</span></h5>';
        
              $data[] = array(
        
                $query_result['operation_id'],
        
                $query_result['operation_nom'],
        
                $creation,
        
                $modification,
        
                $visualisation,
        
                $suppression,
        
                '
        
                  <a class="btn btn-default btn-sm update-button" data-target="#modal-modification" id="update-' . $query_result['operation_id'] . '">
        
                    Modifier
        
                  </a>
        
                  <a class="btn btn-default btn-sm delete-button"  data-target="' . $query_result['operation_id'] . '">
        
                    Supprimer
        
                  </a>
        
                '
        
              );
        
            }
        
            echo json_encode(array(
        
              'draw' => intval($this->input->post('draw')),
        
              'recordsTotal' => $this->db_operation->records_total(),
        
              'recordsFiltered' => $this->db_operation->records_filtered($_POST),
        
              'data' => $data
        
            ));
        
        }
        public function operation_insertion() {

            $operation = array(
        
              'operation_nom' => $_POST['nom'],
        
              'operation_creation' => intval($_POST['creation']) > 0,
        
              'operation_modification' => intval($_POST['modification']) > 0,
        
              'operation_visualisation' => intval($_POST['visualisation']) > 0,
        
              'operation_suppression' => intval($_POST['suppression']) > 0
        
            );
        
            $erreurProduite = false;
        
            $message = '';
        
            $nom_existant = $this->db_operation->existe($operation['operation_nom']);
        
            if (!$nom_existant) {
        
              $this->db->trans_begin();
        
              $insertion = $this->db_operation->insertion($operation);
        
              if (!$insertion) $erreurProduite = true;
        
              if ($erreurProduite)  $this->db->trans_rollback();
        
              else {
                $this->db_historique->archiver("Insertion", "Insertion de nouvelle opération \"".$operation['operation_nom']."\"");
                $this->db->trans_commit();
              }
        
            } else {
        
              $erreurProduite = true;
        
              $message = 'Le nom d\'opération existe déjà, veuillez en choisir un autre parce que ce propriété doit être unique pour chaque utilisateur';
        
            }
        
            echo json_encode(array('succes' => !$erreurProduite, 'message' => $message));
        
        }
        public function operation_modification() {

          $operation = array(
      
            'operation_nom' => $_POST['nom'],
      
            'operation_creation' => intval($_POST['creation']) > 0,
      
            'operation_modification' => intval($_POST['modification']) > 0,
      
            'operation_visualisation' => intval($_POST['visualisation']) > 0,
      
            'operation_suppression' => intval($_POST['suppression']) > 0
      
          );
      
          $erreurProduite = false;
      
          $message = '';
      
          $nom_existant = $this->db_operation->existe_hormis_id($_POST['id'], $operation['operation_nom']);
      
          if (!$nom_existant) {
      
            $this->db->trans_begin();
      
            $insertion = $this->db_operation->mettre_a_jour($operation, $_POST['id']);
      
            if (!$insertion) $erreurProduite = true;
      
            if ($erreurProduite)  $this->db->trans_rollback();
      
            else {
              $this->db_historique->archiver("Modification", "Modification de l'opération \"".$operation['operation_nom']."\" ayant id : ".$_POST['id']);
              $this->db->trans_commit();
            } 
      
          } else {
      
            $erreurProduite = true;
      
            $message = 'Le nom d\'opération existe déjà, veuillez en choisir un autre parce que ce propriété doit être unique pour chaque utilisateur';
      
          }
      
          echo json_encode(array('succes' => !$erreurProduite, 'message' => $message));
      
        }
        public function operation_suppression($id) {
          $this->db_historique->archiver("Suppression", "Suppression à la table opération ayant id : ".$id);
          echo json_encode($this->db_operation->supprimer($id));
      
        }
        public function operation_selection($id) {
          echo json_encode($this->db_operation->selection_par_id($id));
      
        }

    }
