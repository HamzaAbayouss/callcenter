<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">Tickets</h2>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Messages --}}
            @if (session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mb-4">{{ session('error') }}</div>
            @endif

            {{-- Ajouter Ticket --}}
            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('tickets.create') }}" class="btn btn-primary mb-3 inline-block">Ajouter Ticket</a>
                @endif
            @endauth

            {{-- Table responsive --}}
            <div class="overflow-x-auto">
                <table class="table table-bordered min-w-full text-sm sm:text-base">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Objet</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Commercial</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($tickets->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-gray-500">Aucun ticket trouvé pour le moment.</div>
                                </td>
                            </tr>
                        @else
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->id }}</td>
                                    <td>{{ $ticket->client }}</td>
                                    <td>{{ $ticket->objet->titre }}</td>
                                    <td class="truncate max-w-xs">{{ $ticket->description }}</td>
                                    <td>
                                        @if ($ticket->status === 'reçu')
                                            <span class="badge bg-secondary">Reçu</span>
                                        @elseif($ticket->status === 'assigné')
                                            <span class="badge bg-primary">Assigné</span>
                                        @elseif($ticket->status === 'en cours')
                                            <span class="badge bg-warning text-dark">En cours</span>
                                        @elseif($ticket->status === 'terminé')
                                            <span class="badge bg-success">Terminé</span>
                                        @endif
                                    </td>
                                    <td>{{ $ticket->user->name ?? 'Non assigné' }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary dropdown-toggle w-full sm:w-auto m-1"
                                                type="button" id="dropdownMenu{{ $ticket->id }}"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $ticket->id }}">
                                                <li>
                                                    <!-- Modifier status via modal -->
                                                    <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#updateStatusModal{{ $ticket->id }}">
                                                        Modifier status
                                                    </button>
                                                </li>
                                                <li>
                                                    <!-- Voir ticket -->
                                                    <a class="dropdown-item"
                                                        href="{{ route('tickets.show', $ticket->id) }}">
                                                        Voir
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Modal --}}
                                <div class="modal fade" id="updateStatusModal{{ $ticket->id }}" tabindex="-1"
                                    aria-labelledby="updateStatusModalLabel{{ $ticket->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="updateStatusModalLabel{{ $ticket->id }}">
                                                        Modifier le status
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Fermer"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="status{{ $ticket->id }}"
                                                        class="form-label">Status</label>
                                                    <select name="status" id="status{{ $ticket->id }}"
                                                        class="form-select w-full">
                                                        <option value="en cours"
                                                            {{ $ticket->status === 'en cours' ? 'selected' : '' }}>En
                                                            cours</option>
                                                        <option value="terminé"
                                                            {{ $ticket->status === 'terminé' ? 'selected' : '' }}>
                                                            Terminé</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer flex flex-col sm:flex-row gap-2">
                                                    <button type="button" class="btn btn-secondary w-full sm:w-auto"
                                                        data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit"
                                                        class="btn btn-primary w-full sm:w-auto">Mettre à jour</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </tbody>

                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $tickets->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
