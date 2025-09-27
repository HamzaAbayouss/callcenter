<?php

namespace App\Events;

use App\Models\CallTicket;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TicketAssigned implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ticket;

    public function __construct(CallTicket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('App.Models.User.' . $this->ticket->user_id);
    }

    public function broadcastAs()
    {

        return 'ticket.assigned';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->ticket->id,
            'status' => $this->ticket->status,
            'description' => $this->ticket->description,
            'objet' => $this->ticket->objet->titre,
            'user_id' => $this->ticket->user_id,
            'url' => route('tickets.show', ['ticket' => $this->ticket->id]), // <-- URL du détail
        ];
    }
}
