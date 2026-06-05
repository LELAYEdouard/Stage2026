<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<section>
    <div class="d-none d-md-block swiper mySwiper">
        <span class="swiper-button-prev"></span>
        <div class="swiper-wrapper">
            <div class="swiper-slide">
            <img class="rounded" src="img/img_presentation.jpg" alt="img_presentation">
            </div>
            <div class="swiper-slide">
            <img class="rounded" src="img/interieur.jpg" alt="interieur">
            </div>
            <div class="swiper-slide">
            <img class="rounded" src="img/deventure.jpg" alt="deventure">
            </div>
            <div class="swiper-slide">
            <img class="rounded" src="img/img_presentation.jpg" alt="img_presentation">
            </div>
            <div class="swiper-slide">
            <img class="rounded" src="img/interieur.jpg" alt="interieur">
            </div>
            <div class="swiper-slide">
            <img class="rounded" src="img/deventure.jpg" alt="deventure">
            </div>
        </div>
        <span class="swiper-button-next"></span>
    </div>

    <script>
        const swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: false,
            allowTouchMove: false,
            centeredSlides: true,
            loop: true,
            initialSlide: 0,
            slidesPerView: 3,
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 150,
                modifier: 2.5,
                slideShadows: true,
            },
            breakpoints: {
                0: {
                slidesPerView: 1.2,
                },
                768: {
                slidesPerView: "auto",
                }
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            }
        });
    </script>
</section>

<section class="d-md-none m-3 d-flex justify-content-center">
    <img class="w-100" src="img/img_presentation.jpg" alt="presentation">
</section>

<section id="textPresentation">
    <p class="fs-3 text-center d-none d-lg-block">
        Petite épicerie de proximité située entre le bourg et l'école, juste à côté de la bibliothèque, en K d'Besoin vous propose des produits alimentaires et non-alimentaires classiques enrichis par de nombreux produits Locaux ainsi que les petits achats "plaisirs" et idées-cadeaux. Vous y trouverez aussi du gaz, Antargaz et Butagaz, du pain et viennoiseries en dépôt tous les mercredis et à chaque fermeture de votre boulangerie, un service de photocopie couleur et noir et blanc ainsi que le journal le Trégor. En K d'Besoin reste à votre écoute, votre satisfaction étant importante.
    </p>
    <p class="d-lg-none d-block fs-6 text-center mx-2">
        Petite épicerie situé entre le bourg et l'école, à coté de la bibliothèque proposant des
        produits standards, LOCAUX et achats plaisirs
    </p>
</section>

<section class="d-md-none m-5" style="width:auto; position: relative; height: 30vh;">
  <img src="img/deventure.jpg" alt="deventure"
       class="rounded"
       style="position: absolute; top: 0; left: 0; width: 72%; z-index: 1;">
  <img src="img/interieur.jpg" alt="interieur"
       class="rounded"
       style="position: absolute; bottom: 0; right: 0; width: 72%; z-index: 2;">
</section>

<section>
    <div class="d-flex flex-column flex-md-row justify-content-evenly align-items-center align-items-md-start">
        <div class="d-flex flex-column align-items-center">
            <h1>HORAIRES</h1>
            
            <div class="mt-4 d-flex flex-column align-items-center align-items-md-start">
                <?php 
                $horaire = unserialize(get_horaire());
                foreach($horaire as $val){ 
                $cle = array_keys($val);
                ?>
                <div class="form-group d-flex flex-column">
                    <h4><?=$val[$cle[0]]?></h4>
                    <p><?=$val[$cle[1]]?></p>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="d-none d-md-block ">
            <h1>COORDONNÉES</h1>
            <div class="mt-4">
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
        </div>
        <div class="d-flex flex-column align-items-center">
            <h1>SERVICES</h1>
            <ul class="mt-lg-4 d-flex flex-column align-items-center align-items-md-start">
                <li class="mb-3">épicerie</li>
                <li class="mb-3">gaz</li>
                <li class="mb-3">photocopies</li>
                <li class="mb-3">dépôt de pain le mercredi</li>
                <li class="mb-3">colis privé</li>
            </ul>
        </div>
    </div>
</section>