<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginRegisterController;
use App\Http\Controllers\Api\ClientController;

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

    return  $request->user(); // Récupérer l'utilisateur authentifié


});

// Public routes of authtication
Route::controller(LoginRegisterController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login')->name('login');
});

// Public routes of product
Route::controller(ClientController::class)->group(function() {
    Route::get('/clients', 'index');
    Route::get('/clients/{id}', 'show');
    Route::get('/clients/search/{name}', 'search');
});

// Protected routes of product and logout
Route::middleware('auth:sanctum')->group( function () {
    Route::post('/logout', [LoginRegisterController::class, 'logout']);

    Route::controller(ClientController::class)->group(function() {
        Route::post('/clients', 'store');
        Route::post('/clients/{id}', 'update');
    });
});
