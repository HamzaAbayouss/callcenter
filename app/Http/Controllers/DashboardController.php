<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Specialite;
use App\Models\Objet;
use App\Models\CallTicket;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Tickets par spécialité
        $ticketsBySpecialite = Specialite::withCount(['objets as tickets_count' => function ($query) {
            $query->join('call_tickets', 'objets.id', '=', 'call_tickets.objet_id');
        }])->get();

        // Préparer les labels et données pour Chart.js
        $labels = $ticketsBySpecialite->pluck('nom');
        $data = $ticketsBySpecialite->pluck('tickets_count');

        $ticketsByStatus = CallTicket::select('status', DB::raw('count(*) as total'))
            ->whereIn('status', ['reçu', 'assigné', 'en cours', 'terminé'])
            ->groupBy('status')
            ->pluck('total', 'status'); // clé = status, valeur = total

        // Récupérer le nombre de commerciaux par spécialité
        $specialites = Specialite::withCount(['users as commerciaux_count' => function ($query) {
            $query->where('role', 'commercial');
        }])->get();

        // Total des commerciaux pour calculer le pourcentage
        $totalCommerciaux = $specialites->sum('commerciaux_count');

        // Préparer labels et data en pourcentage
        $labels_totalCommerciaux = $specialites->pluck('nom');
        $data_totalCommerciaux = $specialites->map(function ($s) use ($totalCommerciaux) {
            return $totalCommerciaux > 0 ? round(($s->commerciaux_count / $totalCommerciaux) * 100, 2) : 0;
        });

        return view(
            'dashboard',
            compact(
                'ticketsByStatus',
                'ticketsBySpecialite',
                'labels',
                'data',
                'labels_totalCommerciaux',
                'data_totalCommerciaux'
            )
        );
    }
}
