<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Loockers</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="">
        <div class="flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="self-center">
                    <svg width="278" height="288" viewBox="0 0 278 288" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M203.5 231V130.5H103.25V231H203.5Z" fill="white"/>
                        <path d="M203.5 30.5H103.25M203.5 30.5V130.5M203.5 30.5L275 3M3 30.5H103.25M3 30.5V130.5M3 30.5L95.25 3H275M103.25 30.5V130.5M203.5 130.5V231M203.5 130.5L254 181V204.5M203.5 130.5H103.25M203.5 231L254 281.5V204.5M203.5 231H103.25M3 130.5H103.25M3 130.5V231H103.25M103.25 130.5V231M275 3V189L254 204.5" stroke="white" stroke-width="5"/>
                    </svg>
                </div>
                <div class="mt-9 flex flex-col text-gray-800 dark:text-white items-center">
                    <div class="text-xl">
                        <p>Bienvenue sur Loockers !</p>
                    </div>
                    <div class="mt-2 text-lg">
                        <p>Projet final Déc 2022</p>
                    </div>
                    <div class="mt-4 text-lg">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/partners') }}" class="text-sm text-gray-600 dark:text-gray-500 underline">Tableau de bord</a>
                            @else
                                <a href="{{ url('/login') }}" class="text-sm text-gray-600 dark:text-gray-500 underline">Connexion</a>
                                @if (Route::has('register'))
                                    <a href="{{ url('/register') }}" class="ml-4 text-sm text-gray-600 dark:text-gray-500 underline">Inscription</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
