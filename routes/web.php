<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Ignition\ErrorPage\ErrorPageViewModel;

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
    $user = Auth::user();
    // dump($user);
    if ($user && $user->role == 'fournisseur') {
        return redirect('/supplier');
    } elseif($user && $user->role == 'admin') {
        return redirect('/admin');
    }
    else{
        return view('welcome');
    }

});



/*Route::get('/admin/login', [
    'as' => 'login',
    'uses' => 'AuthController@getLogin',
    'middleware' => 'statut',
]);*/

