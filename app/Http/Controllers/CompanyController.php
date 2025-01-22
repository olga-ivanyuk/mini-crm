<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\StoreRequest;
use App\Http\Requests\Company\UpdateRequest;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CompanyController extends Controller
{

    public function __construct(protected CompanyService $companyService)
    {
    }

    public function index(): View
    {
        $companies = Company::query()->paginate(10);

        return view('companies.index', compact('companies'));
    }

    public function create(): View
    {
        return view('companies.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['logo'] = $this->companyService->handleLogoUpload($request->file('logo'));
        Company::query()->create($validated);

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Company $company): View
    {
        return view('companies.edit', compact('company'));
    }

    public function update(UpdateRequest $request, $company): RedirectResponse
    {
        $validated = $request->validated();
        $validated['logo'] = $this->companyService->handleLogoUpload($request->file('logo'), $company->logo);
        $company->update($validated);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company): RedirectResponse
    {
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
