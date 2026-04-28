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
        Petite épicerie idéalement située entre le bourg et l’école, à côté de la bibliothèque, offrant un emplacement pratique pour les habitants et les familles. Elle propose un large choix de produits du quotidien, complété par une belle sélection de produits locaux mettant en valeur les producteurs de la région. Vous y trouverez également des articles gourmands et des achats plaisir, pour se faire plaisir ou offrir. Un commerce de proximité chaleureux, alliant praticité, qualité et convivialité.
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
                <h4>Lundi</h4>
                <p>15h30-19h30</p>
                <h4>Du mardi au vendredi</h4>
                <p>8h30-13h00 / 15h30-19h30</p>
                <h4>Samedi et dimanche</h4>
                <p>9h00-12h00</p>
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