<?php

namespace App\Repositories;

use App\Models\CallTicket;

class CallTicketRepository implements CallTicketRepositoryInterface
{

    public function all()
    {
        return CallTicket::with(['user', 'objet'])->paginate(10);
    }

    public function find($id)
    {
        return CallTicket::with('user', 'objet')->findOrFail($id);
    }

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
    public function getByUser($userId)
    {
        return CallTicket::where('user_id', $userId)->paginate(10);
    }

    public function updateStatus(CallTicket $ticket, string $status)
    {
        $ticket->status = $status;
        $ticket->save();
        return $ticket;
    }
}
