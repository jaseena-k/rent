<?php

use App\Http\Controllers\Api\V1\BuildingController;
use App\Http\Controllers\Api\V1\ExpenseController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\LeaseController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\ReportController;
use App\Http\Controllers\Api\V1\TenantController;
use App\Http\Controllers\Api\V1\UnitController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware(['auth:sanctum'])->group(function (): void {
    Route::apiResource('buildings', BuildingController::class);
    Route::apiResource('units', UnitController::class);
    Route::apiResource('tenants', TenantController::class);
    Route::apiResource('leases', LeaseController::class);
    Route::apiResource('invoices', InvoiceController::class);
    Route::post('invoices/{invoice}/payments', [PaymentController::class, 'store'])->name('invoices.payments.store');
    Route::apiResource('expenses', ExpenseController::class);

    Route::get('reports/occupancy', [ReportController::class, 'occupancy']);
    Route::get('reports/pending-dues', [ReportController::class, 'pendingDues']);
    Route::get('reports/net-cash-flow', [ReportController::class, 'netCashFlow']);
});
