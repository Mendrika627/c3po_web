<?php
class PartieModel extends CI_Model{
    
    public function _construct(){
        parent::__construct();
    }

    public function insertion($partie) {

		return $this->db->set($partie)->insert('partie_peche');

    }

    public function get_last($data) {

        return intval($this->db->where($data)->select('partie_peche_id')->from('partie_peche')->order_by('partie_peche_id', 'desc')->limit(1)->get()->result_array()[0]['partie_peche_id']);

    }

}