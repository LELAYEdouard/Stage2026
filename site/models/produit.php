<?php
require_once __DIR__ . "/../fonctions_back/db.php"; 

class Produit{

    private $id;
    private $reference;
    private $nom;
    private $quantite;
    private $prix;
    private $url_img;
    private $table_name = "all_produits";

    public function readAll(){
        return requete("SELECT * FROM ". $this->table_name);
    }

    static function max_prix(){
        return requete("SELECT max(prix) AS max FROM _produit");
    }

    static function update($update_str,$update_params){
        requete("UPDATE _produit " . $update_str,$update_params);
    }
    
}