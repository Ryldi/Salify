<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;

use App\Models\Employee;

class EmployeeController
{
    public function index()
    {
        $employees = Employee::where('emp_firstName', '!=', 'No')
                         ->orWhere('emp_lastName', '!=', 'Employee')
                         ->get();
        return view('staff_payroll', ['employees' => $employees]);
    }
}
