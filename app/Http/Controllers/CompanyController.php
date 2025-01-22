<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\StoreRequest;
use App\Http\Requests\Company\UpdateRequest;
use App\Mail\NewCompanyNotification;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CompanyController extends Controller
{

    public function __construct(protected CompanyService $companyService)
    {
    }

    public function index(): View
    {
        $companies = Company::all();

        return view('companies.index', compact('companies'));
    }

    public function create(): View
    {
        return view('companies.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('logo')) {
                $validated['logo'] = $this->companyService->handleLogoUpload($request->file('logo'));
            }

            $company = Company::query()->create($validated);

            if (!empty($company->email)) {
                Mail::to($company->email)->send(new NewCompanyNotification($company));
            }

            return redirect()
                ->route('admin.companies.index')
                ->with('success', 'Company created successfully');

        } catch (\Exception $e) {
            Log::error('Failed to create company: ' . $e->getMessage());

            return redirect()
                ->route('admin.companies.create')
                ->with('error', 'Error creating the company');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Company $company): View
    {
        return view('companies.edit', compact('company'));
    }

    public function update(UpdateRequest $request, Company $company): RedirectResponse
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('logo')) {
                $validated['logo'] = $this->companyService->handleLogoUpload($request->file('logo'), $company->logo);
            }

            $company->update($validated);

            return redirect()
                ->route('admin.companies.index')
                ->with('success', 'Company updated successfully');

        } catch (\Exception $e) {
            Log::error('Failed to update company: ' . $e->getMessage());

            return redirect()
                ->route('admin.companies.edit', $company)
                ->with('error', 'Error updating company');
        }
    }

    public function destroy(Company $company): RedirectResponse
    {
        $company->delete();

        return redirect()->route('admin.companies.index')->with('success', 'Company deleted successfully');
    }
}
