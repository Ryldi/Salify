<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\Employee\EmployeeController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/staff_payroll/{emp_id}', [EmployeeController::class, 'show'])->name('staff_payroll.show');

Route::get('/staff_payroll', [EmployeeController::class, 'search'])->name('staff_payroll.search');

Route::get('/new_transaction', [TransactionController::class, 'index'])->name('new_transaction');

Route::post('/new_transaction', [TransactionController::class, 'store'])->name('new_transaction.post');

Route::get('/staff_commission/{emp_id}/{month_year}', [TransactionController::class, 'detail'])->name('staff_commission.show');