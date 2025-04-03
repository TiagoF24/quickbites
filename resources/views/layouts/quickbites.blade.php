<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>QuickBites - Receitas deliciosas!</title>
    <meta name="description" content="">
    <meta name="keywords" content="">


    <!-- Favicons -->
    <link rel="stylesheet" href="{{ asset('template/img/favicon.png') }}">
    <link href="{{ asset('template/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('template/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Satisfy:wght@400&display=swap"
        rel="stylesheet">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('template/css/main.css') }}" rel="stylesheet">


    <!-- =======================================================
  * Template Name: Delicious
  * Template URL: https://bootstrapmade.com/delicious-free-restaurant-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        width: 100%;
        overflow-x: hidden;
        Evitar o scroll horizontal
        background-color: #000000;
    }

    /* Estilização da Navbar com fundo laranja gradiente */
    /* Navbar com textura de cozinha */
    .header {
        background: url("{{ asset('template/img/navbar-texture.png') }}");

        /* Link para uma textura de madeira */
        background-size: 100%;
        /* Ajuste para diminuir o padrão */
        background-repeat: repeat;
        /* Faz a textura se repetir */
        background-position: 20% 10%;  /* Centraliza a textura de forma relativa */
        padding: 12px 0;
        transition: all 0.3s ease-in-out;
        background-attachment: fixed; /* Fixa o fundo */
        z-index: 1; /* Garante que o fundo não se sobreponha ao conteúdo */


    }


    /* Estilização do menu de navegação */
    .navmenu ul {
        list-style: none;
        display: flex;
        align-items: center;
        gap: 20px;
        margin: 0;
        padding: 0;
    }

    .navmenu ul li a {
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        font-size: 16px;
        text-transform: uppercase;
        color: white;
        /* Texto branco para contraste */
        padding: 10px 15px;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
    }

    /* Animação de hover */
    .navmenu ul li a:hover,
    .navmenu ul li a.active {
        background: rgba(255, 255, 255, 0.2);
        /* Efeito de destaque */
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.3);
    }

    /* Dropdown */
    .navmenu .dropdown ul {
        position: absolute;
        left: 0;
        top: 40px;
        background: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease-in-out;
    }

    .navmenu .dropdown:hover ul {
        opacity: 1;
        visibility: visible;
    }

    /* Estilização do botão Criar */
    .btnCriar {
        background: rgba(255, 255, 255, 0.2);
        color: white !important;
        padding: 10px 18px;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s ease-in-out;
    }

    .btnCriar:hover {
        background: rgba(255, 255, 255, 0.4);
        transform: scale(1.05);
    }
</style>




<body class="index-page">

    <header id="header" class="header">


        <div class="branding d-flex align-items-cente">

            <div class="container position-relative d-flex align-items-center justify-content-between">
                <a href="/" class="logo d-flex align-items-center">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <img src="{{ asset('template/img/logos/logo_login.png') }}" style="" alt="">
                    <h1 class="sitename" style="text-shadow: #000000 0px 0px 10px;">QuickBites</h1>
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="/" class="active">Início</a></li>
                        {{-- <li><a href="#about">About</a></li> --}}
                        {{-- <li><a href="#menu">Menu</a></li> --}}
                        {{-- <li><a href="#specials">Specials</a></li> --}}
                        {{-- <li><a href="#events">Events</a></li> --}}
                        {{-- <li><a href="#chefs">Chefs</a></li> --}}
                        {{-- <li><a href="#gallery">Gallery</a></li> --}}
                        <li class="dropdown"><a href="/receitas"><span>Receitas</span> <i
                                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="#">🥗 Entradas</a></li>
                                {{-- <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                            class="bi bi-chevron-down toggle-dropdown"></i></a>
                                    <ul>
                                        <li><a href="#">Deep Dropdown 1</a></li>
                                        <li><a href="#">Deep Dropdown 2</a></li>
                                        <li><a href="#">Deep Dropdown 3</a></li>
                                        <li><a href="#">Deep Dropdown 4</a></li>
                                        <li><a href="#">Deep Dropdown 5</a></li>
                                    </ul>
                                </li> --}}
                                <li><a href="#">🍴 Pratos Principais</a></li>
                                <li><a href="#">🍰 Sobremesas</a></li>
                                <li><a href="#">⏳ Receitas Rápidas</a></li>
                                <li><a href="#">🍝 Receitas Tradicionais</a></li>
                                <li><a href="#">🍭 Receitas para Crianças</a></li>
                            </ul>
                        </li>
                        @guest
                            <li><a href="/login">Entrar</a></li>
                            <li><a href="/register">Registrar</a></li>
                        @endguest

                        @auth
                        <style>
                            .btnCriar {
                                background-color: #ff6b00 !important;
                                color: white !important;
                                padding: 8px 16px !important;
                                border-radius: 4px !important;
                                display: inline-flex !important;
                                align-items: center !important;
                                gap: 6px !important;
                                text-decoration: none;
                            }
                    
                            .btnCriar:hover {
                                background-color: rgb(255, 0, 0) !important;
                                /* Cor mais escura ao passar o mouse */
                            }
                        </style>
                        <li>
                            <a href="/criar" class="btnCriar">
                                <span style="font-size: 24px;">+</span> Criar
                            </a>
                        </li>
                    
                        <li>
                            <a href="{{ route('favorites.index') }}">
                                <i class="bi bi-heart-fill"></i> Meus Favoritos
                            </a>
                        </li>
                    
                        <!-- Settings Dropdown -->
                        <li class="dropdown"><a href="#"><span>{{ Auth::user()->name }}</span> <i
                                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="{{ route('profile.edit') }}">Perfil</a></li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-responsive-nav-link>
                                </form>
                            </ul>
                        </li>
                    @endauth


                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>


            </div>

        </div>

    </header>

    <main class="main">

        {{ $slot }}

    </main>

    <footer id="footer" class="footer dark-background">

        <div class="container">
            <div class="row gy-3">
                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-geo-alt icon"></i>
                    <div class="address">
                        <h4>Endereço</h4>
                        <p>Rua do Parque</p>
                        <p>2120-092, Salvaterra de Magos</p>
                        <p></p>
                    </div>

                </div>

                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-telephone icon"></i>
                    <div>
                        <h4>Contacto</h4>
                        <p>
                            <strong>Email:</strong> <span>contact@quickbites.pt</span><br>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-clock icon"></i>
                    <div>
                        <h4>Horário de Atendimento Técnico</h4>
                        <p>
                            <strong>Seg-Sab:</strong> <span>11h - 23h</span><br>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h4>Redes Sociais</h4>
                    <div class="social-links d-flex">
                        <a href="https://www.instagram.com/quickbitespt/" class="instagram" target="_blank"><i
                                class="bi bi-instagram"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container mt-4 text-center copyright">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">QuickBites</strong> <span>All Rights
                    Reserved</span></p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('template/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('template/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('template/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('template/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('template/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('template/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('template/js/main.js') }}"></script>

</body>

</html>
