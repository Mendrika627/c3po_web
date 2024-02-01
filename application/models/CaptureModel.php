<?php
class CaptureModel extends CI_Model{
    
    public function _construct(){
        parent::__construct();
    }

    public function insertion($capture) {

		return $this->db->set($capture)->insert('capture');

    }

    // public function get_last($data) {

    //     return intval($this->db->where($data)->select('capture_id')->from('capture')->order_by('capture_id', 'desc')->limit(1)->get()->result_array()[0]['capture_id']);

    // }

}