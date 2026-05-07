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
            <a href="#" id="openBurger" class="d-lg-none">
                <i class="bi bi-list fs-1"></i>
            </a>
            <div id="menuBurger" class="sideBurger d-lg-none" >
                <a id="fermeBurger" class="close mt-3">
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