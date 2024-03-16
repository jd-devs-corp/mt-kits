<?php

use App\Http\Controllers\ReceiptController;
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
Route::get('/download-receipt/{userId}', [ReceiptController::class, 'downloadReceipt']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('admin/receipt/generate/{id}', [ReceiptController::class, 'generateReceipt'])->name('receipts.generate');




