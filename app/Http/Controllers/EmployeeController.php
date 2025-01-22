<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(): View
    {
        $employees = Employee::query()->paginate(10);

        return view('employees.index', compact('employees'));
    }

    public function create(): View
    {
        $companies = Company::all();

        return view('employees.create', compact('companies'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Employee::query()->create($validated);

        return redirect()->route('admin.employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Employee $employee): View
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    public function update(UpdateRequest $request, Employee $employee): RedirectResponse
    {
        $validated = $request->validated();
        $employee->update($validated);

        return redirect()->route('admin.employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return redirect()->route('admin.employees.index')->with('success', 'Company deleted successfully.');
    }
}
