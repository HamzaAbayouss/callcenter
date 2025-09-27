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
     */
    public function created(CallTicket $ticket)
    {
        $this->assignTicketToCommercial($ticket);
    }

    private function assignTicketToCommercial(CallTicket $ticket)
    {
        $specialite_id = $ticket->objet->specialite_id ?? null;
        if (!$specialite_id) {
            return null;
        }


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



        // Affecter le ticket
        $ticket->user_id = $commercial->id;
        $ticket->status = 'assigné';
        $ticket->save();

        event(new TicketAssigned($ticket));


        return $commercial;
    }


    /**
     * Handle the CallTicket "updated" event.
     */
    public function updated(CallTicket $callTicket): void
    {
        //
    }

    /**
     * Handle the CallTicket "deleted" event.
     */
    public function deleted(CallTicket $callTicket): void
    {
        //
    }

    /**
     * Handle the CallTicket "restored" event.
     */
    public function restored(CallTicket $callTicket): void
    {
        //
    }

    /**
     * Handle the CallTicket "force deleted" event.
     */
    public function forceDeleted(CallTicket $callTicket): void
    {
        //
    }
}
