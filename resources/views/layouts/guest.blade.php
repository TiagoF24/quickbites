<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'QuickBites') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Main CSS File -->
    <link href="{{ asset('template/css/main.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            color: #1f2937;
            /* text-gray-900 */
            overflow: hidden;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #FF8400, #FFB200);
            animation: gradientAnimation 5s ease infinite;
            background-size: 400% 400%;
        }


        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .texture {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('template/img/texture.png');
            /* Substitua pelo caminho da sua imagem de textura */
            opacity: 0.1;
            /* Ajuste a opacidade conforme necessário */
            animation: textureAnimation 10s linear infinite;
        }

        @keyframes textureAnimation {
            0% {
                background-position: 0% 0%;
            }

            100% {
                background-position: 100% 100%;
            }
        }

        

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            position: relative;
            z-index: 1;
            /* Para garantir que o conteúdo fique acima da textura */
        }
    </style>
</head>

<body>
    <div class="texture"></div>
    <div class="content">
        <div>
            <a href="/">
                <img class="login_logo" src="{{ asset('template/img/logos/logo_login.png') }}" alt=""
                    style="width: 240px; height: 200px;">
            </a>
        </div>

        <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
