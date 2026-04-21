<?php
require_once __DIR__ . "/../fonctions_back/db.php"; 

class Categorie{
    static function get_sup_cat($id){

        return requete("
            WITH RECURSIVE parents AS (
                SELECT id, id_categorie_sup
                FROM _categorie
                WHERE id = :id

                UNION ALL

                SELECT c.id, c.id_categorie_sup
                FROM _categorie c
                JOIN parents p ON c.id = p.id_categorie_sup
            )
            SELECT id_categorie_sup AS id
            FROM parents
            WHERE id_categorie_sup IS NOT NULL
        ", [
            ":id" => $id
        ]);

    }   

    static function get_sub_cat($id){
        return requete("WITH RECURSIVE subcats AS (
            SELECT id
            FROM _categorie
            WHERE id = :id

            UNION ALL

            SELECT c.id
            FROM _categorie c
            JOIN subcats s ON c.id_categorie_sup = s.id
        )
        SELECT id FROM subcats WHERE id != :id;",[":id"=> $id]);
                
    }
}