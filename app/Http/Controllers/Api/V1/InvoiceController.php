<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Invoice::with('lease.tenant', 'lease.unit');
        if ($request->filled('status')) {
            $query->where('status', $request->string('status')->toString());
        }

        return response()->json($query->paginate(15));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'lease_id' => ['required', 'exists:leases,id'],
            'billing_month' => ['required', 'date'],
            'amount' => ['required', 'numeric', 'min:0'],
            'balance' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:paid,partial,unpaid,late'],
            'due_date' => ['required', 'date'],
        ]);

        return response()->json(Invoice::create($data), 201);
    }

    public function show(Invoice $invoice): JsonResponse
    {
        return response()->json($invoice->load('lease.tenant', 'lease.unit', 'payments'));
    }

    public function update(Request $request, Invoice $invoice): JsonResponse
    {
        $invoice->update($request->validate([
            'balance' => ['sometimes', 'numeric', 'min:0'],
            'status' => ['sometimes', 'in:paid,partial,unpaid,late'],
            'due_date' => ['sometimes', 'date'],
        ]));

        return response()->json($invoice->fresh());
    }

    public function destroy(Invoice $invoice): JsonResponse
    {
        $invoice->delete();
        return response()->json(status: 204);
    }
}
