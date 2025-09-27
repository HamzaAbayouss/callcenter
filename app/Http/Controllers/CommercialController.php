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

    public function __construct(UserRepositoryInterface $userRepo, SpecialiteRepositoryInterface $specialiteRepo)
    {
        $this->userRepo = $userRepo;
        $this->specialiteRepo = $specialiteRepo;
    }

    public function index()
    {
        $commercials = $this->userRepo->all();
        return view('commercials.index', compact('commercials'));
    }

    public function create()
    {
        $specialites = $this->specialiteRepo->all();
        return view('commercials.create', compact('specialites'));
    }

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
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout du commercial.');
        }
    }

    public function show($id)
    {
        // Récupérer le commercial avec ses tickets
        $commercial = $this->userRepo->find($id);

        // Charger les tickets
        $tickets = $commercial->callTickets()->orderBy('created_at', 'desc')->get();

        return view('commercials.show', compact('commercial', 'tickets'));
    }
}
