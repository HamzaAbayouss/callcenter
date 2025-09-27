<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Statistiques par statut -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-xl shadow-lg hover:scale-105 transform transition">
                    <h4 class="text-lg font-semibold mb-2 truncate">Reçu</h4>
                    <p class="text-3xl font-bold">{{ $ticketsByStatus['reçu'] ?? 0 }}</p>
                </div>
                <div
                    class="bg-gradient-to-r from-yellow-400 to-yellow-600 text-white p-6 rounded-xl shadow-lg hover:scale-105 transform transition">
                    <h4 class="text-lg font-semibold mb-2 truncate">Assigné</h4>
                    <p class="text-3xl font-bold">{{ $ticketsByStatus['assigné'] ?? 0 }}</p>
                </div>
                <div
                    class="bg-gradient-to-r from-orange-400 to-orange-600 text-white p-6 rounded-xl shadow-lg hover:scale-105 transform transition">
                    <h4 class="text-lg font-semibold mb-2 truncate">En cours</h4>
                    <p class="text-3xl font-bold">{{ $ticketsByStatus['en cours'] ?? 0 }}</p>
                </div>
                <div
                    class="bg-gradient-to-r from-green-500 to-green-700 text-white p-6 rounded-xl shadow-lg hover:scale-105 transform transition">
                    <h4 class="text-lg font-semibold mb-2 truncate">Terminé</h4>
                    <p class="text-3xl font-bold">{{ $ticketsByStatus['terminé'] ?? 0 }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tickets par spécialité -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg w-full">
                    <h4 class="font-bold text-lg mb-4 text-gray-700 dark:text-gray-200 truncate">Tickets par spécialité
                    </h4>
                    <div class="w-full h-64">
                        <canvas id="ticketsChart" class="w-full h-full"></canvas>
                    </div>
                </div>

                <!-- Pourcentage de commerciaux par spécialité -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg w-full">
                    <h4 class="font-bold text-lg mb-4 text-gray-700 dark:text-gray-200 truncate">Pourcentage de
                        commerciaux</h4>
                    <div class="w-full h-64 flex justify-center items-center">
                        <div class="w-full sm:w-3/4 h-full">
                            <canvas id="commerciauxChart" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Bar Chart tickets
        const ctx = document.getElementById('ticketsChart').getContext('2d');
        const ticketsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Nombre de tickets',
                    data: @json($data),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Doughnut Chart commerciaux
        const ctx2 = document.getElementById('commerciauxChart').getContext('2d');
        const commerciauxChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: @json($labels_totalCommerciaux),
                datasets: [{
                    data: @json($data_totalCommerciaux),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
                        'rgba(201, 203, 207, 0.7)'
                    ],
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '50%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw + '%';
                            }
                        }
                    }
                }
            }
        });
    </script>

</x-app-layout>
