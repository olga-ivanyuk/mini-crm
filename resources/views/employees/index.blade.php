@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Employees</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.employees.create') }}" class="btn btn-outline-primary mb-3">
                Add New Employee
            </a>
            <table id="employeesTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Company</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->company->name }}</td>
                        <td>
                            <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-sm btn-primary">Edit</a>
                            <a href="{{ route('admin.employees.show', $employee) }}" class="btn btn-sm btn-info">View</a>
                            <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST" style="display:inline;">
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
    {{ $employees->links() }}
    <script>
        $(document).ready(function() {
            $('#employeesTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true
            });
        });
    </script>
@endsection

