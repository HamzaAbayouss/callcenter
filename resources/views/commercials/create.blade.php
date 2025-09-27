<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ajouter Commercial') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form action="{{ route('commercials.store') }}" method="POST" class="space-y-4 sm:space-y-6">
                    @csrf

                    {{-- Nom --}}
                    <div>
                        <label class="block mb-1">Nom</label>
                        <input type="text" name="name" class="form-control w-full" value="{{ old('name') }}"
                            placeholder="Entrez le nom du commercial" required>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block mb-1">Email</label>
                        <input type="email" name="email" class="form-control w-full" value="{{ old('email') }}"
                            placeholder="Entrez l'adresse email du commercial" required>
                    </div>

                    {{-- Spécialité --}}
                    <div>
                        <label class="block mb-1">Spécialité</label>
                        <select name="specialite_id" class="form-control w-full" required>
                            <option value="" disabled selected>-- Sélectionnez une spécialité --</option>
                            @foreach ($specialites as $specialite)
                                <option value="{{ $specialite->id }}"
                                    {{ old('specialite_id') == $specialite->id ? 'selected' : '' }}>
                                    {{ $specialite->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Bouton --}}
                    <div class="flex justify-end">
                        <button type="submit" class="btn btn-primary w-full sm:w-auto">Ajouter</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
