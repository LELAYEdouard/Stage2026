<?php
require_once __DIR__ ."/../fonctions_back/db.php";
$cat_principales = get_cat()
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="style.css">
    <title>En K D'Besoin</title>
</head>
<body>
    <header class="sticky-top">
        <!-- header ordinateur -->
        <div class="bg-black d-none d-lg-flex flex-row justify-content-evenly align-items-center py-2">
            <a href="/">
                <img class="positon-centered" src="img/banniere.jpg" alt="">
            </a>
            <div class="position-relative">
                <input class="form-control pe-4" id="recherche_bar" type="search" placeholder="Rechercher un produit">
                <i id="recherche" class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-2"></i>
            </div>
        </div>
        <div class="d-none d-lg-flex flex-row justify-content-evenly bg-white align-items-center">
            <a href='/?catalogue=1&cat=all' class="my-3">
                Tout les produits
            </a>
            <?php
            foreach($cat_principales as $cle => $value){
                echo "<a href='/?catalogue=1&cat=".$value["id"]."'".">".$value["nom_categorie"]."</a>";
            }
            ?>
        </div>

        <!-- header telephone -->
        <script type="module">
            document.getElementById("recherche").addEventListener('click',()=>{
                const value = document.getElementById("recherche_bar").value
                if(value){
                    window.location.href = "/?catalogue=1&search="+ value
                }
                else{
                    window.location.href = "/?catalogue=1"
                }
            })
        </script>
    </header>
    <main>
        <?php 
        if(empty($_GET)){
            require_once __DIR__ . '/../views/accueil.php'; 
        }
        else if(isset($_GET['catalogue'])){
            require_once __DIR__ . '/../views/catalogue.php'; 
        }
        ?>
    </main>
    <footer class="bg-black">
        <img class="positon-centered" src="img/banniere.jpg" alt="">
        <div></div>
        <div class="text-white">
            <div class="d-flex flex-row align-items-center mb-3">
                <i class="bi bi-geo-alt me-3"></i>
                <div>
                    <p>4 Hent Gwilherm Dubourg</p>
                    <p class="my-0" >22420 LE VIEUX-MARCHÉ</p>
                </div>
            </div>
            <div class="d-flex flex-row">
                <i class="bi bi-envelope me-3"></i>
                <a class="mb-3" href="mailto:en-k-d-besoin@orange.fr">en-k-d-besoin@orange.fr</a>
            </div>
            <div class="d-flex flex-row">
                <i class="bi bi-telephone me-3"></i>
                <p>02.96.37.65.78</p>
            </div>
        </div>
    </footer>
</body>
</html>