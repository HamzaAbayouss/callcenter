<?php

namespace App\Repositories;

use App\Models\CallTicket;

class CallTicketRepository implements CallTicketRepositoryInterface
{
    /**
     * Récupère tous les tickets avec pagination
     *
     * Inclut les relations 'user' et 'objet' pour éviter les requêtes N+1.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all()
    {
        return CallTicket::with(['user', 'objet'])->paginate(10);
    }

    /**
     * Trouve un ticket par son ID
     *
     * Inclut les relations 'user' et 'objet'.
     * Lève une exception si le ticket n'existe pas.
     *
     * @param int $id
     * @return CallTicket
     */
    public function find($id)
    {
        return CallTicket::with('user', 'objet')->findOrFail($id);
    }

    /**
     * Crée un nouveau ticket
     *
     * Initialise le ticket avec le status 'reçu' et aucun utilisateur assigné.
     *
     * @param array $data
     * @return CallTicket
     */
    public function create(array $data)
    {
        return CallTicket::create([
            'client' => $data['client'],
            'objet_id' => $data['objet_id'],
            'description' => $data['description'],
            'status' =>  'reçu',
            'user_id' =>  null,
        ]);
    }

    /**
     * Récupère tous les tickets assignés à un utilisateur donné
     *
     * Pagination appliquée pour limiter le nombre de résultats par page.
     *
     * @param int $userId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getByUser($userId)
    {
        return CallTicket::where('user_id', $userId)->paginate(10);
    }

    /**
     * Met à jour le status d'un ticket
     *
     * @param CallTicket $ticket
     * @param string $status
     * @return CallTicket
     */
    public function updateStatus(CallTicket $ticket, string $status)
    {
        $ticket->status = $status;
        $ticket->save();

        return $ticket;
    }
}
