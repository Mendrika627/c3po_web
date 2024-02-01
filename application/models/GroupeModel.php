<?php



class GroupeModel extends CI_Model {

	public function __construct() {

		parent::__construct();

	}



	public function inserer($groupe) {

		return $this->db->set('groupe_nom', $groupe)->insert('groupe');

	}



	private function constructeur_de_requete($contraintes) {

		$colonnes = array('groupe_id', 'groupe_nom');
		
		$this->db->from('groupe');

		$recherche_active = isset($contraintes['search']['value']) && !empty($contraintes['search']['value']);

		if ($recherche_active) {

			$this->db->like('cast(groupe_id as varchar(255))', $contraintes['search']['value'])

				->or_like('LOWER(groupe_nom)', strtolower($contraintes['search']['value']));

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

		return $this->db->from('groupe')->count_all_results();

	}



	public function records_filtered($contraintes) {

		$query_builder = $this->constructeur_de_requete($contraintes);

		return $query_builder->get()->num_rows();

	}

	

	public function nom_existant($nom) {

		return $this->db->where(array('UPPER(groupe_nom)' => $this->db->escape_str(strtoupper($nom))), false)->from('groupe')->get()->num_rows() > 0;

	}



	public function nom_existant_en_dehors_id($id, $nom) {

		$this->db->where('groupe_id !=', $id);

		return $this->db->where(array('UPPER(groupe_nom)' => $this->db->escape_str(strtoupper($nom))))->from('groupe')->get()->num_rows() > 0;

	}



	public function modifier($id, $groupe) {

		return $this->db->set('groupe_nom', $groupe)->where('groupe_id', intval($id))->update('groupe');

	}



	public function selection_par_id($id) {

		return $this->db->from('groupe')->where('groupe_id', intval($id))->get()->result_array()[0];

	}



	public function supprimer($id) {

		return $this->db->where('groupe_id', intval($id))->delete('groupe');

	}



	public function dernier_id() {

		return intval($this->db->select('groupe_id')->from('groupe')->order_by('groupe_id', 'desc')->limit(1)->get()->result_array()[0]['groupe_id']);

	}



	public function inserer_autorisation($autorisation) {

		return $this->db->set($autorisation)->insert('autorisation');

	}



	public function selection_autorisation_par_groupe($groupe) {

        

		$this->db->select(array(

			"case when autorisation_creation then 'true' else 'false' end as creation" ,

			"case when autorisation_modification then 'true' else 'false' end as modification" ,

			"case when autorisation_visualisation then 'true' else 'false' end as visualisation" ,

			"case when autorisation_suppression then 'true' else 'false' end as suppression" ,

		), false);

		$this->db->select('operation');

		return $this->db->from('autorisation')->where('groupe', intval($groupe))->order_by('operation', 'asc')->get()->result_array();

	}



	public function supprimer_autorisation_du_groupe($groupe) {

		return $this->db->where('groupe', intval($groupe))->delete('autorisation');

	}

	

	public function liste() {

		return $this->db->get('groupe')->result_array();

	}

}

