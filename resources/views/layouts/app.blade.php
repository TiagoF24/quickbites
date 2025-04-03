<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'QuickBites') }}</title>

    <!-- Favicons -->
    <link rel="stylesheet" href="{{ asset('template/img/favicon.png') }}">
    <link href="{{ asset('template/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('template/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&family=Satisfy&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('template/css/main.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #ff6b00;
            --primary-dark: #e05a00;
            --primary-light: #ff8c3f;
            --secondary-color: #ffc107;
            --accent-color: #ff4500;
            --text-color: #333333;
            --light-text: #ffffff;
            --dark-bg: #1a1a1a;
            --light-bg: #f8f9fa;
            --border-radius: 12px;
            --box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            --transition: all 0.3s ease;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            overflow-x: hidden;
            background-color: var(--light-bg);
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
        }

        /* Header Styling with Texture and Glass Effect */
        .header {
            background: url("{{ asset('template/img/navbar-texture.png') }}"), linear-gradient(135deg, rgba(255, 107, 0, 0.9), rgba(255, 159, 0, 0.85));
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            padding: 15px 0;
            transition: var(--transition);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo img {
            max-height: 50px;
            transition: var(--transition);
        }

        .sitename {
            font-family: 'Satisfy', cursive;
            font-size: 2.2rem;
            margin-left: 10px;
            color: var(--light-text);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* Navigation text color */
        .header a, .header .nav-link {
            color: var(--light-text) !important;
        }

        /* Main Content Styling */
        .main-content {
            background: linear-gradient(135deg, #fff8f0, #fff);
            min-height: calc(100vh - 80px);
            padding: 3rem 0;
            position: relative;
        }

        .main-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("{{ asset('template/img/pattern-light.png') }}");
            background-size: 200px;
            opacity: 0.05;
            pointer-events: none;
        }

        /* Content Container with Elegant Styling */
        .content-container {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            margin-bottom: 2rem;
            transition: var(--transition);
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .content-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        /* Page Header with Gradient */
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            padding: 2rem;
            margin-bottom: 2.5rem;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;

        }

        .page-header::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: url("{{ asset('template/img/pattern-dot.png') }}");
            background-size: 100px;
            opacity: 0.1;
            pointer-events: none;
        }

        .page-header h1 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 2rem;
            margin: 0;
            position: relative;
            z-index: 2;
            color: white; /* Garantindo que o texto do cabeçalho seja branco */
        }

        /* Footer Styling */
        .footer {
            background-color: var(--dark-bg);
            color: var(--light-text);
            padding: 3rem 0 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color), var(--accent-color));
        }

        .footer h4 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 1.2rem;
            position: relative;
            padding-bottom: 10px;
            color: white; /* Garantindo que os títulos do footer sejam brancos */
        }

        .footer h4::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 10px;
        }

        .footer p, .footer span, .footer a {
            color: var(--light-text); /* Garantindo que todo texto no footer seja branco */
        }

        .footer .icon {
            color: var(--primary-color);
            font-size: 1.5rem;
            margin-right: 15px;
        }

        .footer .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--light-text);
            margin-right: 10px;
            transition: var(--transition);
        }

        .footer .social-links a:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }

        .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            font-size: 0.9rem;
            color: var(--light-text); /* Garantindo que o copyright seja branco */
        }

        /* Scroll Top Button */
        .scroll-top {
            position: fixed;
            right: 25px;
            bottom: 25px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            z-index: 999;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .scroll-top.active {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            transform: translateY(-5px);
        }

        .scroll-top i {
            font-size: 1.5rem;
            color: white; /* Garantindo que o ícone seja branco */
        }

        /* Button Styling */
        .btn-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white !important; /* Garantindo que o texto do botão seja branco */
            border: none;
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: 500;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(255, 107, 0, 0.3);
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 107, 0, 0.4);
        }

        /* Card Styling */
        .card-custom {
            border-radius: var(--border-radius);
            border: none;
            overflow: hidden;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        }

        .card-custom .card-header {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-color));
            color: white; /* Garantindo que o texto do cabeçalho do card seja branco */
            border: none;
            padding: 15px 20px;
        }

        /* Form Controls */
        .form-control-custom {
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 12px 15px;
            transition: var(--transition);
        }

        .form-control-custom:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 107, 0, 0.2);
        }

        /* Links no footer */
        .footer a.text-white-50 {
            color: rgba(255, 255, 255, 0.7) !important;
            transition: var(--transition);
        }

        .footer a.text-white-50:hover {
            color: white !important;
            text-decoration: underline !important;
        }

        /* Badges de categorias */
        .badge.bg-primary {
            background-color: var(--primary-color) !important;
            color: white !important;
            transition: var(--transition);
        }

        .badge.bg-primary:hover {
            background-color: var(--primary-dark) !important;
            transform: translateY(-2px);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .sitename {
                font-size: 1.8rem;
            }
            
            .page-header {
                padding: 1.5rem;
            }
            
            .page-header h1 {
                font-size: 1.5rem;
            }
            
            .main-content {
                padding: 2rem 0;
            }
        }
    </style>
</head>

