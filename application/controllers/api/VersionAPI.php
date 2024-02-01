<?php

class VersionAPI extends CI_Controller {
    public function __construct() {
        parent::__construct();
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Header:*');
    }

    public function check_update(){
        
        // $zone = $this->db_zone_corecrabe->liste();
        // array_push($techniques, $new);
        // echo json_encode(array('techniques'=>$techniques,'especes'=>$especes), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

}