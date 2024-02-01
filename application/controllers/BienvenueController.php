<?php

	class BienvenueController extends ApplicationController {

		public function __construct() {

			parent::__construct();

			// Chargement des composants statiques de bases (header, footer)

			$this->application_component['header_component'] = $this->load->view('basic-structure/navbar.php', array('utilisateur' => array('nom' => $this->session->userdata('nom_utilisateur'),'identifiant'=> $this->session->userdata('identifiant'))), true);

			$this->application_component['footer_component'] = $this->load->view('basic-structure/footer.php', null, true);

		}

		

		public function page_presentation() {

			$etat_menu = array(

				'active_route' => 'bienvenue'

			);
			$this->root_states['title'] = 'Accueil';

			// chargement de la vue d'insertion et modification dans une variable

			$current_context_state = array(

			

			);
			

			// rassembler les vues chargées

			$this->application_component['aside_menu_component'] = $this->load->view('basic-structure/sidebar.php', $etat_menu, true);

			$this->application_component['context_component'] = $this->load->view('bienvenue.php', $current_context_state, true);

			// affichage du composant dans la vue de base

			$this->root_states['routes'] = $this->load->view('basic-structure/application.php', $this->application_component, true);

			// importation des composants dans la vue racine

				$this->load->view('index.php', $this->root_states, false);

		}

	}

