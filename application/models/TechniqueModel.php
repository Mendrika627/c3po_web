<?php
class TechniqueModel extends CI_Model{
    
    public function _construct(){
        parent::__construct();
    }




    public function insertion($technique_niv_1) {

		return $this->db->set($technique_niv_1)->insert('technique_niv_1');

    }
    
    public function insertion_2($technique_niv_2) {

		return $this->db->set($technique_niv_2)->insert('technique_niv_2');

	}

    private function constructeur_de_requete($contraintes) {

        $colonnes = array('technique_niv_1_nom', 'technique_niv_1_description');

        $this->db

            ->select(array(

                'technique_niv_1_id as id',

                'technique_niv_1_nom',

                'technique_niv_1_description'

            ))

            ->from('technique_niv_1');

        $recherche_active = isset($contraintes['search']['value']) && !empty($contraintes['search']['value']);

        if ($recherche_active) {

            $this->db->like('LOWER(technique_niv_1_nom)', strtolower($contraintes['search']['value']));
        }

        $order_active = isset($contraintes['order']) && !empty($contraintes['order']);

        if ($order_active) return $this->db->order_by($colonnes[$contraintes['order']['0']['column']], $contraintes['order']['0']['dir']);

        else return $this->db->order_by($colonnes[0], 'asc');

    }

    private function constructeur_de_requete_2($contraintes) {

        $colonnes = array('technique_niv_1_nom','technique_niv_2_nom', 'technique_niv_2_description');

        $this->db

            ->select(array(

                'technique_niv_2_id as id',

                'technique_niv_1_nom',

                'technique_niv_2_nom',

                'technique_niv_2_description'

            ))

            ->from('technique_niv_2')
            
            ->join('technique_niv_1','technique_niv_1.technique_niv_1_id = technique_niv_2.technique_niv_2_technique_niv_1','inner');

            $recherche_active = isset($contraintes['search']['value']) && !empty($contraintes['search']['value']);

        if ($recherche_active) {

            $this->db->like('LOWER(technique_niv_2_nom)', strtolower($contraintes['search']['value']));

            $this->db->or_like('LOWER(technique_niv_1_nom)', strtolower($contraintes['search']['value']));
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

    public function datatable_2($contraintes) {

        $constructeur_de_requete = $this->constructeur_de_requete_2($contraintes);

        if ($contraintes['length'] != null && $contraintes['length'] != -1) $this->db->limit($contraintes['length'], $contraintes['start']);

        return $constructeur_de_requete->get()->result_array();

    }

    public function records_total() {

        return $this->db->from('technique_niv_1')->count_all_results();

    } 
    public function records_total_2() {

        return $this->db->from('technique_niv_2')->count_all_results();

    } 

    public function records_filtered($contraintes) {

        $query_builder = $this->constructeur_de_requete($contraintes);

        return $query_builder->get()->num_rows();

    }

    public function records_filtered_2($contraintes) {

        $query_builder = $this->constructeur_de_requete_2($contraintes);

        return $query_builder->get()->num_rows();

    }

    public function derniere_technique_niv_1() {

        return intval($this->db->select('technique_niv_1_id')->order_by('technique_niv_1_id', 'desc')->limit('1')->get('technique_niv_1')->result_array()[0]['technique_niv_1_id']);

    }

    public function derniere_technique_niv_2() {

        return intval($this->db->select('technique_niv_2_id')->order_by('technique_niv_2_id', 'desc')->limit('1')->get('technique_niv_2')->result_array()[0]['technique_niv_2_id']);

    }

    public function existe($identifiant, $id = 0) {

        if (intval($id) !== 0) $this->db->where('technique_niv_1_id != ', intval($id));

        return $this->db->where(array('technique_niv_1_nom' => $identifiant))->from('technique_niv_1')->get()->num_rows() > 0;

    }

    public function existe_2($identifiant, $id = 0) {

        if (intval($id) !== 0) $this->db->where('technique_niv_2_id != ', intval($id));

        return $this->db->where(array('technique_niv_2_nom' => $identifiant))->from('technique_niv_2')->get()->num_rows() > 0;

    }

    public function modifier($id, $technique) {

        return $this->db->set($technique)->where('technique_niv_1_id', intval($id))->update('technique_niv_1');

    }

    public function modifier_2($id, $technique) {

        return $this->db->set($technique)->where('technique_niv_2_id', intval($id))->update('technique_niv_2');

    }

    public function selection_par_id($id) {

        return $this->db->from('technique_niv_1')->where('technique_niv_1_id', intval($id))->get()->result_array()[0];

    }

    public function selection_par_id_2($id) {

        return $this->db->from('technique_niv_2')->where('technique_niv_2_id', intval($id))->get()->result_array()[0];

    }

    public function supprimer($id) {

        return $this->db->where('technique_niv_1_id', intval($id))->delete('technique_niv_1');

    }

    public function supprimer_2($id) {

        return $this->db->where('technique_niv_2_id', intval($id))->delete('technique_niv_2');

    }

    public function liste_technique_niv_1() {

		return $this->db->get('technique_niv_1')->result_array();

	}
    public function liste_espece_niv_1() {

		return $this->db->get('espece_niv_1')->result_array();

	}
    public function liste_technique_niv_2($niv_1) {

        $this->db->where('technique_niv_2_technique_niv_1',$niv_1);
		return $this->db->get('technique_niv_2')->result_array();

	}
    public function liste_espece_niv_2($niv_1) {

        $this->db->where('espece_niv_2_espece_niv_1',$niv_1);
		return $this->db->get('espece_niv_2')->result_array();

	}
    public function liste_classe_taille($niv_1) {

        $this->db->where('espece_classe_taille_espece_niv_1',$niv_1);
		return $this->db->get('espece_classe_taille')->result_array();

	}
    public function details_classe_taille($classe) {

        $this->db->where('classe_taille_id',$classe);
		return $this->db->get('classe_taille')->result_array();

	}


}