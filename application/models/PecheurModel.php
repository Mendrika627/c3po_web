<?php
class PecheurModel extends CI_Model{
    
    public function _construct(){
        parent::__construct();
    }

    public function insertion($pecheur) {

		return $this->db->set($pecheur)->insert('pecheur');

	}

    private function constructeur_de_requete($contraintes) {

        $colonnes = array('pecheur_nom', 'pecheur_prenom', 'pecheur_date_de_naissance','pecheur_sexe','pecheur_telephone','pecheur_mail');

        $this->db

            ->select(array(

                'pecheur_id as id',

                'pecheur_nom',

                'pecheur_prenom',

                'pecheur_date_de_naissance',

                'pecheur_sexe',

                'pecheur_telephone',

                'pecheur_mail',

                'pecheur_mot_de_passe'

            ))

            ->from('pecheur');

        $recherche_active = isset($contraintes['search']['value']) && !empty($contraintes['search']['value']);

        if ($recherche_active) {

            $this->db->like('LOWER(pecheur_nom)', strtolower($contraintes['search']['value']))

                ->or_like('LOWER(pecheur_prenom)', strtolower($contraintes['search']['value']))

                ->or_like('LOWER(pecheur_sexe)', strtolower($contraintes['search']['value']))

                ->or_like('LOWER(pecheur_mail)', strtolower($contraintes['search']['value']));
                

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

        return $this->db->from('pecheur')->count_all_results();

    } 

    public function records_filtered($contraintes) {

        $query_builder = $this->constructeur_de_requete($contraintes);

        return $query_builder->get()->num_rows();

    }

    public function dernier_pecheur() {

        return intval($this->db->select('pecheur_id')->order_by('pecheur_id', 'desc')->limit('1')->get('pecheur')->result_array()[0]['pecheur_id']);

    }

    public function existe($identifiant, $id = 0) {

        if (intval($id) !== 0) $this->db->where('pecheur_id != ', intval($id));

        return $this->db->where(array('pecheur_mail' => $identifiant))->from('pecheur')->get()->num_rows() > 0;

    }

    public function verifier_donnees_de_connexion($donnees) {

        return $this->db->from('pecheur')->where($donnees)->get()->num_rows() > 0;

    }

    public function information_pecheur_complet($donnees) {

        $login = $this->db->select('*')->from('pecheur')->where($donnees)->get()->result_array()[0];

        // $login['groupe'] = $this->db->from('groupe')->where('id', intval($login['groupe']))->get()->result_array()[0];

        // $enqueteur = $this->db->select('enqueteur.*, village.nom as NomVillage')->from('enqueteur')->where('enqueteur.login', intval($login['id_login']))->join('village', 'enqueteur.village=village.id', 'inner')->get()->result_array();

        // $login['enqueteur'] = is_array($enqueteur) && count($enqueteur) > 0 ? $enqueteur[0] : null;

        return $login;

    }

    public function modifier($id, $pecheur) {

        return $this->db->set($pecheur)->where('pecheur_id', intval($id))->update('pecheur');

    }

    public function selection_par_id($id) {

        return $this->db->from('pecheur')->where('pecheur_id', intval($id))->get()->result_array()[0];

    }

    public function supprimer($id) {

        return $this->db->where('pecheur_id', intval($id))->delete('pecheur');

    }

    // public function verifier_donnees_de_connexion($donnees) {

    //     return $this->db->from('login')->where($donnees)->get()->num_rows() > 0;

    // }

    // public function information_utilisateur_complet($donnees) {

    //     $login = $this->db->select(array("login.login_id as id_login", 'login_identifiant as identifiant', 'login_nom_utilisateur as nom_utilisateur ', 'groupe'))->from('login')->where($donnees)->get()->result_array()[0];

    //     $login['groupe'] = $this->db->from('groupe')->where('groupe_id', intval($login['groupe']))->get()->result_array()[0];

    //     return $login;

    // }


}