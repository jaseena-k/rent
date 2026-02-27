<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Lease;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Lease::with('tenant', 'unit')->paginate(15));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'tenant_id' => ['required', 'exists:tenants,id'],
            'unit_id' => ['required', 'exists:units,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'deposit' => ['required', 'numeric', 'min:0'],
            'monthly_rent' => ['required', 'numeric', 'min:0'],
            'due_day' => ['required', 'integer', 'between:1,28'],
            'status' => ['required', 'in:active,expired,terminated,pending'],
        ]);

        return response()->json(Lease::create($data), 201);
    }

    public function show(Lease $lease): JsonResponse
    {
        return response()->json($lease->load('tenant', 'unit', 'invoices'));
    }

    public function update(Request $request, Lease $lease): JsonResponse
    {
        $lease->update($request->validate([
            'end_date' => ['sometimes', 'date'],
            'deposit' => ['sometimes', 'numeric', 'min:0'],
            'monthly_rent' => ['sometimes', 'numeric', 'min:0'],
            'due_day' => ['sometimes', 'integer', 'between:1,28'],
            'status' => ['sometimes', 'in:active,expired,terminated,pending'],
        ]));

        return response()->json($lease->fresh());
    }

    public function destroy(Lease $lease): JsonResponse
    {
        $lease->delete();
        return response()->json(status: 204);
    }
}
