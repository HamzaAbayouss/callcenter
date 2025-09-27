<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($ticket) ? 'Modifier Ticket' : 'Créer Ticket' }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <form action="{{ isset($ticket) ? route('tickets.update', $ticket->id) : route('tickets.store') }}"
                    method="POST" class="space-y-4 sm:space-y-6">
                    @csrf
                    @if (isset($ticket))
                        @method('PATCH')
                    @endif

                    {{-- Client --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Client</label>
                        <input type="text" name="client"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200"
                            value="{{ old('client', $ticket->client ?? '') }}" placeholder="Entrez le nom du client"
                            required>
                    </div>

                    {{-- Objet --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Objet</label>
                        <select name="objet_id"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200"
                            required>
                            <option value="" disabled selected>-- Sélectionnez un objet --</option>
                            @foreach ($objets as $objet)
                                <option value="{{ $objet->id }}"
                                    {{ isset($ticket) && $ticket->objet_id == $objet->id ? 'selected' : '' }}>
                                    {{ $objet->titre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200"
                            placeholder="Décrivez le problème ou la demande du client" required>{{ old('description', $ticket->description ?? '') }}</textarea>
                    </div>

                    {{-- Bouton --}}
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition w-full sm:w-auto">
                            {{ isset($ticket) ? 'Mettre à jour' : 'Enregistrer' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
