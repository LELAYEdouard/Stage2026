<?php 
if(isset($_POST)){
    if ($_FILES!=NULL && !isset($_POST['action'])) {
        if(!$_FILES["facture"]["error"]){
            move_uploaded_file($_FILES["facture"]["tmp_name"],"../ocr/facture/input/facture.pdf");
            // si nouvelle facture envoiyé , ancienne supprimé
            unlink('fetch.json');
        }
    }
    else if (isset($_POST['action']) && $_POST['action'] == "ajout_manque"){
        
        foreach($_POST['ref'] as $cle => $val){
            if(!empty($_POST['ref'][$cle]) && !empty($_POST['nom'][$cle]) && !empty($_POST['qte'][$cle]) && !empty($_POST['prix'][$cle]) && !empty($_POST['cat'][$cle])){
                ProduitController::create_by_fact(
                    reference:$_POST['ref'][$cle],
                    nom:$_POST['nom'][$cle],
                    prix:$_POST['prix'][$cle],
                    quantite:$_POST['qte'][$cle],
                    categorie:$_POST['cat'][$cle]
                );


            }   
            
        }
        header('Location: admin.php');
    }
    else{

        header('Location: admin.php');
    }
    header('Location: admin.php?resume=1');
}else{
    header('Location: admin.php');
}