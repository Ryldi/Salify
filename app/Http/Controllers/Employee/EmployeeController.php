<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\EmployeeCommission;

class EmployeeController
{
    public function index()
    {
        $employees = Employee::where('emp_firstName', '!=', 'No')
                         ->orWhere('emp_lastName', '!=', 'Employee')
                         ->get();
        return view('staff_payroll', ['employees' => $employees]);
    }

    public function show($emp_id)
    {
        $employee = Employee::find($emp_id);
        $commissions = EmployeeCommission::where('emp_id', $emp_id)->get();

        return view('staff_payroll_detail', ['employee' => $employee, 'commissions' => $commissions]);
    }

    public function detail($emp_id, $month_year)
    {
        $employee = Employee::find($emp_id);


        return view('staff_commission_detail', ['employee' => $employee, 'month_year' => $month_year]);
    }   

    public function search(Request $request)
    {
        $search = $request->input('search');
        $employees = Employee::where(function($query) use ($search) {
            $query->where('emp_firstName', 'like', '%' . $search . '%')
                  ->orWhere('emp_lastName', 'like', '%' . $search . '%')
                  ->orWhere('emp_role', 'like', '%' . $search . '%');
        })
        ->whereNot(function($query) {
            $query->where('emp_firstName', 'No')
                  ->where('emp_lastName', 'Employee');
        })
        ->get();

        return view('staff_payroll', ['employees' => $employees]);
    }
}
