<?php
namespace App\Repositories;

use App\Models\CallTicket;

interface CallTicketRepositoryInterface {
    public function all();
    public function find($id);
    public function getByUser($id);
    public function create(array $data);
    public function updateStatus(CallTicket $ticket, string $status);
}
