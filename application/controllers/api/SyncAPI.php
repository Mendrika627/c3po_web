<?php

class SyncAPI extends CI_Controller {
    public function __construct() {
        parent::__construct();
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Header:*');
        
    }


    public function sync(){
        $json = file_get_contents('php://input');
        $parties = json_decode($json, true);
        // $parties = json_decode($this->input->post('parties'), true);
        $data_partie = null;
        $data_capture_env = null;

        foreach ($parties as $partie) {
            $captures = $partie['captures'];
            $dateString = $partie['partie_peche_date'];
            $dateTime = new DateTime($dateString);
            $date = $dateTime->format('Y-m-d');

            $heureDebString = $partie['partie_peche_heure_debut'];
            $heureTime = new DateTime($heureDebString);
            $heureTime->add(new DateInterval('PT3H'));
            $heureDeb = $heureTime->format('H:i');

            $heureFinString = $partie['partie_peche_heure_fin'];
            $heureFinTime = new DateTime($heureFinString);
            $heureFinTime->add(new DateInterval('PT3H'));
            $heureFin = $heureFinTime->format('H:i');

            $data_partie = array(
                'partie_peche_date'=> $date,
                'partie_peche_pecheur'=> $partie['partie_peche_pecheur'],
                'partie_peche_technique_niv_1'=> $partie['partie_peche_technique_niv_1'],
                'partie_peche_technique_niv_2'=> $partie['partie_peche_technique_niv_2'],
                'partie_peche_heure_debut'=> $heureDeb,
                'partie_peche_heure_fin'=> $heureFin,
                'partie_peche_x'=> $partie['partie_peche_x'],
                'partie_peche_y'=> $partie['partie_peche_y'],
                'partie_peche_precision_gps'=> $partie['partie_peche_precision_gps']
            );

            $this->db_partie->insertion($data_partie);
            $id_partie = $this->db_partie->get_last($data_partie);

            foreach ($captures as $capture) {
                if(isset($capture['capture_espece_niv_1'])){
                    $grace = false;
                    if($capture['capture_graciation']==1){
                        $grace = true;
                    } 
                    $data_capture = array(
                        'capture_espece_niv_1'=> $capture['capture_espece_niv_1'],
                        'capture_espece_niv_2'=> $capture['capture_espece_niv_2'],
                        'capture_classe_taille'=>$capture['capture_classe_taille'],
                        'capture_taille'=> $capture['capture_taille'],
                        'capture_poids'=> $capture['capture_poids'],
                        'capture_graciation'=> $grace,
                        'capture_photo'=> $capture['image'],
                        'capture_partie_peche'=>$id_partie,
                        'capture_nombre'=>$capture['capture_nombre']
                    );

                    if(!is_null($capture['image'])){
                        $imgData = $capture['image'];
                        $image = preg_replace('/^data:image\/(.*?);base64,/', '', $imgData);
                        $image = base64_decode($image);
                        $imgInfo = getimagesizefromstring($image);
                        $extension = image_type_to_extension($imgInfo[2]);
                        $filename = 'image_'.$partie['partie_peche_pecheur']. date('Ymd_His') .uniqid() . $extension;
                        if (!is_dir(FCPATH.'/assets/img/upload')) {
                            mkdir(FCPATH.'/assets/img/upload', 0777, true);
                        }
                        $path = FCPATH.'/assets/img/upload/' . $filename;
                        file_put_contents($path, $image);
                        $data_capture['capture_photo'] = $filename;
                    }

                    $this->db_capture->insertion($data_capture);
                    $data_capture_env = $data_capture;
                    
                }
                

                
            }

        }

        echo json_encode(array('success' => 'success','donnees'=>$parties), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    }

}