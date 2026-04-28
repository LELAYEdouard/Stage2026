<?php
require_once __DIR__ ."/../fonctions_back/db.php";
require_once __DIR__ ."/../controllers/categorie_controller.php";
$cat_principales = get_cat()
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/wnumb@1.2.0/wNumb.min.js"></script>
    <title>En K D'Besoin</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="sticky-top">
        <!-- header ordinateur -->
        <div class="bg-black d-flex flex-lg-row justify-content-evenly align-items-center py-2 flex-wrap">
            <a href="/">
                <img class="positon-centered" src="img/banniere.jpg" alt="">
            </a>
            <div class="position-relative order-3 order-lg-2 mt-3 mt-lg-0">
                <input class="form-control pe-4" id="recherche_bar" type="search" placeholder="Rechercher un produit">
                <i class="recherche bi bi-search position-absolute top-50 end-0 translate-middle-y me-2"></i>
            </div>
            <a href="#" id="openBurger" class="d-md-none">
                <i class="bi bi-list fs-1"></i>
            </a>
            <div id="menuBurger" class="sideBurger d-md-none" >
                <a id="fermeBurger" class="close">
                    <i class="bi bi-x-lg"></i>
                </a>
                <ul>
                    <a  href='/?catalogue=1&cat=all' class="my-lg-3">Tout les produits</a>
                     <?php
                    foreach($cat_principales as $cle => $value){
                        echo "<a href='/?catalogue=1&cat=".$value["id"]."'".">".$value["nom_categorie"]."</a>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="d-none d-lg-flex flex-row justify-content-evenly align-items-center bg-black">
            <div class="btn-group">
                <a href="/?catalogue=1&cat=all" role="button" class="text-white p-3">Tout les produits</a>
            </div>

            <?php
            foreach($cat_principales as $cle => $value){ ?>
            <div class="btn-group"> 
                <a href="/?catalogue=1&cat=<?php echo $value["id"];?>" role="button" class="text-white p-3"><?php echo $value["nom_categorie"];?></a>
                <button type="button" class="bg-black dropdown-toggle dropdown-toggle-split text-white" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <?php 
                    $sub = CategorieController::get_direct_sub_cat($value["id"]);
                    foreach($sub as $value_sub){ ?>
                    <li><a class="dropdown-item" href="/?catalogue=1&cat=<?php echo $value_sub["id"];?>"><?php echo $value_sub["nom_categorie"];?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <?php }?>
        </div>

        <script>
                let side = document.getElementById("menuBurger")
                let open = document.getElementById("openBurger")
                let close = document.getElementById("fermeBurger")

                open.onclick = openNav
                close.onclick = closeNav

                function openNav(){
                    side.classList.add("active")
                }
                function closeNav(){
                    side.classList.remove("active")
                }
        </script>

        <script type="module">
            document.querySelectorAll(".recherche").forEach(btn => {
                btn.addEventListener('click',()=>{
                    const value = document.getElementById("recherche_bar").value
                    if(value){
                        window.location.href = "/?catalogue=1&search="+ value
                    }
                    else{
                        window.location.href = "/?catalogue=1"
                    }
                })
            })
            
        </script>
    </header>
    <main class="flex-grow-1">
        <?php 
        if(empty($_GET)){
            require_once __DIR__ . '/../views/accueil.php'; 
        }
        else if(isset($_GET['catalogue'])){
            require_once __DIR__ . '/../views/catalogue.php'; 
        }
        ?>
    </main>
    <footer class="bg-black d-flex flex-row justify-content-between align-items-center">
        <img class="positon-centered  my-3" src="img/banniere.jpg" alt="">
        <div class="d-none d-md-block text-white">
            <a href="https://www.facebook.com/En.K.dbesoin/">
                <i class="bi bi-facebook mx-3"></i>
            </a>
            <a href="mailto:en-k-d-besoin@orange.fr">
                <i class="bi bi-envelope mx-3"></i>
            </a>
            <a href="tel:0296376578">
                <i class="bi bi-telephone mx-3"></i>
            </a>
        </div>
        <div class="text-white my-3">
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