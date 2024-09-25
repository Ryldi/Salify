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
                <div>Month Year: {{ \Carbon\Carbon::parse($month_year)->format('F Y') }}</div>
            </div>

            <!-- Month Year list -->
            <div class="col-md-12">
                <div class="row">
                    @foreach ($transactions as $index => $transaction)
                        @if ($index % 3 == 0)
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Customer Name</th>
                                                <th>Service Name</th>
                                                <th>Total Price</th>
                                                <th>Commission</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                        @endif
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d F Y') }}</td>
                                            <td>{{ $transaction->customer_name }}</td>
                                            <td>{{ $transaction->service_name }}</td>
                                            <td>Rp. {{ number_format($transaction->service_price * $transaction->service_quantity, 0, ',', ',') }}</td>
                                            <td>Rp. {{ number_format(($transaction->service_price * $transaction->service_quantity) - $transaction->post_commission, 0, ',', ',') }}</td>
                                        </tr>
                        @if (($index + 1) % 3 == 0 || $index === count($transactions) - 1)
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
