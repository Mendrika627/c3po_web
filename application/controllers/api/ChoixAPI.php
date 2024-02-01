<?php

class ChoixAPI extends CI_Controller {
    public function __construct() {
        parent::__construct();
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Header:*');
    }

    public function update(){
        $technique_niveau_1 = $this->db_technique->liste_technique_niv_1();
        $techniques = array();
        // $techniques = new array();
        foreach($technique_niveau_1 as $niv_1){
                $new = array(
                    'id'=> $niv_1['technique_niv_1_id'],
                    'nom'=> $niv_1['technique_niv_1_nom'],
                    'description'=> $niv_1['technique_niv_1_description'],
                    'niveau_2'=> array()
                );
            $technique_niv_2 = $this->db_technique->liste_technique_niv_2($niv_1['technique_niv_1_id']);
            foreach($technique_niv_2 as $niv_2){
                array_push($new['niveau_2'], array('id'=> $niv_2['technique_niv_2_id'],'nom'=>$niv_2['technique_niv_2_nom']));
            }
            array_push($techniques,$new);
        }

        $espece_niv_1 = $this->db_technique->liste_espece_niv_1();
        $especes = array();

        foreach($espece_niv_1 as $niv_1){
            $new = array(
                'id'=>$niv_1['espece_niv_1_id'],
                'nom'=>$niv_1['espece_niv_1_nom'],
                'description'=>$niv_1['espece_niv_1_description'],
                'niveau_2'=> array(),
                'classe_taille'=> array()
            );
        $espece_niv_2 = $this->db_technique->liste_espece_niv_2($niv_1['espece_niv_1_id']);
        foreach($espece_niv_2 as $niv_2){
            array_push($new['niveau_2'], array('id'=> $niv_2['espece_niv_2_id'],'nom'=>$niv_2['espece_niv_2_nom']));
        }
        $classe_taille = $this->db_technique->liste_classe_taille($niv_1['espece_niv_1_id']);
        foreach($classe_taille as $classe){
            $details_classe_taille = $this->db_technique->details_classe_taille($classe['espece_classe_taille_classe_taille']);
            foreach($details_classe_taille as $det_cla){
                array_push($new['classe_taille'], array('id'=> $det_cla['classe_taille_id'],'texte'=>$det_cla['classe_taille_texte'],'min'=>$det_cla['classe_taille_min'], 'max'=>$det_cla['classe_taille_max']));
            }
        }

        array_push($especes,$new);      
            
        }
        // $zone = $this->db_zone_corecrabe->liste();
        // array_push($techniques, $new);
        echo json_encode(array('techniques'=>$techniques,'especes'=>$especes), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

}