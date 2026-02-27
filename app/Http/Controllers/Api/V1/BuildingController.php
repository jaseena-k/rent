<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Building::query();
        if ($search = $request->string('search')->toString()) {
            $query->where('name', 'ilike', "%{$search}%");
        }

        return response()->json($query->latest()->paginate(15));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'floors' => ['required', 'integer', 'min:1'],
            'total_units' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ]);

        return response()->json(Building::create($data), 201);
    }

    public function show(Building $building): JsonResponse
    {
        return response()->json($building->load('units'));
    }

    public function update(Request $request, Building $building): JsonResponse
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'address' => ['sometimes', 'string'],
            'floors' => ['sometimes', 'integer', 'min:1'],
            'total_units' => ['sometimes', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ]);

        $building->update($data);
        return response()->json($building->fresh());
    }

    public function destroy(Building $building): JsonResponse
    {
        $building->delete();
        return response()->json(status: 204);
    }
}
