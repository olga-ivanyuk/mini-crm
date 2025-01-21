<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(): View
    {
        $employees = Employee::all();

        return view('employees.index', compact('employees'));
    }

    public function create(): View
    {
        return view('employees.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        Employee::query()->create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Employee $employee): View
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $employee): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'logo' => 'nullable|image|max:2048',
            'website' => 'nullable|url',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Company deleted successfully.');
    }
}
