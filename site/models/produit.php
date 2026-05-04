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
        return requete("SELECT max(prix) as max FROM _produit");
    }
    
}