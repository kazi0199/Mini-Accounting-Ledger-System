<?php

use App\Http\Controllers\LedgerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//Add Transition
Route::get('/ledger/add', [LedgerController::class, 'addForm']);

Route::get('/ledger/add', [LedgerController::class, 'addForm'])->name('add.form');

Route::post('/ledger/store', [LedgerController::class, 'storeTransition'])->name('store.transition');


//Show Transaction
Route::get('/ledger/history/{id}', [LedgerController::class, 'transitionHistory'])->name('transition.history');


//send transaction report
Route::post('/ledger/{id}/send-email',[LedgerController::class,'sendLedgerEmail'])->name('sendEmail');


















