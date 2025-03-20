<x-quickbites-layout>
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

            <div class="carousel-item active">
                <img src="{{ asset('template/img/hero-carousel/hero-carousel-1.jpg') }}" alt="">
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
            </div>
            <!-- End Carousel Item -->

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
            <div><span class="description-title">Últimas </span> receitas</span></div>
        </div><!-- End Section Title -->

        <div class="container mt-4 ">
            <div class="row">
                @forelse ($receitas as $receita)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $receita->receita_foto) }}" class="card-img-top" alt="{{ $receita->receita_titulo }}">
                            <h3 class="card-title">{{ $receita->receita_titulo }}</h3>
                            <p class="card-text" style="margin-bottom: 20px">Receita por <b>{{ $receita->autor }}</b></p>
                            <p class="card-text">{{ $receita->receita_descricao }}</p>
                            <p><strong><i class="bi bi-alarm-fill"></i> Duração:</strong>
                                {{ $receita->receita_duracao }} min</p>
                            <p><strong><i class="bi bi-bookmark-fill"></i> Categoria:</strong>
                                {{ $receita->categoria }}</p>
                            <a href="{{ route('receitas.show', $receita->id) }}" class="btn btn-warning">Ver Receita</a>
                        </div>
                    </div>
                @empty
                    <p class='text-center'>Nenhuma receita encontrada.</p>
                @endforelse
            </div>
        </div>  

    </section><!-- /Menu Section -->
</x-quickbites-layout>
