<!-- resources/views/payroll.blade.php -->
@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-3">
                <!-- Search bar -->
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search...">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="lni lni-search"></i> <!-- FontAwesome for search icon -->
                        </button>
                    </div>
                </div>
            </div>

            <!-- Staff list -->
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Staff Name</th>
                            <th>Staff Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->emp_firstName . ' ' . $employee->emp_lastName }}</td>
                            <td>{{ $employee->emp_role }}</td>
                            <td>
                                <a href="" class="btn btn-info">
                                    View Commission
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
