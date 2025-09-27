<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            🎫 Ticket #{{ $ticket->id }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-lg rounded-xl p-6 space-y-4">
                <p><span class="font-semibold">👤 Client :</span> {{ $ticket->client }}</p>
                <p><span class="font-semibold">📌 Objet :</span> {{ $ticket->objet->titre }}</p>
                <p><span class="font-semibold">📝 Description :</span> {{ $ticket->description }}</p>
                <p><span class="font-semibold">📊 Status :</span>
                    <span class="px-2 py-1 rounded
                        {{ $ticket->status === 'terminé' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ ucfirst($ticket->status) }}
                    </span>
                </p>
                <p><span class="font-semibold">💼 Commercial :</span> {{ $ticket->user->name ?? 'Non assigné' }}</p>

                <!-- Actions -->
                <div class="flex gap-3 pt-4">
                    <!-- Bouton modal -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                        ✏️ Modifier le status
                    </button>
                    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">⬅ Retour</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Modifier Status -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg rounded-2xl">
                <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title font-semibold" id="updateStatusModalLabel">Modifier le status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>

                    <div class="modal-body">
                        <label for="status" class="form-label">Nouveau status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="en cours" {{ $ticket->status === 'en cours' ? 'selected' : '' }}>En cours</option>
                            <option value="terminé" {{ $ticket->status === 'terminé' ? 'selected' : '' }}>Terminé</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">✅ Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
