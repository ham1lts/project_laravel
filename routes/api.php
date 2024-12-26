<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransacaoController;
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

Route::get('/conta', [AccountController::class, 'index'])->name('index');
Route::post('/conta', [AccountController::class, 'store'])->name('store');
Route::post('/transacao/{account}', [TransacaoController::class, 'update'])->name('update');
