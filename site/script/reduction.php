<?php
require_once __DIR__ ."/../controllers/reduction_controller.php";

if(isset($_POST) && isset($_POST['id']) && $_POST['id'] != "-1"){
    
    if (isset($_POST['action']) && $_POST['action']=="ajout") {
        ReductionController::create(date_deb:$_POST["date_deb"],date_fin:$_POST["date_fin"],taux:$_POST["taux"],id_prod:$_POST["id"]);
    }
    else if(isset($_POST['action']) && $_POST['action']=="modif"){
        ReductionController::update(id:$_POST['id_reduc'],id_prod:$_POST['id'],date_deb:$_POST["date_deb"],date_fin:$_POST["date_fin"],taux:$_POST["taux"]);
    }
   
    header('Location: admin.php');
}
else{
    header('Location: admin.php');
}
?>