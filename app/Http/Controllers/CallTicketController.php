<?php

namespace App\Http\Controllers;

use App\Events\TicketAssigned;
use App\Http\Controllers\Controller;
use App\Repositories\CallTicketRepositoryInterface;
use App\Models\Objet;
use App\Models\User;
use App\Repositories\ObjetRepositoryInterface;
use Illuminate\Http\Request;

class CallTicketController extends Controller
{
    private $ticketRepo;
    private $objetRepository;

    public function __construct(CallTicketRepositoryInterface $ticketRepo, ObjetRepositoryInterface $objetRepository)
    {
        $this->objetRepository = $objetRepository;
        $this->ticketRepo = $ticketRepo;
    }

    public function index()
    {
        $user = auth()->user();

        // Si commercial, récupérer seulement ses tickets, sinon tous les tickets
        $tickets = $user->role == 'commercial'
            ? $this->ticketRepo->getByUser($user->id)
            : $this->ticketRepo->all();

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $objets = Objet::all();
        return view('tickets.create', compact('objets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client' => 'required|string|max:255',
            'objet_id' => 'required|exists:objets,id',
            'description' => 'required|string',
        ]);

        try {
            $ticket =  $this->ticketRepo->create($request->only('client', 'objet_id', 'description'));
            event(new TicketAssigned($ticket));

            return redirect()->route('tickets.index')->with('success', 'Ticket créé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la création du ticket.');
        }
    }
    public function storeApi(Request $request)
    {
        $request['client'] = $request['nom'];
        $request['objet_id'] = $this->objetRepository->getObjetByReference($request['objet'])->id;

        try {
            $ticket =  $this->ticketRepo->create($request->only('client', 'objet_id', 'description'));
            event(new TicketAssigned($ticket));

            return response()->json([
                'ok' => true,
                'data' => $ticket,
                'message' => 'Demande envoyée avec succès',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'ok' => false,
                'message' => 'Erreur lors de la création du ticket.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        $ticket = $this->ticketRepo->find($id);
        return view('tickets.show', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        $ticket = $this->ticketRepo->find($id);
        $user = auth()->user();

        if ($user->role === 'commercial' && $ticket->user_id !== $user->id) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:reçu,assigné,en cours,terminé',
        ]);

        $this->ticketRepo->updateStatus($ticket, $request->status);

        return redirect()->back()->with('success', 'Status mis à jour avec succès !');
    }
}
