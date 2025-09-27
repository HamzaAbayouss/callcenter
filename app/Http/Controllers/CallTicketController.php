<?php

namespace App\Http\Controllers;

use App\Events\TicketAssigned;
use App\Http\Controllers\Controller;
use App\Repositories\CallTicketRepositoryInterface;
use App\Models\Objet;
use App\Repositories\ObjetRepositoryInterface;
use Illuminate\Http\Request;

class CallTicketController extends Controller
{
    private $ticketRepo;
    private $objetRepository;

    /**
     * Constructeur du contrôleur
     *
     * @param CallTicketRepositoryInterface $ticketRepo
     * @param ObjetRepositoryInterface $objetRepository
     */
    public function __construct(CallTicketRepositoryInterface $ticketRepo, ObjetRepositoryInterface $objetRepository)
    {
        $this->objetRepository = $objetRepository;
        $this->ticketRepo = $ticketRepo;
    }

    /**
     * Affiche la liste des tickets
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $user = auth()->user();

            // Si commercial, récupérer seulement ses tickets, sinon tous les tickets
            $tickets = $user->role === 'commercial'
                ? $this->ticketRepo->getByUser($user->id)
                : $this->ticketRepo->all();

            return view('tickets.index', compact('tickets'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la récupération des tickets : ' . $e->getMessage());
        }
    }

    /**
     * Affiche le formulaire de création d'un ticket
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        try {
            $objets = Objet::all();
            return view('tickets.create', compact('objets'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors du chargement du formulaire : ' . $e->getMessage());
        }
    }

    /**
     * Stocke un nouveau ticket depuis le formulaire web
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'client' => 'required|string|max:255',
            'objet_id' => 'required|exists:objets,id',
            'description' => 'required|string',
        ]);

        try {
            $ticket = $this->ticketRepo->create($request->only('client', 'objet_id', 'description'));

            // Émission de l'événement TicketAssigned
            event(new TicketAssigned($ticket));

            return redirect()->route('tickets.index')->with('success', 'Ticket créé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la création du ticket : ' . $e->getMessage());
        }
    }

    /**
     * Stocke un nouveau ticket depuis l'API
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeApi(Request $request)
    {
        try {
            // Préparation des données
            $request['client'] = $request['nom'];
            $request['objet_id'] = $this->objetRepository->getObjetByReference($request['objet'])->id;

            $ticket = $this->ticketRepo->create($request->only('client', 'objet_id', 'description'));

            // Émission de l'événement TicketAssigned
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

    /**
     * Affiche les détails d'un ticket
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $ticket = $this->ticketRepo->find($id);
            return view('tickets.show', compact('ticket'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'affichage du ticket : ' . $e->getMessage());
        }
    }

    /**
     * Met à jour le status d'un ticket
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $ticket = $this->ticketRepo->find($id);
            $user = auth()->user();

            // Vérification des permissions
            if ($user->role === 'commercial' && $ticket->user_id !== $user->id) {
                abort(403, 'Action non autorisée.');
            }

            $request->validate([
                'status' => 'required|in:reçu,assigné,en cours,terminé',
            ]);

            $this->ticketRepo->updateStatus($ticket, $request->status);

            return redirect()->back()->with('success', 'Status mis à jour avec succès !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour du status : ' . $e->getMessage());
        }
    }
}
