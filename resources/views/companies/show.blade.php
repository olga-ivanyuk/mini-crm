@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Company Details</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>Name:</strong>
                <p>{{ $company->name }}</p>
            </div>
            <div class="mb-3">
                <strong>Email:</strong>
                <p>{{ $company->email }}</p>
            </div>
            <div class="mb-3">
                <strong>Website:</strong>
                <p><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></p>
            </div>
            <div class="mb-3">
                <strong>Logo:</strong>
                @if ($company->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" class="img-thumbnail" width="100">
                @else
                    <p>No logo available</p>
                @endif
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.companies.index') }}" class="btn btn-outline-secondary">Back to List</a>
            <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-outline-primary">Edit Company</a>
        </div>
    </div>
@endsection
