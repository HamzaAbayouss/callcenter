<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\SpecialiteRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class CommercialController extends Controller
{
    private $userRepo;
    private $specialiteRepo;

    /**
     * Constructeur du contrôleur
     *
     * @param UserRepositoryInterface $userRepo
     * @param SpecialiteRepositoryInterface $specialiteRepo
     */
    public function __construct(UserRepositoryInterface $userRepo, SpecialiteRepositoryInterface $specialiteRepo)
    {
        $this->userRepo = $userRepo;
        $this->specialiteRepo = $specialiteRepo;
    }

    /**
     * Affiche la liste des commerciaux
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $commercials = $this->userRepo->all();
            return view('commercials.index', compact('commercials'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la récupération des commerciaux : ' . $e->getMessage());
        }
    }

    /**
     * Affiche le formulaire de création d'un commercial
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        try {
            $specialites = $this->specialiteRepo->all();
            return view('commercials.create', compact('specialites'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors du chargement du formulaire : ' . $e->getMessage());
        }
    }

    /**
     * Stocke un nouveau commercial
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'specialite_id' => 'required|exists:specialites,id',
        ]);

        try {
            $this->userRepo->create($request->only('name', 'email', 'specialite_id'));
            return redirect()->route('commercials.index')
                ->with('success', 'Commercial ajouté avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout du commercial : ' . $e->getMessage());
        }
    }

    /**
     * Affiche les détails d'un commercial avec ses tickets
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        try {
            // Récupérer le commercial
            $commercial = $this->userRepo->find($id);

            // Charger les tickets du commercial, triés par date de création décroissante
            $tickets = $commercial->callTickets()->orderBy('created_at', 'desc')->get();

            return view('commercials.show', compact('commercial', 'tickets'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'affichage du commercial : ' . $e->getMessage());
        }
    }
}
