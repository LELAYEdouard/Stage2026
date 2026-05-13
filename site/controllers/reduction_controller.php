<?php
require_once __DIR__ . '/../models/reduction.php';

class ReductionController {
    static function create($id_prod,$date_deb,$date_fin,$taux){
        $taux /= 100;
        Reduction::create($id_prod,$date_deb,$date_fin,$taux);
    }

    static function update($id=null,$id_prod=null,$date_deb=null,$date_fin=null,$taux=null){
        $str = "SET ";
        $str_update=[] ;
        $params = [];

        if($id_prod){
            $str_update[] = "id_prod = :id_prod ";
            $params[":id_prod"] = $id_prod;
        }
        if($date_deb){
            $str_update[] =  "date_debut = :date_deb ";
            $params[":date_deb"] = $date_deb;
        }
        if($date_fin){
            $str_update[] =  "date_fin = :date_fin ";
            $params[":date_fin"] = $date_fin;
        }
        if($taux){
            $taux /= 100;
            $str_update[] = "taux_reduction = :taux ";
            $params[":taux"] = $taux;
        }                   
        
        if($id){
            $str .= join(',',$str_update);
            $str .= " WHERE id =". $id;
            Reduction::update($str,$params);
        }
        
    }

    static function get($id){
        return Reduction::get($id);
    }
}