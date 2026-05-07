<?php
session_start();
require_once __DIR__ ."/../fonctions_back/db.php";
if(isset($_GET['modif'])){
    require_once __DIR__ . '/../views/modif_prod.php'; 
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
    <main>
        <?php 
        if(empty($_GET)){
            require_once __DIR__ . '/../views/accueil_admin.php'; 
        }
        else if(isset($_GET['action'])){
            require_once __DIR__ . '/../views/admin_action.php'; 
        }
        
        ?>
    </main>
    <?php require_once __DIR__ . "/../views/footer.php"?>
    
</body>
</html>