
@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Companies</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.companies.create') }}" class="btn btn-outline-primary mb-3">
                Add New Company
            </a>
            <table id="companiesTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Website</th>
                    <th>Logo</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>{{ $company->website }}</td>
                        <td>
                            @if ($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" width="30">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-sm btn-primary">Edit</a>
                            <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-sm btn-info">View</a>
                            <form action="{{ route('admin.companies.destroy', $company) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $companies->links() }}
    <script>
        $(document).ready(function() {
            $('#companiesTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true
            });
        });
    </script>
@endsection

