<?php

use App\Http\Controllers\CallTicketController;
use App\Http\Controllers\CommercialController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ici vous pouvez définir toutes les routes web de votre application.
| Ces routes sont chargées par le RouteServiceProvider et appartiennent
| au groupe de middleware "web".
|
*/

// Page d'accueil accessible à tous
Route::get('/', function () {
    return view('welcome');
});

// Routes accessibles uniquement aux utilisateurs authentifiés
Route::middleware('auth')->group(function () {
    // Tableau de bord
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Gestion du profil de l'utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes liées aux tickets et aux commerciaux
Route::middleware(['auth'])->group(function () {

    // Tous les utilisateurs authentifiés peuvent accéder à la liste des tickets
    Route::get('tickets', [CallTicketController::class, 'index'])->name('tickets.index');

    // Routes réservées uniquement aux admins
    Route::middleware(['role:admin'])->group(function () {
        // CRUD des commerciaux
        Route::resource('commercials', CommercialController::class);

        // Création de tickets
        Route::get('tickets/create', [CallTicketController::class, 'create'])->name('tickets.create');
        Route::post('tickets/store', [CallTicketController::class, 'store'])->name('tickets.store');
    });

    // Routes tickets accessibles aux admins et commerciaux pour certaines actions
    Route::middleware(['role:admin,commercial'])->group(function () {
        // Édition d'un ticket
        Route::get('tickets/{ticket}/edit', [CallTicketController::class, 'edit'])->name('tickets.edit');

        // Consultation d'un ticket (accessible aux commerciaux)
        Route::get('tickets/{ticket}', [CallTicketController::class, 'show'])->name('tickets.show');

        // Mise à jour d'un ticket
        Route::put('tickets/{ticket}', [CallTicketController::class, 'update'])->name('tickets.update');
    });
});

// Fichier d'authentification (login, register, etc.)
require __DIR__ . '/auth.php';
