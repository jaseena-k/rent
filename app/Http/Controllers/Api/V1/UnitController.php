<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Unit::with('building');
        if ($status = $request->string('status')->toString()) {
            $query->where('status', $status);
        }

        return response()->json($query->paginate(15));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'building_id' => ['required', 'exists:buildings,id'],
            'unit_number' => ['required', 'string', 'max:50'],
            'floor' => ['required', 'integer'],
            'type' => ['required', 'string', 'max:100'],
            'rent_amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:occupied,vacant,maintenance'],
        ]);

        return response()->json(Unit::create($data), 201);
    }

    public function show(Unit $unit): JsonResponse
    {
        return response()->json($unit->load('building', 'leases'));
    }

    public function update(Request $request, Unit $unit): JsonResponse
    {
        $data = $request->validate([
            'unit_number' => ['sometimes', 'string', 'max:50'],
            'floor' => ['sometimes', 'integer'],
            'type' => ['sometimes', 'string', 'max:100'],
            'rent_amount' => ['sometimes', 'numeric', 'min:0'],
            'status' => ['sometimes', 'in:occupied,vacant,maintenance'],
        ]);

        $unit->update($data);
        return response()->json($unit->fresh());
    }

    public function destroy(Unit $unit): JsonResponse
    {
        $unit->delete();
        return response()->json(status: 204);
    }
}
