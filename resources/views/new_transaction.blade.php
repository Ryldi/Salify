@extends('layouts.sidebar')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1>New Transaction</h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('new_transaction.post') }}" method="post">
        @csrf
        <!-- Customer Name Input -->
        <div class="form-group mb-3 border rounded p-3">
            <label for="customer_name">Customer Name</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter customer name" required>
        </div>

        <!-- Service Input Row -->
        <div id="serviceInputContainer">
            <div class="form-group mb-3 service-column border rounded p-3">
                <div class="mb-3">
                    <label for="service-1">Service 1</label>
                    <select class="form-control" name="service[]" id="service-1" required>
                        <option value="" disabled selected>Select service...</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->service_id }}">{{ $service->service_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="price-1">Price</label>
                    <input type="number" class="form-control" name="price[]" id="price-1" placeholder="100000" min="10000" required>
                </div>
                <div class="mb-3">
                    <label for="quantity-1">Quantity</label>
                    <input type="number" class="form-control" name="quantity[]" id="quantity-1" placeholder="1" min="1" value="1" required>
                </div>
                <div class="mb-3">
                    <label for="employee-1">Employee</label>
                    <select class="form-control" name="employee[]" id="employee-1" required>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->emp_id }}">{{ $employee->emp_firstName . ' ' . $employee->emp_lastName }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Disable delete button for the first service -->
                <button type="button" class="btn btn-outline-danger btn-sm mt-2 delete-service-btn" disabled>Delete</button>
            </div>

            <!-- Hidden Template -->
            <template id="service-template">
                <div class="form-group mb-3 service-column border rounded p-3">
                    <div class="mb-3">
                        <label for="service-{index}">Service {index}</label>
                        <select class="form-control" name="service[]" id="service-{index}" required>
                            <option value="" disabled selected>Select service...</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->service_id }}">{{ $service->service_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price-{index}">Price</label>
                        <input type="number" class="form-control" name="price[]" id="price-{index}" placeholder="100000" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity-{index}">Quantity</label>
                        <input type="number" class="form-control" name="quantity[]" id="quantity-{index}" placeholder="1" value="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="employee-{index}">Employee</label>
                        <select class="form-control" name="employee[]" id="employee-{index}" required>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->emp_id }}">{{ $employee->emp_firstName . ' ' . $employee->emp_lastName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Disable delete button for the first service -->
                    <button type="button" class="btn btn-outline-danger btn-sm mt-2 delete-service-btn">Delete</button>
                </div>
            </template>

        </div>

        <!-- Button to Add More Services -->
        <div class="form-group d-flex justify-content-between">
            <button type="button" class="btn btn-outline-primary" id="addServiceBtn">
                <i class="lni lni-plus"></i> Add Service
            </button>
            <button type="submit" class="btn btn-success">Create</button>
        </div>
        
    </form>
</div>
@endsection
