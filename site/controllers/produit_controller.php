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
}
?>