<?php
session_start();

require_once __DIR__ ."/../fonctions_back/db.php";
require_once __DIR__ ."/../controllers/produit_controller.php";
require_once __DIR__ ."/../controllers/reduction_controller.php";

if(!empty($_SESSION)){
    if(isset($_GET['action_prod'])){
        require_once __DIR__ . '/../script/action_prod.php'; 
    }
    else if(isset($_GET['action_reduc'])){
        require_once __DIR__ . '/../script/action_reduction.php'; 
    }
    else if(isset($_GET['deconnecter'])){
        require_once __DIR__ . '/../script/deconnecter.php'; 
    }
    else if(isset($_GET['update_stock'])){
        require_once __DIR__ . '/../script/update_stock.php'; 
    }
}else{
    if(isset($_GET['connecter'])){
        require_once __DIR__ . '/../script/connecter.php'; 
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
    <link rel="stylesheet" media="screen and (max-width: 990px)" href="style_tele.css"/>
    <link rel="stylesheet" media="screen and (min-width: 990px)" href="style.css"/>
    <link rel="stylesheet" href="style_admin.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/wnumb@1.2.0/wNumb.min.js"></script>
    <script src="fonction_front/fonction.js"></script>  
    <title>Admin</title>
</head>
<body>
    <?php require_once __DIR__ . "/../views/header_admin.php"?>
    <?php 
        $all_cat = CategorieController::get_all_cat();
    ?>
    <main>
        <?php 
        if(!empty($_SESSION)){
            if(empty($_GET)){
                require_once __DIR__ . '/../views/accueil_admin.php'; 
            }
            else if(isset($_GET['action'])){
                require_once __DIR__ . '/../views/admin_action.php'; 
            }
            else if(isset($_GET['liste_reduc']) && isset($_GET['produit'])){
                require_once __DIR__ . '/../views/liste_reduc.php'; 
            }
            else if(isset($_GET['ajout_produit']) && isset($_GET['ajout_produit'])){
                require_once __DIR__ . '/../views/ajout_produit.php'; 
            }
            else if(isset($_GET['stock'])){
                require_once __DIR__ . '/../views/liste_stock.php';
            }
        }
        else{
            require_once __DIR__ . '/../views/connexion.php'; 
        }
        ?>
    </main>
    <?php require_once __DIR__ . "/../views/footer.php"?>
</body>
</html>