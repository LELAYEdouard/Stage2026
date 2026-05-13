<?php
require_once __DIR__ . "/../fonctions_back/db.php"; 
class Reduction {

    static function create($id_prod,$date_deb,$date_fin,$taux){
        requete("INSERT INTO _reduction (date_debut,date_fin,taux_reduction,id_prod) 
        VALUES (:date_debut,:date_fin,:taux_reduction,:id_prod)",
        [":date_debut" => $date_deb,":date_fin"=> $date_fin,":taux_reduction"=> $taux,":id_prod" => $id_prod]);
    }

    static function update($str,$params){
        requete("UPDATE _reduction " .$str,$params);
    }
    static function get($id){
        return requete("SELECT r.*,p.prix, round(p.prix * (1-r.taux_reduction),2) as prix_reduit FROM _reduction as r INNER JOIN _produit as p ON r.id_prod = p.id WHERE id_prod = :id ORDER BY date_debut DESC",[":id"=> $id]);
    }
}