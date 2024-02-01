<?php
class OperationModel extends CI_Model{
    public function __construct() {

		parent::__construct();

	}
    public function insertion($operation) {

		return $this->db->set($operation)->insert('operation');

	}



	private function constructeur_de_requete($contraintes) {

		$colonnes = array('operation_id', 'operation_nom');

		$this->db->from('operation');

		$recherche_active = isset($contraintes['search']['value']) && !empty($contraintes['search']['value']);

		if ($recherche_active) {

			$this->db->like('cast(operation_id as varchar(255))', $contraintes['search']['value'])

				->or_like('LOWER(operation_nom)', strtolower($contraintes['search']['value']));
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

		return $this->db->from('operation')->count_all_results();

	}



	public function records_filtered($contraintes) {

		$query_builder = $this->constructeur_de_requete($contraintes);

		return $query_builder->get()->num_rows();

	}



	public function existe($nom) {

		return $this->db->where(array('operation_nom' => $nom))->from('operation')->get()->num_rows() > 0;

	}



	public function existe_hormis_id($id, $nom) {

		$this->db->where('operation_id !=', intval($id));

		return $this->db->where(array('operation_nom' => $nom))->from('operation')->get()->num_rows() > 0;

	}



	public function mettre_a_jour($operation, $id) {

		return $this->db->set($operation)->where('operation_id', intval($id))->update('operation');

	}



	public function selection_par_id($id) {

		$this->db->select(array('operation_id', 'operation_nom'));

		$this->db->select(array(

			"case when operation_creation then 'true' else 'false' end as operation_creation" ,

			"case when operation_modification then 'true' else 'false' end as operation_modification" ,

			"case when operation_visualisation then 'true' else 'false' end as operation_visualisation" ,

			"case when operation_suppression then 'true' else 'false' end as operation_suppression" ,

		), false);

		return $this->db->from('operation')->where('operation_id', intval($id))->get()->result_array()[0];

	}



	public function supprimer($id) {

		return $this->db->where('operation_id', intval($id))->delete('operation');

	}



	public function liste() {

		$this->db->select(array('operation_id', 'operation_nom'));

		$this->db->select(array(

			"case when operation_creation then 'true' else 'false' end as creation" ,

			"case when operation_modification then 'true' else 'false' end as modification",

			"case when operation_visualisation then 'true' else 'false' end as visualisation" ,

			"case when operation_suppression then 'true' else 'false' end as suppression" ,

		), false);

		return $this->db->from('operation')->order_by('operation_id')->get()->result_array();

	}
}