<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Expense::with('building')->latest('expense_date')->paginate(15));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'building_id' => ['required', 'exists:buildings,id'],
            'category' => ['required', 'in:maintenance,utilities,taxes,security,other'],
            'amount' => ['required', 'numeric', 'min:0'],
            'expense_date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
        ]);

        return response()->json(Expense::create($data), 201);
    }

    public function show(Expense $expense): JsonResponse
    {
        return response()->json($expense->load('building'));
    }

    public function update(Request $request, Expense $expense): JsonResponse
    {
        $expense->update($request->validate([
            'category' => ['sometimes', 'in:maintenance,utilities,taxes,security,other'],
            'amount' => ['sometimes', 'numeric', 'min:0'],
            'expense_date' => ['sometimes', 'date'],
            'description' => ['nullable', 'string'],
        ]));

        return response()->json($expense->fresh());
    }

    public function destroy(Expense $expense): JsonResponse
    {
        $expense->delete();
        return response()->json(status: 204);
    }
}
