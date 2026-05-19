<?php 
require_once __DIR__ ."/../controllers/categorie_controller.php";

?>
<header class="sticky-top">
    <!-- header ordinateur -->
    <div class="bg-black d-flex flex-lg-row justify-content-evenly align-items-center py-2 flex-wrap">
        <a href="/admin.php">
            <img class="positon-centered" src="img/banniere.jpg" alt="">
        </a>
        <div class="position-relative order-3 order-lg-2 mt-3 mt-lg-0">
            <input class="form-control pe-4" id="recherche_bar" type="search" placeholder="Rechercher un produit">
            <i class="recherche bi bi-search position-absolute top-50 end-0 translate-middle-y me-2"></i>
        </div>
    </div>

    <div class="d-none d-lg-flex flex-row justify-content-evenly align-items-center bg-black">
        <a class="text-white my-3" href="admin.php?ajout_facture=1">Ajouter une facture</a>
        <a class="text-white my-3" href="admin.php?ajout_produit=1">Ajouter un produit</a>
        <a class="text-white my-3" href="admin.php?stock=1">Mon stock</a>
        <a class="text-white my-3" href="admin.php?graph=1">Statistiques stock</a>
    </div>

</header>