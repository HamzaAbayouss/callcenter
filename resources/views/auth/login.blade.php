<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-md mx-auto mt-10 sm:mt-16 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-center text-blue-600 mb-6">
            Bienvenue sur Assistance Client Plus
        </h1>
        <p class="text-center text-gray-600 dark:text-gray-400 mb-8">
            Connectez-vous pour gérer vos tickets et appels clients.
        </p>

        <form method="POST" action="{{ route('login') }}" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 sm:p-8">
            @csrf

            <!-- Adresse e-mail -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Adresse e-mail')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Mot de passe')" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Se souvenir de moi -->
            <div class="block mb-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Se souvenir de moi</span>
                </label>
            </div>

            <!-- Bouton de connexion -->
            <div class="flex justify-center mt-4">
                <x-primary-button class="w-full sm:w-auto">
                    Se connecter
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
