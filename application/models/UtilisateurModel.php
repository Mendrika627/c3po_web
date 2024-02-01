<?php
class UtilisateurModel extends CI_Model{
    
    public function _construct(){
        parent::__construct();
    }

    public function insertion($utilisateur) {

		return $this->db->set($utilisateur)->insert('login');

	}

    private function constructeur_de_requete($contraintes) {

        $colonnes = array('identifiant', 'nom_utilisateur', 'groupe.nom');

        $this->db

            ->select(array(

                'login.login_id as id',

                'login_identifiant as identifiant',

                'login_nom_utilisateur as nom',

                'groupe.groupe_nom as groupe'

            ))

            ->from('login')->join('groupe', 'login.groupe=groupe.groupe_id', 'inner');

        $recherche_active = isset($contraintes['search']['value']) && !empty($contraintes['search']['value']);

        if ($recherche_active) {

            $this->db->like('LOWER(login_identifiant)', strtolower($contraintes['search']['value']))

                ->or_like('LOWER(groupe.groupe_nom)', strtolower($contraintes['search']['value']));

        }

        $order_active = isset($contraintes['order']) && !empty($contraintes['order']);

        if ($order_active) return $this->db->order_by($colonnes[$contraintes['order']['0']['column']], $contraintes['order']['0']['dir']);

        else return $this->db->order_by($colonnes[0], 'asc');

    }
    public function datatable($contraintes) {

        $constructeur_de_requete = $this->constructeur_de_requete($contraintes);

        if ($contraintes['length'] != null && $contraintes['length'] != -1) $this->db->limit($contraintes['length'], $contraintes['start']);

        return $constructeur_de_requete->get()->result_array();

    }

    public function records_total() {

        return $this->db->from('login')->count_all_results();

    } 

    public function records_filtered($contraintes) {

        $query_builder = $this->constructeur_de_requete($contraintes);

        return $query_builder->get()->num_rows();

    }

    public function dernier_login() {

        return intval($this->db->select('login_id')->order_by('id', 'desc')->limit('1')->get('login')->result_array()[0]['login_id']);

    }
    public function existe($identifiant, $id = 0) {

        if (intval($id) !== 0) $this->db->where('login_id != ', intval($id));

        return $this->db->where(array('login_identifiant' => $identifiant))->from('login')->get()->num_rows() > 0;

    }

    public function modifier($id, $login) {

        return $this->db->set($login)->where('login_id', intval($id))->update('login');

    }

    public function selection_par_id($id) {

        return $this->db->from('login')->where('login_id', intval($id))->get()->result_array()[0];

    }

    public function supprimer($id) {

        return $this->db->where('login_id', intval($id))->delete('login');

    }

    public function verifier_donnees_de_connexion($donnees) {

        return $this->db->from('login')->where($donnees)->get()->num_rows() > 0;

    }

    public function information_utilisateur_complet($donnees) {

        $login = $this->db->select(array("login.login_id as id_login", 'login_identifiant as identifiant', 'login_nom_utilisateur as nom_utilisateur ', 'groupe'))->from('login')->where($donnees)->get()->result_array()[0];

        $login['groupe'] = $this->db->from('groupe')->where('groupe_id', intval($login['groupe']))->get()->result_array()[0];

        return $login;

    }


}