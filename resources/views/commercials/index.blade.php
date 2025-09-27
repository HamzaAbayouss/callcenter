<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Commerciaux') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

                <a href="{{ route('commercials.create') }}" class="btn btn-primary mb-3 inline-block">Ajouter Commercial</a>

                <div class="overflow-x-auto">
                    <table class="table table-bordered w-full text-sm sm:text-base">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Spécialité</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commercials as $commercial)
                                <tr>
                                    <td>{{ $commercial->name }}</td>
                                    <td>{{ $commercial->email }}</td>
                                    <td>{{ $commercial->specialite->nom }}</td>
                                    <td>
                                        <a href="{{ route('commercials.show', $commercial->id) }}" class="btn btn-info btn-sm w-full sm:w-auto">Voir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