<body>
    <div class="min-h-screen">
        <!-- Header with Glass Effect -->
        <header id="header" class="header">
            <div class="container position-relative d-flex align-items-center justify-content-between">
                <a href="/" class="logo d-flex align-items-center">
                    <img src="{{ asset('template/img/logos/logo_login.png') }}" alt="QuickBites Logo" class="img-fluid">
                    <h1 class="sitename">QuickBites</h1>
                </a>

            </div>
        </header>

        <!-- Page Heading with Pattern Background -->
        @isset($header)
            <div class="container mt-4 animate-fade-in">
                <div class="page-header">
                    {{ $header }}
                </div>
            </div>
        @endisset

        <!-- Main Content with Subtle Pattern -->
        <main class="main-content">
            <div class="container animate-fade-in" style="animation-delay: 0.1s;">
                <div class="content-container p-4">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Enhanced Footer with Gradient Border -->
<footer id="footer" class="footer">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-3 col-md-6 d-flex">
                <i class="bi bi-geo-alt icon"></i>
                <div class="address">
                    <h4>Localização</h4>
                    <p>Rua do Parque</p>
                    <p>2120-092, Salvaterra de Magos</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex">
                <i class="bi bi-telephone icon"></i>
                <div>
                    <h4>Contacto</h4>
                    <p>
                        <strong>Email:</strong> <span>contact@quickbites.pt</span><br>
                        <strong>Telefone:</strong> <span>+351 123 456 789</span>
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex">
                <i class="bi bi-clock icon"></i>
                <div>
                    <h4>Horário de Atendimento</h4>
                    <p>
                        <strong>Seg-Sex:</strong> <span>9h - 18h</span><br>
                        <strong>Sab-Dom:</strong> <span>11h - 15h</span>
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <h4>Siga-nos</h4>
                <div class="social-links d-flex">
                    <a href="https://www.instagram.com/quickbitespt/" class="instagram" target="_blank"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="pinterest"><i class="bi bi-pinterest"></i></a>
                </div>
                
                <div class="mt-4">
                    <h4>Newsletter</h4>
                    <p class="mb-2">Receba nossas melhores receitas e dicas culinárias!</p>
                    <form class="d-flex">
                        <input type="email" class="form-control me-2" placeholder="Seu email">
                        <button class="btn-custom">Assinar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h4>Sobre QuickBites</h4>
                <p>Somos uma comunidade apaixonada por culinária, compartilhando receitas deliciosas e experiências gastronômicas para todos os gostos e níveis de habilidade.</p>
            </div>
            <div class="col-md-4 mb-4">
                <h4>Links Rápidos</h4>
                <ul class="list-unstyled">
                    <li><a href="/" class="text-white-50 text-decoration-none mb-2 d-inline-block">Início</a></li>
                    <li><a href="/receitas" class="text-white-50 text-decoration-none mb-2 d-inline-block">Receitas</a></li>
                    <li><a href="/criar" class="text-white-50 text-decoration-none mb-2 d-inline-block">Criar Receita</a></li>
                    <li><a href="/profile" class="text-white-50 text-decoration-none mb-2 d-inline-block">Meu Perfil</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h4>Categorias Populares</h4>
                <div class="d-flex flex-wrap gap-2">
                    <a href="#" class="badge bg-primary text-decoration-none">Entradas</a>
                    <a href="#" class="badge bg-primary text-decoration-none">Pratos Principais</a>
                    <a href="#" class="badge bg-primary text-decoration-none">Sobremesas</a>
                    <a href="#" class="badge bg-primary text-decoration-none">Receitas Rápidas</a>
                    <a href="#" class="badge bg-primary text-decoration-none">Vegetarianas</a>
                    <a href="#" class="badge bg-primary text-decoration-none">Sem Glúten</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4 text-center copyright">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">QuickBites</strong> <span>{{ date('Y') }} - Todos os direitos reservados</span></p>
        <div class="credits">
            <div class="d-flex justify-content-center align-items-center">
                <span>Feito com</span>
                <i class="bi bi-heart-fill text-danger mx-1"></i>
                <span>pela equipe QuickBites</span>
            </div>
        </div>
    </div>
</footer>
</div>

<!-- Animated Scroll Top Button -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
<i class="bi bi-arrow-up-short"></i>
</a>

<!-- Preloader -->
<div id="preloader" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 9999; overflow: hidden; background: #fff; display: flex; align-items: center; justify-content: center;">
<img src="{{ asset('template/img/logos/logo_login.png') }}" alt="Loading..." width="80" class="animate__animated animate__pulse animate__infinite">
</div>

<!-- Vendor JS Files -->
<script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('template/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('template/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('template/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('template/js/main.js') }}"></script>

<script>
// Preloader
window.addEventListener('load', function() {
    const preloader = document.getElementById('preloader');
    if (preloader) {
        setTimeout(function() {
            preloader.style.opacity = '0';
            preloader.style.transition = 'opacity 0.5s ease';
            
            setTimeout(function() {
                preloader.style.display = 'none';
            }, 500);
        }, 500);
    }
});

// Scroll to top functionality with smooth animation
window.addEventListener('scroll', function() {
    var scrollTop = document.getElementById('scroll-top');
    if (window.scrollY > 300) {
        scrollTop.classList.add('active');
    } else {
        scrollTop.classList.remove('active');
    }
});

document.getElementById('scroll-top').addEventListener('click', function(e) {
    e.preventDefault();
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

// Initialize AOS animations
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
    mirror: false
});

// Add animation to elements when they come into view
document.addEventListener('DOMContentLoaded', function() {
    const animateElements = document.querySelectorAll('.content-container, .card-custom');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });
    
    animateElements.forEach(element => {
        observer.observe(element);
    });
});

// Ensure all navigation links are visible against the background
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.header a, .navmenu a');
    navLinks.forEach(link => {
        link.style.color = 'white';
    });
});
</script>
</body>

</html>
