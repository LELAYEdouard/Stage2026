<?php
require_once __DIR__ ."/../controllers/produit_controller.php";

if(isset($_POST) && isset($_POST['id']) && $_POST['id'] != "-1"){

    if(isset($_POST['local'])){
        $local=1;
    }else{
        $local=0;
    }
    ProduitController::update(nom:$_POST['nom'],reference:$_POST['reference'],prix:$_POST['prix'],quantite:$_POST['quantite'],local:$local,id:$_POST['id']);
    header('Location: admin.php');
}else{
    header('Location: admin.php');
}
?>