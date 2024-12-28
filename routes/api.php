<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransacaoController;
use App\Http\Middleware\CheckAccount;
use App\Http\Middleware\CheckAccountExist;
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

Route::group(['prefix' => '/conta'], function () {
    Route::get('/', [AccountController::class, 'index'])
        ->middleware(CheckAccount::class);

    Route::post('/', [AccountController::class, 'store'])
        ->middleware(CheckAccountExist::class);
});

Route::post('/transacao', [TransacaoController::class, 'update'])->name('update')
    ->middleware(CheckAccount::class);
