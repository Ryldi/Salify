@extends('layouts.sidebar')

@section('content')
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1>Staff Payroll</h1>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <form action="{{ route('staff_payroll.search') }}" method="GET" class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search..." aria-label="Search...">
                </form>
            </div>

            <!-- Staff list -->
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Staff Name</th>
                            <th>Staff Role</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->emp_firstName . ' ' . $employee->emp_lastName }}</td>
                            <td>{{ $employee->emp_role }}</td>
                            <td>
                                <button class="btn btn-outline-secondary" type="button">
                                    <a href="/staff_payroll/{{ $employee->emp_id }}" class="lni lni-folder"></a>
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
