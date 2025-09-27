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
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    // Tous les utilisateurs authentifiés peuvent accéder aux tickets index
    Route::get('tickets', [CallTicketController::class, 'index'])->name('tickets.index');

    // Toutes les autres actions tickets réservées uniquement aux admins
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('commercials', CommercialController::class);
        Route::get('tickets/create', [CallTicketController::class, 'create'])->name('tickets.create');
        Route::post('tickets/store', [CallTicketController::class, 'store'])->name('tickets.store');
    });

    // Routes tickets réservées aux admins ou aux commerciaux pour certaines actions
    Route::middleware(['role:admin,commercial'])->group(function () {
        Route::get('tickets/{ticket}/edit', [CallTicketController::class, 'edit'])->name('tickets.edit');
        Route::get('tickets/{ticket}', [CallTicketController::class, 'show'])->name('tickets.show'); // <-- accès commercial
        Route::put('tickets/{ticket}', [CallTicketController::class, 'update'])->name('tickets.update');
    });

    // Route::put('tickets/{ticket}', [CallTicketController::class, 'update'])->name('tickets.update')->middleware(['auth', 'role:admin,commercial']);
});

require __DIR__ . '/auth.php';
