<?php 
require_once __DIR__ ."/../controllers/categorie_controller.php";

?>
<header class="sticky-top">
    <!-- header ordinateur -->
    <div class="bg-black d-flex flex-lg-row justify-content-evenly align-items-center py-2 flex-wrap">
        <a href="/admin.php">
            <img class="positon-centered" src="img/banniere.jpg" alt="">
        </a>
        <div class="position-relative  order-lg-2 mt-3 mt-lg-0">
            <input class="form-control pe-4" id="recherche_bar" type="search" placeholder="Rechercher un produit">
            <i class="recherche bi bi-search position-absolute top-50 end-0 translate-middle-y me-2"></i>
        </div>

        <a href="admin.php?deconnecter=1" class="order-3">
            <i class="bi bi-box-arrow-right text-white"></i>
        </a>
    </div>

    <div class="d-none d-lg-flex flex-row justify-content-evenly align-items-center bg-black">
        <a class="text-white my-3" href="admin.php">Accueil Admin</a>
        <a class="text-white my-3" href="admin.php?ajout_facture=1">Mes factures</a>
        <a class="text-white my-3" href="admin.php?ajout_produit=1">Ajouter un produit</a>
        <a class="text-white my-3" href="admin.php?stock=1">Mon stock</a>
        <a class="text-white my-3" href="admin.php?horaire=1">Horaires</a>
    </div>

</header>

<script>
let lastScroll = 0;
let ticking = false;
const header = document.querySelector("header");

function onScroll() {
    const currentScroll = window.pageYOffset;

    if (currentScroll <= 0) {
        header.style.transform = "translateY(0)";
        lastScroll = 0;
        return;
    }

    if (Math.abs(currentScroll - lastScroll) < 5) {
        return;
    }

    if (currentScroll > lastScroll) {
        header.style.transform = "translateY(-70%)";
    } else {
        header.style.transform = "translateY(0)";
    }

    lastScroll = currentScroll;
}

window.addEventListener("scroll", () => {
    if (!ticking) {
        window.requestAnimationFrame(() => {
            onScroll();
            ticking = false;
        });
        ticking = true;
    }})
</script>

<style>
    header {
    transition: transform 0.3s ease;
    will-change: transform;
}
</style>