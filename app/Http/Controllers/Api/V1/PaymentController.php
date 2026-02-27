<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function store(Request $request, Invoice $invoice): JsonResponse
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric', 'gt:0'],
            'payment_date' => ['required', 'date'],
            'method' => ['required', 'in:cash,bank_transfer,upi,card,other'],
            'receipt_number' => ['required', 'string', 'max:100'],
            'notes' => ['nullable', 'string'],
        ]);

        return DB::transaction(function () use ($invoice, $data): JsonResponse {
            $payment = Payment::create($data + ['invoice_id' => $invoice->id]);

            $newBalance = max(0, (float) $invoice->balance - (float) $payment->amount);
            $status = $newBalance <= 0 ? 'paid' : ($newBalance < $invoice->amount ? 'partial' : 'unpaid');

            $invoice->update([
                'balance' => $newBalance,
                'status' => $status,
            ]);

            return response()->json([
                'payment' => $payment,
                'invoice' => $invoice->fresh(),
            ], 201);
        });
    }
}
