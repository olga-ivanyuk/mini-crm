<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified'], 'as' => 'admin.'], function () {
    Route::resource('companies', CompanyController::class);
    Route::resource('employees', EmployeeController::class);
});
