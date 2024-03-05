<?php

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
    $user = $request->user(); // Récupérer l'utilisateur authentifié

    if (!$user->is_active) { // Vérifier l'existence et le statut actif
        return response()->json(['message' => 'Compte inactif'], 401);
    } else {
        return $user;
    }
});
