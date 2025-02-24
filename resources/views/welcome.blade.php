<x-quickbites-layout>
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

            <div class="carousel-item active">
                <img src="{{ asset('template/img/hero-carousel/hero-carousel-1.jpg') }}"alt="">
                <div class="carousel-container">
                    <h2>Receitas <span>Populares</span></h2>
                    <p>Explore as receitas mais amadas que vão transformar as suas refeições! Desde pratos tradicionais
                        a novas delícias, descubra sabores que encantam a todos.</p>
                    <div>
                        <a href="#menu" class="btn-get-started">Ver Receitas Populares</a>
                    </div>
                </div>
            </div><!-- End Carousel Item -->

            <div class="carousel-item">
                <img src="{{ asset('template/img/hero-carousel/hero-carousel-2.jpg') }}" alt="">
                <div class="carousel-container">
                    <h2>Receitas para <span>Crianças</span></h2>
                    <p>Descobre receitas divertidas e saudáveis que vão encantar os mais pequenos! Com ingredientes
                        simples e preparações fáceis, estas delícias são perfeitas para envolver as crianças na cozinha
                        e transformar as refeições em momentos de alegria e criatividade</p>
                    <div>
                        <a href="#menu" class="btn-get-started">Ver Receitas para Crianças</a>
                    </div>
                </div>
            </div><!-- End Carousel Item -->

            <div class="carousel-item">
                <img src="{{ asset('template/img/hero-carousel/hero-carousel-3.jpg') }}" alt="">
                <div class="carousel-container">
                    <h2>Receitas <span>Vegetarianas</span></h2>
                    <p>Descubra receitas vegetarianas saborosas e saudáveis, perfeitas para uma alimentação criativa e
                        sustentável. Inspire-se e surpreenda seu paladar!</p>
                    <div>
                        <a href="#menu" class="btn-get-started">Ver Receitas Vegetarianas</a>
                    </div>
                </div>
            </div><!--
           End Carousel Item -->

            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

            <ol class="carousel-indicators"></ol>

        </div>

    </section><!-- /Hero Section -->

    <!-- Menu Section -->
    <section id="menu" class="menu section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Receitas</h2>
            <div><span>Receitas </span> <span class="description-title">Populares</span></div>
        </div><!-- End Section Title -->

        <div class="container isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul class="menu-filters isotope-filters">
                        <li data-filter="*" class="filter-active">Todas</li>
                        <li data-filter=".filter-starters">🥑Vegetarianas</li>
                        <li data-filter=".filter-salads">⏳ Rápidas</li>
                        <li data-filter=".filter-specialty">⭐ 5 Estrelas</li>
                    </ul>
                </div>
            </div><!-- Menu Filters -->

            <div class="row isotope-container" data-aos="fade-up" data-aos-delay="200">

                <div class="col-lg-6 menu-item isotope-item filter-starters">
                    <img src="assets/img/menu/lobster-bisque.jpg" class="menu-img" alt="">
                    <div class="menu-content">
                        <a href="#">Lobster Bisque</a><span>$5.95</span>
                    </div>
                    <div class="menu-ingredients">
                        Lorem, deren, trataro, filede, nerada
                    </div>
                </div><!-- Menu Item -->

                <div class="col-lg-6 menu-item isotope-item filter-specialty">
                    <img src="assets/img/menu/bread-barrel.jpg" class="menu-img" alt="">
                    <div class="menu-content">
                        <a href="#">Bread Barrel</a><span>$6.95</span>
                    </div>
                    <div class="menu-ingredients">
                        Lorem, deren, trataro, filede, nerada
                    </div>
                </div><!-- Menu Item -->

                <div class="col-lg-6 menu-item isotope-item filter-starters">
                    <img src="assets/img/menu/cake.jpg" class="menu-img" alt="">
                    <div class="menu-content">
                        <a href="#">Crab Cake</a><span>$7.95</span>
                    </div>
                    <div class="menu-ingredients">
                        A delicate crab cake served on a toasted roll with lettuce and tartar sauce
                    </div>
                </div><!-- Menu Item -->

                <div class="col-lg-6 menu-item isotope-item filter-salads">
                    <img src="assets/img/menu/caesar.jpg" class="menu-img" alt="">
                    <div class="menu-content">
                        <a href="#">Caesar Selections</a><span>$8.95</span>
                    </div>
                    <div class="menu-ingredients">
                        Lorem, deren, trataro, filede, nerada
                    </div>
                </div><!-- Menu Item -->

                <div class="col-lg-6 menu-item isotope-item filter-specialty">
                    <img src="assets/img/menu/tuscan-grilled.jpg" class="menu-img" alt="">
                    <div class="menu-content">
                        <a href="#">Tuscan Grilled</a><span>$9.95</span>
                    </div>
                    <div class="menu-ingredients">
                        Grilled chicken with provolone, artichoke hearts, and roasted red pesto
                    </div>
                </div><!-- Menu Item -->

                <div class="col-lg-6 menu-item isotope-item filter-starters">
                    <img src="assets/img/menu/mozzarella.jpg" class="menu-img" alt="">
                    <div class="menu-content">
                        <a href="#">Mozzarella Stick</a><span>$4.95</span>
                    </div>
                    <div class="menu-ingredients">
                        Lorem, deren, trataro, filede, nerada
                    </div>
                </div><!-- Menu Item -->

                <div class="col-lg-6 menu-item isotope-item filter-salads">
                    <img src="assets/img/menu/greek-salad.jpg" class="menu-img" alt="">
                    <div class="menu-content">
                        <a href="#">Greek Salad</a><span>$9.95</span>
                    </div>
                    <div class="menu-ingredients">
                        Fresh spinach, crisp romaine, tomatoes, and Greek olives
                    </div>
                </div><!-- Menu Item -->

                <div class="col-lg-6 menu-item isotope-item filter-salads">
                    <img src="assets/img/menu/spinach-salad.jpg" class="menu-img" alt="">
                    <div class="menu-content">
                        <a href="#">Spinach Salad</a><span>$9.95</span>
                    </div>
                    <div class="menu-ingredients">
                        Fresh spinach with mushrooms, hard boiled egg, and warm bacon vinaigrette
                    </div>
                </div><!-- Menu Item -->

                <div class="col-lg-6 menu-item isotope-item filter-specialty">
                    <img src="assets/img/menu/lobster-roll.jpg" class="menu-img" alt="">
                    <div class="menu-content">
                        <a href="#">Lobster Roll</a><span>$12.95</span>
                    </div>
                    < class="menu-ingredients">
                        Plump lobster meat, mayo and crisp lettuce on a toasted bulky roll
                </div>
            </div><!-- Menu Item -->

        </div><!-- Menu Container -->

        </div>

    </section><!-- /Menu Section -->




</x-quickbites-layout>
