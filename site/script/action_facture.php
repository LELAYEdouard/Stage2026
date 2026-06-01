<?php 
if(isset($_POST)){
    if ($_FILES!=NULL) {
        if(!$_FILES["facture"]["error"]){
            move_uploaded_file($_FILES["facture"]["tmp_name"],"../ocr/facture/input/facture.pdf");
        }
    }
    header('Location: admin.php');
}else{
    header('Location: admin.php');
}