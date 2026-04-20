<?php
require_once __DIR__ . '/../../controllers/produit_controller.php';

$controller = new ProduitController();
$controller->getAllProduit();
?>
