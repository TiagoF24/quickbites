<?php
// Ligação à base de dados
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'quickbites';

// Criar ligação
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar ligação
if ($conn->connect_error) {
    die('Falha na ligação: ' . $conn->connect_error);
}

// Obter as receitas mais recentes
$query = "SELECT r.*, u.name as author_name 
          FROM receitas r 
          LEFT JOIN users u ON r.autor_id = u.id 
          ORDER BY r.created_at DESC 
          LIMIT 6";
$result = $conn->query($query);
?>

<x-quickbites-layout>
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-item active">
                <img src="{{ asset('template/img/hero-carousel/hero-carousel-1.jpg') }}" alt="">
                <div class="carousel-container">
                    <h2>Receitas <span>Populares</span></h2>
                    <p>Explore receitas irresistíveis que vão dar um novo sabor às suas refeições, desde clássicos até novas delícias!</p>
                </div>
            </div><!-- End Carousel Item -->

            <div class="carousel-item">
                <img src="{{ asset('template/img/hero-carousel/hero-carousel-2.jpg') }}" alt="">
                <div class="carousel-container">
                    <h2>Receitas para <span>Crianças</span></h2>
                    <p>Descubra receitas saudáveis e divertidas, ideais para envolver os mais pequenos na cozinha e tornar as refeições momentos de alegria!</p>
                </div>
            </div><!-- End Carousel Item -->

            <div class="carousel-item">
                <img src="{{ asset('template/img/hero-carousel/hero-carousel-3.jpg') }}" alt="">
                <div class="carousel-container">
                    <h2>Receitas <span>Vegetarianas</span></h2>
                    <p>Descubra receitas vegetarianas saborosas e saudáveis, perfeitas para uma alimentação criativa e
                        sustentável. Inspire-se e surpreenda seu paladar!</p>
                </div>
            </div><!-- End Carousel Item -->

            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

            <ol class="carousel-indicators"></ol>
        </div>
    </section><!-- /Hero Section -->

    <!-- Secção de Estatísticas -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="rounded-circle bg-warning d-inline-flex justify-content-center align-items-center mb-3"
                        style="width: 80px; height: 80px;">
                        <i class="bi bi-journal-richtext text-white fs-1"></i>
                    </div>
                    <h3 class="fs-4 fw-bold">
                        <?php
                        $recipeCount = $conn->query('SELECT COUNT(*) as count FROM receitas')->fetch_assoc()['count'];
                        echo $recipeCount;
                        ?>
                    </h3>
                    <p class="text-muted">Receitas Disponíveis</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="rounded-circle bg-warning d-inline-flex justify-content-center align-items-center mb-3"
                        style="width: 80px; height: 80px;">
                        <i class="bi bi-people-fill text-white fs-1"></i>
                    </div>
                    <h3 class="fs-4 fw-bold">
                        <?php
                        $userCount = $conn->query('SELECT COUNT(*) as count FROM users')->fetch_assoc()['count'];
                        echo $userCount;
                        ?>
                    </h3>
                    <p class="text-muted">Membros da Comunidade</p>
                </div>
                <div class="col-md-4">
                    <div class="rounded-circle bg-warning d-inline-flex justify-content-center align-items-center mb-3"
                        style="width: 80px; height: 80px;">
                        <i class="bi bi-star-fill text-white fs-1"></i>
                    </div>
                    <h3 class="fs-4 fw-bold">
                        <?php
                        $ratingCount = $conn->query('SELECT COUNT(*) as count FROM ratings')->fetch_assoc()['count'];
                        echo $ratingCount;
                        ?>
                    </h3>
                    <p class="text-muted">Avaliações de Receitas</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Secção de Receitas Recentes -->
    <section id="menu" class="menu section py-5">
        <div class="container section-title text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold">Receitas</h2>
            <p class="lead text-muted"><span class="text-warning fw-bold">Últimas</span> adicionadas</p>
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="bi bi-egg-fried"></i></div>
                <div class="divider-custom-line"></div>
            </div>
        </div>

        <div class="container">
            <div class="row g-4">
                <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow h-100 recipe-card">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $row['receita_foto']) }}" class="card-img-top"
                                alt="<?php echo htmlspecialchars($row['receita_titulo']); ?>" style="height: 200px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-warning">
                                    <i class="bi bi-alarm-fill"></i> <?php echo $row['receita_duracao']; ?> min
                                </span>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-light text-dark">
                                    <i class="bi bi-bookmark-fill"></i> <?php echo htmlspecialchars($row['categoria']); ?>
                                </span>
                                <small class="text-muted">
                                    <i class="bi bi-person-fill"></i> <?php echo htmlspecialchars($row['author_name'] ?? 'Autor não disponível'); ?>
                                </small>
                            </div>
                            <h5 class="card-title fw-bold"><?php echo htmlspecialchars($row['receita_titulo']); ?></h5>
                            <p class="card-text flex-grow-1"><?php echo htmlspecialchars(substr($row['receita_descricao'], 0, 100)) . '...'; ?></p>

                            <?php
                            // Obter classificação média
                            $recipeId = $row['id'];
                            $ratingQuery = "SELECT AVG(rating) as avg_rating, COUNT(*) as count FROM ratings WHERE receita_id = $recipeId";
                            $ratingResult = $conn->query($ratingQuery);
                            $ratingData = $ratingResult->fetch_assoc();
                            $avgRating = round($ratingData['avg_rating'] ?? 0);
                            $ratingCount = $ratingData['count'] ?? 0;
                            ?>

                            <div class="d-flex align-items-center mb-3">
                                <div class="me-2">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <?php if ($i <= $avgRating): ?>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <?php else: ?>
                                    <i class="bi bi-star text-warning"></i>
                                    <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <small class="text-muted">(<?php echo $ratingCount; ?>)</small>
                            </div>

                            <a href="{{ route('receitas.show', $row['id']) }}" class="btn btn-warning w-100 mt-auto">
                                Ver Receita <i class="bi bi-arrow-right-short"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="bi bi-info-circle me-2"></i> Nenhuma receita encontrada.
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('receitas.index') }}" class="btn btn-outline-warning btn-lg">
                    Ver Todas as Receitas <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Secção de Categorias -->

    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Categorias Populares</h2>
                <p class="lead text-muted">Explore as nossas receitas por categoria</p>
            </div>

            <div class="row g-4 justify-content-center">
                <?php
            // Obter categorias com contagem
            $categoryQuery = "SELECT categoria, COUNT(*) as count FROM receitas GROUP BY categoria ORDER BY count DESC LIMIT 6";
            $categoryResult = $conn->query($categoryQuery);
            
            // Definir ícones para categorias
            $icons = [
                'Entradas' => 'bi-egg',
                'Pratos Principais' => 'bi-egg-fried',
                'Sobremesas' => 'bi-cake',
                'Vegetariano' => 'bi-flower1',
                'Vegano' => 'bi-flower2',
                'Sem Glúten' => 'bi-slash-circle',
                'Rápidas' => 'bi-alarm',
                'Saudáveis' => 'bi-heart',
                'Bebidas' => 'bi-cup-straw',
                'Sopas' => 'bi-cup-hot'
            ];
            
            if ($categoryResult && $categoryResult->num_rows > 0) {
                while ($category = $categoryResult->fetch_assoc()) {
                    $categoryName = $category['categoria'];
                    $recipeCount = $category['count'];
                    $icon = isset($icons[$categoryName]) ? $icons[$categoryName] : 'bi-tag';
            ?>
                <div class="col-md-4 col-lg-2">
                    <a href="/receitas?categoria=<?php echo urlencode($categoryName); ?>" class="text-decoration-none">
                        <div class="card h-100 text-center category-card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="icon-box mb-3">
                                    <i class="bi <?php echo $icon; ?> fs-1 text-warning"></i>
                                </div>
                                <h5 class="card-title"><?php echo htmlspecialchars($categoryName); ?></h5>
                                <p class="card-text text-muted"><?php echo $recipeCount; ?> receitas</p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
                }
            } else {
                // Se não forem encontradas categorias ou a consulta falhar
                echo '<div class="col-12 text-center"><p class="text-muted">Nenhuma categoria encontrada.</p></div>';
            }
            ?>
            </div>
        </div>
    </section>


    <!-- Secção de Chamada à Ação -->
    <section class="py-5 bg-warning text-white text-center">
        <div class="container">
            <h2 class="display-5 fw-bold mb-4">Tem uma receita para partilhar?</h2>
            <p class="lead mb-4">Junte-se à nossa comunidade e partilhe as suas receitas favoritas com o mundo!</p>
            <div class="d-flex justify-content-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg">
                        Criar Nova Receita <i class="bi bi-plus-circle"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-light btn-lg me-2">
                        Entrar <i class="bi bi-box-arrow-in-right"></i>
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                        Registar <i class="bi bi-person-plus"></i>
                    </a>
                @endauth
            </div>
        </div>
    </section>



    <!-- CSS Personalizado para estilização adicional -->
    <style>
        /* Melhorias na Secção Hero */
        .hero {
            position: relative;
        }

        /* Substituir as propriedades existentes do carousel-container */
        .hero .carousel-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            width: 100%;
            max-width: 1200px;
            /* aumentado de 800px para 1200px */
            padding: 0 20px;
            overflow: visible;
            /* permite que o texto seja totalmente visível */
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            white-space: normal;
            /* permite quebra de linha */
            overflow: visible;
            /* remove qualquer corte de texto */
            text-overflow: clip;
            /* remove as reticências */
            display: block;
            /* garante que o texto seja exibido em bloco */
        }

        /* Ajuste responsivo */
        @media (max-width: 768px) {
            .hero .carousel-container {
                width: 90%;
                padding: 0 15px;
            }

            .hero p {
                font-size: 1rem;
                line-height: 1.4;
            }
        }

        .hero .carousel-item {
            min-height: 100vh;
            /* ocupa a tela toda */
            height: auto;
            padding: 5rem 0;
            /* espaço extra para o texto */
        }


        .hero .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.7);
        }

        .hero .carousel-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            width: 80%;
            max-width: 800px;
        }

        .hero h2 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .btn-get-started {
            display: inline-block;
            padding: 12px 30px;
            background-color: #ffc107;
            color: #fff;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-get-started:hover {
            background-color: #e0a800;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Cartões de Receitas */
        .recipe-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
        }

        .recipe-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        /* Cartões de Categorias */
        .category-card {
            transition: transform 0.3s ease;
            border-radius: 10px;
        }

        .category-card:hover {
            transform: translateY(-5px);
            background-color: #fff9e6;
        }

        .category-card .icon-box {
            width: 70px;
            height: 70px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff9e6;
            border-radius: 50%;
        }

        /* Divisor Personalizado */
        .divider-custom {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 1.5rem 0;
        }

        .divider-custom-line {
            width: 100%;
            max-width: 7rem;
            height: 0.25rem;
            background-color: #ffc107;
            border-radius: 1rem;
            border-color: #ffc107;
        }

        .divider-custom-icon {
            font-size: 1.5rem;
            color: #ffc107;
            margin: 0 1rem;
        }

        /* Ajustes Responsivos */
        @media (max-width: 768px) {
            .hero h2 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .hero .carousel-item {
                height: 60vh;
            }
        }
    </style>
</x-quickbites-layout>

<?php
// Fechar a ligação
$conn->close();
?>
