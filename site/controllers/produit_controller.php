<?php
require_once __DIR__ . '/../models/produit.php';
class ProduitController {

    public function getAllProduit() {
        header('Content-Type: application/json');
        
        $produit = new Produit();
        $all_produits = $produit->readAll();
        echo json_encode($all_produits, JSON_UNESCAPED_UNICODE);
        exit;
    }

    static function max_prix(){
        return Produit::max_prix()[0]["max"];
    }

    static function update($nom=null,$reference=null,$prix=null,$quantite=null,$local=null,$url=null,$cat=null,$id=null){
        $str = "SET ";
        $str_update=[] ;
        $params = [];

        if($nom){
            $str_update[] = "nom = :nom ";
            $params[":nom"] = $nom;
        }
        if($reference){
            $str_update[] =  "reference = :reference ";
            $params[":reference"] = $reference;
        }
        if($prix){
            $str_update[] =  "prix = :prix ";
            $params[":prix"] = $prix;
        }
        if($quantite){
            $str_update[] = "quantite = :quantite ";
            $params[":quantite"] = $quantite;
        }
        if($url){
            $str_update[] = "url_img = :url_img ";
            $params[":url_img"] = $url;
        }
        if($cat){
            $str_update[] = "id_categorie = :id_categorie ";
            $params[":id_categorie"] = $cat;
        }
        $str_update[] = "est_local = :local ";
        $params[":local"] = $local;
        
        if($id){
            $str .= join(',',$str_update);
            $str .= " WHERE id =". $id;
            Produit::update($str,$params);
        }
        
    }

}
?>