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

    static function create($ref,$nom,$prix,$local,$url_img,$id_cat,$qte){
        if($url_img != null){
            requete("INSERT INTO _produit (reference,nom,prix,quantite,url_img,est_local,id_categorie) VALUES (:reference,:nom,:prix,:quantite,:url_img,:est_local,:id_categorie)",
            [":reference"=>$ref,":nom"=>$nom,":prix"=>$prix,":quantite"=>$qte,":url_img"=>$url_img,":est_local"=>$local,":id_categorie"=>$id_cat]);
        }
        else{
            requete("INSERT INTO _produit (reference,nom,prix,quantite,est_local,id_categorie) VALUES (:reference,:nom,:prix,:quantite,:est_local,:id_categorie)",
            [":reference"=>$ref,":nom"=>$nom,":prix"=>$prix,":quantite"=>$qte,":est_local"=>$local,":id_categorie"=>$id_cat]);
        
        }
    }
    
}