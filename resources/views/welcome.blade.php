<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assistance Client Plus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 font-sans antialiased">

{{-- Navbar --}}
<nav class="bg-white dark:bg-gray-800 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between h-auto sm:h-16 items-center sm:items-center py-2 sm:py-0">

        {{-- Logo --}}
        <div class="flex-shrink-0 mb-2 sm:mb-0">
            <a href="{{ url('/') }}">
                <img src="{{ asset('logo Assistance Client Plus.png') }}" alt="Assistance Client Plus" class="h-24 w-auto">
            </a>
        </div>

        {{-- Menu --}}
        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-50 dark:hover:bg-gray-700 text-center">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-50 dark:hover:bg-gray-700 text-center">Se connecter</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-50 dark:hover:bg-gray-700 text-center">S'inscrire</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>


    {{-- Hero Section --}}
    <header class="bg-blue-600 dark:bg-blue-800">
        <div class="max-w-7xl mx-auto py-12 sm:py-16 px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white">Bienvenue sur Assistance Client Plus</h1>
            <p class="mt-3 sm:mt-4 text-base sm:text-lg md:text-xl text-blue-100 max-w-2xl mx-auto">Gérez et suivez les tickets clients, les appels entrants et l’affectation des commerciaux de manière efficace.</p>
            <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow hover:bg-gray-100 transition text-center w-full sm:w-auto">Accéder au Dashboard</a>
                <a href="#features" class="px-6 py-3 border border-white text-white font-semibold rounded-lg hover:bg-white hover:text-blue-600 transition text-center w-full sm:w-auto">Découvrir les fonctionnalités</a>
            </div>
        </div>
    </header>

    {{-- Features Section --}}
    <section id="features" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <h2 class="text-2xl sm:text-3xl font-bold text-center mb-8 sm:mb-12">Fonctionnalités principales</h2>
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:scale-105 transition transform">
                <h3 class="text-lg sm:text-xl font-semibold mb-2">Gestion des Tickets</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base">Suivez tous les tickets clients en temps réel et attribuez-les automatiquement aux commerciaux selon leur spécialité.</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:scale-105 transition transform">
                <h3 class="text-lg sm:text-xl font-semibold mb-2">Affectation Automatique</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base">Les appels et demandes sont automatiquement assignés aux agents disponibles, optimisant la réactivité du service.</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:scale-105 transition transform">
                <h3 class="text-lg sm:text-xl font-semibold mb-2">Suivi et Reporting</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base">Obtenez des statistiques détaillées sur les appels, tickets résolus et performance des agents.</p>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-200 dark:bg-gray-900 py-6 mt-16">
        <div class="max-w-7xl mx-auto text-center text-gray-700 dark:text-gray-400 text-sm sm:text-base">
            &copy; {{ date('Y') }} Assistance Client Plus. Tous droits réservés.
        </div>
    </footer>

</body>
</html>
