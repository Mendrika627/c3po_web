<?php
  class HistoriqueController extends ApplicationController{

    public  function __construct(){
        parent::__construct();
        // Chargement des composants statiques de bases (header, footer)

			$this->application_component['header_component'] = $this->load->view('basic-structure/navbar.php', array('utilisateur' => array('nom' => $this->session->userdata('nom_utilisateur'),'identifiant'=> $this->session->userdata('identifiant'))), true);

			$this->application_component['footer_component'] = $this->load->view('basic-structure/footer.php', null, true);
    }

    public function index(){
          // redéfinition des paramètres parents pour l'adapter à la vue courante

			$this->root_states['title'] = 'Historique';

			$this->root_states['custom_javascripts'] = array(

				'pages/historique/index.js',

			);

			

			// précision du route courant afin d'ajouter la "classe" active au lien du composant actif

			$etat_menu = array(

				'active_route' => 'historique'

			);

			$etat_contexte_courant = array(

				'historiques'=>$this->db_historique->liste_complet(),

			);

			// rassembler les vues chargées

			$this->application_component['aside_menu_component'] = $this->load->view('basic-structure/sidebar.php', $etat_menu, true);

			$this->application_component['context_component'] = $this->load->view('historique/index.php', $etat_contexte_courant, true);

			// affichage du composant dans la vue de base

			$this->root_states['routes'] = $this->load->view('basic-structure/application.php', $this->application_component, true);

			// importation des composants dans la vue racine

      if ($this->lib_autorisation->visualisation_autorise(1))

      $this->load->view('index.php', $this->root_states, false);
    }
    public function operation_datatable() {

        // requisition des données à afficher avec les contraintes
    
        $data_query = $this->db_historique->datatable($_POST);
    
        // chargement des données formatées
    
        $data = array();
    
        foreach ($data_query as $query_result) {
    
          $data[] = array(
    
            $query_result['identifiant'],
    
            $query_result['nom'],
    
            $query_result['groupe'],
    
    
          );
    
        }
    
        echo json_encode(array(
    
          'draw' => intval($this->input->post('draw')),
    
          'recordsTotal' => $this->db_historique->records_total(),
    
          'recordsFiltered' => $this->db_historique->records_filtered($_POST),
    
          'data' => $data
    
        ));
    
    }
    public function operation_nettoyer() {

        $this->db_historique->nettoyer();

        header("location:".site_url("historique"));

    }
  }