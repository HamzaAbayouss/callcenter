<?php

use App\Http\Controllers\CallTicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route API pour créer un ticket depuis le formulaire du site WordPress
// Connecte le formulaire à l'application interne (Exercice 1) via storeApi
Route::post('/support/send', [CallTicketController::class, 'storeApi']);
