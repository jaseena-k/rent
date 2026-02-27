<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(private readonly ReportService $reportService)
    {
    }

    public function occupancy(): JsonResponse
    {
        return response()->json($this->reportService->occupancyRate());
    }

    public function pendingDues(): JsonResponse
    {
        return response()->json($this->reportService->pendingDues());
    }

    public function netCashFlow(Request $request): JsonResponse
    {
        $month = $request->string('month')->toString() ?: now()->format('Y-m');
        return response()->json($this->reportService->netCashFlow($month));
    }
}
