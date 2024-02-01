<?php

	

	class GroupeController extends ApplicationController {

		

		public function __construct() {

			parent::__construct();

			// Chargement des composants statiques de bases (header, footer)

			$this->application_component['header_component'] = $this->load->view('basic-structure/navbar.php', array('utilisateur' => array('nom' => $this->session->userdata('nom_utilisateur'),'identifiant'=> $this->session->userdata('identifiant'))), true);

			$this->application_component['footer_component'] = $this->load->view('basic-structure/footer.php', null, true);

		}

		

		public function index() {

			// redéfinition des paramètres parents pour l'adapter à la vue courante

			$this->root_states['title'] = 'Groupe';

			$this->root_states['custom_javascripts'] = array(

				'pages/groupe/index.js',

				'pages/groupe/insertion.js',

				'pages/groupe/modification.js',

			);

			

			// précision du route courant afin d'ajouter la "classe" active au lien du composant actif

			$etat_menu = array(

				'active_route' => 'groupe/gestion-groupe'

			);

			$etat_contexte_courant = array(

				'insert_modal_component' => $this->load->view('groupe/modal-insertion.php', array('operations' => $this->db_operation->liste()), true),

				'update_modal_component' => $this->load->view('groupe/modal-modification.php', null, true),

			);

			// rassembler les vues chargées

			$this->application_component['aside_menu_component'] = $this->load->view('basic-structure/sidebar.php', $etat_menu, true);

			$this->application_component['context_component'] = $this->load->view('groupe/index.php', $etat_contexte_courant, true);

			// affichage du composant dans la vue de base

			$this->root_states['routes'] = $this->load->view('basic-structure/application.php', $this->application_component, true);

			// importation des composants dans la vue racine

			if ($this->lib_autorisation->visualisation_autorise(1))

			$this->load->view('index.php', $this->root_states, false);

		}

		

		public function operation_datatable() {

			// requisition des données à afficher avec les contraintes

			$data_query = $this->db_groupe->datatable($_POST);

			// chargement des données formatées

			$data = array();

			foreach ($data_query as $query_result) {

				$data[] = array(

					$query_result['groupe_id'],

					$query_result['groupe_nom'],

					'

            <a class="btn btn-default btn-sm update-button" data-target="#modal-modification" id="update-' . $query_result['groupe_id'] . '">

                Modifier

            </a>

            ' . (!in_array(intval($query_result['groupe_id']), array(1,2)) ?

                            '<a class="btn btn-default btn-sm delete-button"  data-target="' . $query_result['groupe_id'] . '">

                Supprimer

            </a' :

                            '') . '

            '

                    );

                }

                echo json_encode(array(

                    'draw' => intval($this->input->post('draw')),

                    'recordsTotal' => $this->db_groupe->records_total(),

                    'recordsFiltered' => $this->db_groupe->records_filtered($_POST),

                    'data' => $data

                ));

		}

		

		public function operation_insertion() {

			$erreurProduite = false;

			$message = '';

			$nom_existant = $this->db_groupe->nom_existant($this->input->post('nom'));

			if (!$nom_existant) {

				$this->db->trans_begin();

				$insertion = $this->db_groupe->inserer($this->input->post('nom'));

				$groupe_insere = $this->db_groupe->dernier_id();

				if (!$insertion) $erreurProduite = true;

				foreach ($this->input->post('permissions') as $permission) {

					$autorisation = array(

						'groupe' => $groupe_insere,

						'operation' => intval($permission['operation']),

						'autorisation_creation' => intval($permission['creation']) > 0,

						'autorisation_modification' => intval($permission['modification']) > 0,

						'autorisation_visualisation' => intval($permission['visualisation']) > 0,

						'autorisation_suppression' => intval($permission['suppression']) > 0

					);

					$insertion = $this->db_groupe->inserer_autorisation($autorisation);

					if (!$insertion) $erreurProduite = true;

				}

				if ($erreurProduite) $this->db->trans_rollback();

				else {
					$this->db_historique->archiver("Insertion", "Insertion de nouveau groupe \"".$this->input->post('nom')."\"");
					$this->db->trans_commit();
				}

			} else {

				$erreurProduite = true;

				$message = 'Le nom de groupe existe déjà, veuillez en choisir un autre parce que ce propriété doit être unique pour chaque groupe';

			}

			echo json_encode(array('succes' => !$erreurProduite, 'message' => $message));

		}

		

		public function operation_modification() {

			$erreurProduite = false;

			$message = '';

			$nom_existant = $this->db_groupe->nom_existant_en_dehors_id($this->input->post('id'), $this->input->post('nom'));

			if (!$nom_existant) {

				$this->db->trans_begin();

				$insertion = $this->db_groupe->modifier($this->input->post('id'), $this->input->post('nom'));

				if (!$insertion) $erreurProduite = true;

				$insertion = $this->db_groupe->supprimer_autorisation_du_groupe($this->input->post('id'));

				if (!$insertion) $erreurProduite = true;

				foreach ($this->input->post('permissions') as $permission) {

					$autorisation = array(

						'groupe' => intval($this->input->post('id')),

						'operation' => intval($permission['operation']),

						'autorisation_creation' => intval($permission['creation']) > 0,

						'autorisation_modification' => intval($permission['modification']) > 0,

						'autorisation_visualisation' => intval($permission['visualisation']) > 0,

						'autorisation_suppression' => intval($permission['suppression']) > 0

					);

					$insertion = $this->db_groupe->inserer_autorisation($autorisation);

					if (!$insertion) $erreurProduite = true;

				}

				if ($erreurProduite) $this->db->trans_rollback();

				else {
					$session_data = $this->session->userdata();
					$new_autorisation= $this->db_groupe->selection_autorisation_par_groupe($session_data['groupe']['groupe_id']);
					$session_data['groupe']['autorisations'] = $new_autorisation;
					$this->session->set_userdata($session_data);
					$this->db_historique->archiver("Modification", "Modification de groupe \"".$this->input->post('nom')."\" ayant id:".$this->input->post('id'));
					$this->db->trans_commit();
				}

			} else {

				$erreurProduite = true;

				$message = 'Le nom d\'opération existe déjà, veuillez en choisir un autre parce que ce propriété doit être unique pour chaque groupe';

			}

			echo json_encode(array('succes' => !$erreurProduite, 'message' => $message));

		}

		

		public function operation_suppression($id) {
			$this->db_historique->archiver("Suppression", "Suppression à la table groupe \"".$this->db_groupe->selection_par_id($id)['groupe_nom']."\" ayant id:".$id);
			echo json_encode($this->db_groupe->supprimer($id));

		}

		

		public function operation_selection($id) {

			$groupe = $this->db_groupe->selection_par_id($id);

			$groupe['autorisations'] = $this->db_groupe->selection_autorisation_par_groupe($id);

			echo json_encode($groupe);

		}

	}

