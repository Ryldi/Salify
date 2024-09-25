<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use App\Models\TransactionHeader;
use App\Models\TransactionDetail;
use App\Models\Service;
use App\Models\Employee;
use App\Models\EmployeeCommission;
use DB;

class TransactionController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        $employees = Employee::orderBy('commission_rate', 'asc')->get();
        return view('new_transaction', ['services' => $services, 'employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'customer_name' => 'required|min:3|max:255',
            'service' => 'required|array',
            'service.*' => 'exists:services,service_id',
            'price' => 'required|array',
            'price.*' => 'numeric|min:0',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
            'employee' => 'required|array',
            'employee.*' => 'exists:employees,emp_id',
        ]);

        $data = [
            'transaction_id' => (string) Str::uuid(),
            'customer_name' => $request->customer_name,
            'transaction_date' => date('Y-m-d H:i:s')
        ];

        TransactionHeader::create($data);

        $services = $request->input('service');
        $prices = $request->input('price');
        $quantities = $request->input('quantity');
        $employees = $request->input('employee');

        foreach ($services as $index => $service_id) {
            $employee = Employee::find($employees[$index]);

            TransactionDetail::create([
                'transaction_id' => $data['transaction_id'],
                'service_id' => $service_id,
                'emp_id' => $employees[$index],
                'service_price' => $prices[$index],
                'service_quantity' => $quantities[$index],
                'post_commission' => ($quantities[$index] * $prices[$index]) - ($quantities[$index] * $prices[$index] * $employee->commission_rate)
            ]);

            if ($employee->commission_rate > 0) {
                $transaction_month_year = date('Y-m', strtotime($data['transaction_date']));

                // Find the employee's commission for the same month and year
                $emp_commission = EmployeeCommission::where('emp_id', $employees[$index])
                    ->whereRaw("DATE_FORMAT(month_year, '%Y-%m') = ?", [$transaction_month_year])
                    ->first();
                
                if ($emp_commission) {
                    $emp_commission->total_commission += $quantities[$index] * $prices[$index] * $employee->commission_rate;
                    $emp_commission->save();
                } else {
                    EmployeeCommission::create([
                        'emp_id' => $employees[$index],
                        'month_year' => $data['transaction_date'],
                        'total_commission' => $quantities[$index] * $prices[$index] * $employee->commission_rate
                    ]);
                }
            }
        }

        return redirect()->route('new_transaction')->with('success', 'Transaction success!');
    }


    public function detail($emp_id, $month_year)
    {
        $employee = Employee::find($emp_id);

        $month_year = date('Y-m', strtotime($month_year));
        
        [$year, $month] = explode('-', $month_year);

        $transactions = DB::table('transaction_details')
            ->join('transaction_headers', 'transaction_details.transaction_id', '=', 'transaction_headers.transaction_id')
            ->join('services', 'transaction_details.service_id', '=', 'services.service_id')
            ->where('transaction_details.emp_id', $emp_id)
            ->whereYear('transaction_headers.transaction_date', $year)
            ->whereMonth('transaction_headers.transaction_date', $month)
            ->select(
                'transaction_headers.transaction_date',
                'transaction_headers.customer_name',
                'services.service_name',
                'transaction_details.service_price',
                'transaction_details.service_quantity',
                'transaction_details.post_commission'
            )
            ->orderBy('transaction_headers.transaction_date', 'asc')
            ->get();

        return view('staff_commission_detail', [
            'employee' => $employee,
            'month_year' => $month_year,
            'transactions' => $transactions,
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
