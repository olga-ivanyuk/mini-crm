@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Employee Details</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>First Name:</strong>
                <p>{{ $employee->first_name }}</p>
            </div>
            <div class="mb-3">
                <strong>Last Name:</strong>
                <p>{{ $employee->last_name }}</p>
            </div>
            <div class="mb-3">
                <strong>Email:</strong>
                <p>{{ $employee->email }}</p>
            </div>
            <div class="mb-3">
                <strong>Phone:</strong>
                <p>{{ $employee->phone }}</p>
            </div>
            <div class="mb-3">
                <strong>Company:</strong>
                <p>{{ $employee->company->name }}</p>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.employees.index') }}" class="btn btn-outline-secondary">Back to List</a>
            <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-outline-primary">Edit Employee</a>
        </div>
    </div>
@endsection
