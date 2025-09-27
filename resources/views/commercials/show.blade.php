<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Détails Commercial') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-4">

                <div>
                    <h3 class="text-lg font-semibold mb-2">Informations Commercial</h3>
                    <p><strong>Nom :</strong> {{ $commercial->name }}</p>
                    <p><strong>Email :</strong> {{ $commercial->email }}</p>
                    <p><strong>Spécialité :</strong> {{ $commercial->specialite->nom }}</p>
                </div>

                <hr class="my-4">

                <div>
                    <h3 class="text-lg font-semibold mb-2">Tickets assignés</h3>
                    @if ($tickets->isEmpty())
                        <p>Aucun ticket assigné.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="table table-bordered w-full text-sm sm:text-base">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client</th>
                                        <th>Objet</th>
                                        <th>Description</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                            <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <div class="flex justify-start">
                    <a href="{{ route('commercials.index') }}" class="btn btn-secondary">Retour</a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
