<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 sm:mt-16 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-center text-blue-600 mb-6">
            Inscription - Assistance Client Plus
        </h1>
        <p class="text-center text-gray-600 dark:text-gray-400 mb-8">
            Créez un compte pour gérer vos tickets et appels clients.
        </p>

        <form method="POST" action="{{ route('register') }}"
            class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 sm:p-8">
            @csrf

            <!-- Nom -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Nom')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Adresse e-mail -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Adresse e-mail')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Mot de passe')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirmation mot de passe -->
            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Boutons -->
            <div class="flex flex-col sm:flex-row items-center justify-between mt-4 gap-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 text-center w-full sm:w-auto rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    Déjà inscrit ?
                </a>

                <x-primary-button class="w-full sm:w-auto">
                    S'inscrire
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
