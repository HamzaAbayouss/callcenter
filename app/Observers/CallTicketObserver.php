<?php

namespace App\Observers;

use App\Events\TicketAssigned;
use App\Models\CallTicket;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CallTicketObserver
{
    /**
     * Handle the CallTicket "created" event.
     *
     * Cette méthode est appelée automatiquement lorsqu'un ticket est créé.
     * Elle s'occupe d'assigner le ticket à un commercial disponible.
     */
    public function created(CallTicket $ticket)
    {
        $this->assignTicketToCommercial($ticket);
    }

    /**
     * Assigner le ticket à un commercial disponible
     *
     * @param CallTicket $ticket
     * @return object|null
     */
    private function assignTicketToCommercial(CallTicket $ticket)
    {
        // Récupérer l'ID de la spécialité associée à l'objet du ticket
        $specialite_id = $ticket->objet->specialite_id ?? null;

        // Si pas de spécialité, on ne fait rien
        if (!$specialite_id) {
            return null;
        }

        // Requête pour trouver le commercial avec le moins de tickets actifs
        $commercial = DB::table('users as u')
            ->select(
                'u.id',
                'u.name',
                'u.email',
                's.nom as specialite',
                DB::raw('COUNT(ct.id) as total_tickets'),
                DB::raw("SUM(CASE WHEN ct.status IN ('assigné', 'en cours') THEN 1 ELSE 0 END) as active_tickets"),
                DB::raw("SUM(CASE WHEN ct.status = 'terminé' THEN 1 ELSE 0 END) as closed_tickets")
            )
            ->leftJoin('specialites as s', 'u.specialite_id', '=', 's.id')
            ->leftJoin('call_tickets as ct', 'ct.user_id', '=', 'u.id')
            ->where('u.role', 'commercial')
            ->where('u.specialite_id', $specialite_id)
            ->groupBy('u.id', 'u.name', 'u.email', 's.nom')
            ->orderBy('active_tickets', 'asc')
            ->first();

        // Affecter le ticket au commercial sélectionné
        $ticket->user_id = $commercial->id;
        $ticket->status = 'assigné';
        $ticket->save();

        // Déclencher l'événement TicketAssigned pour notifier le commercial
        event(new TicketAssigned($ticket));

        return $commercial;
    }
}
