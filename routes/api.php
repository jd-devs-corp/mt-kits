<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginRegisterController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\KitController; // Assurez-vous d'importer le contrôleur Kit

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route pour récupérer l'utilisateur authentifié
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes publiques d'authentification
Route::post('/register', [LoginRegisterController::class, 'register']);
Route::post('/login', [LoginRegisterController::class, 'login'])->name('api_login');

// Routes publiques des clients
Route::get('/clients', [ClientController::class, 'index']);
Route::get('/clients/{id}', [ClientController::class, 'show']);
Route::get('/clients/search/{name}', [ClientController::class, 'search']);

// Routes protégées pour les clients et la déconnexion
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginRegisterController::class, 'logout']);
    Route::post('/clients', [ClientController::class, 'store']);
    Route::post('/clients/{id}', [ClientController::class, 'update']);
    Route::post('/kits', [KitController::class, 'store']);
    Route::post('/kits/{id}', [KitController::class, 'update']);
});
