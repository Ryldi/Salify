@extends('layouts.sidebar')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="text-center mb-4">
                <h1>Staff Payroll</h1>
            </div>

            <div class="col-md-12 mb-3 d-flex justify-content-between">
                <div>Staff: {{ $employee->emp_firstName . ' ' . $employee->emp_lastName }}</div>
                <div>Role: {{ $employee->emp_role }}</div>
            </div>

            <!-- Month Year list -->
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Month Year</th>
                            <th>Total Commission</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($commissions as $commission)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($commission->month_year)->format('F Y') }}</td>
                            <td>Rp. {{ number_format($commission->total_commission, 0, ',', ',') }}</td>
                            <td>
                                <button class="btn btn-outline-secondary" type="button">
                                    <a href="/staff_commission/{{ $employee->emp_id }}/{{ $commission->month_year }}" class="lni lni-folder"></a>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
