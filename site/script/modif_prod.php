<?php
require_once __DIR__ ."/../controllers/produit_controller.php";
//print_r($_FILES);
if(isset($_POST) && isset($_POST['id']) && $_POST['id'] != "-1"){

    if(isset($_POST['local'])){
        $local=1;
    }else{
        $local=0;
    }

    ProduitController::update(nom:$_POST['nom'],reference:$_POST['reference'],prix:$_POST['prix'],quantite:$_POST['quantite'],local:$local,cat:$_POST["cat"],id:$_POST['id']);
    
    if ($_FILES!=NULL) {
        if(!$_FILES["image"]["error"]){
            move_uploaded_file($_FILES["image"]["tmp_name"],"img/".$_POST['id'].".png");
            ProduitController::update(url:$_POST['id'].".png",id:$_POST['id']);
        }
    }
    header('Location: admin.php');
}
else{
    header('Location: admin.php');
}
?>