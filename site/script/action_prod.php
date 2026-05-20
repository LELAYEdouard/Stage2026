<?php
if(isset($_POST) && ((isset($_POST['id']) && $_POST['id'] != "-1") || (isset($_POST['action']) && $_POST['action']=="ajout"))){
    
    if(isset($_POST['local'])){
        $local=1;
    }else{
        $local=0;
    }  

    if(!empty($_POST['qte'])){
        $qte=$_POST['qte'];
    }else{
        $qte=0;
    }

    if (isset($_POST['action']) && $_POST['action']=="ajout") {
        
        if ($_FILES!=NULL) {
            if(!$_FILES["image"]["error"]){
                move_uploaded_file($_FILES["image"]["tmp_name"],"img/prod/".$_POST['reference'].".png");
                ProduitController::create(ref:$_POST['reference'],nom:$_POST['nom'],prix:$_POST['prix'],local:$local,url_img:$_POST['reference'].".png",id_cat:$_POST['cat'],qte:$qte);
            }
            else{
                ProduitController::create(ref:$_POST['reference'],nom:$_POST['nom'],prix:$_POST['prix'],local:$local,url_img:null,id_cat:$_POST['cat'],qte:$qte);
            }
        }
    }
    else if(isset($_POST['action']) && $_POST['action']=="modif"){

        ProduitController::update(nom:$_POST['nom'],reference:$_POST['reference'],prix:$_POST['prix'],quantite:$_POST['quantite'],local:$local,cat:$_POST["cat"],id:$_POST['id']);
        
        if ($_FILES!=NULL) {
            if(!$_FILES["image"]["error"]){
                move_uploaded_file($_FILES["image"]["tmp_name"],"img/prod/".$_POST['reference'].".png");
                ProduitController::update(url:$_POST['reference'].".png",id:$_POST['id']);
            }
        }
    }
    header('Location: admin.php');
}
else{
    header('Location: admin.php');
}
?>