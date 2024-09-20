<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\Employee\EmployeeController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/staff_payroll', [EmployeeController::class, 'index'])->name('staff_payroll');

Route::get('/new_transaction', [TransactionController::class, 'index'])->name('new_transaction');

Route::post('/new_transaction', [TransactionController::class, 'store'])->name('new_transaction.post');