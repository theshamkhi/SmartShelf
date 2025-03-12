<?php

namespace App\Http\Controllers;

use App\Models\Rayon;
use Illuminate\Http\Request;

class RayonController extends Controller
{
    public function index()
    {
        $rayons = Rayon::all();
        return response()->json($rayons);
    }

    public function show($id)
    {
        $rayon = Rayon::find($id);
        if (!$rayon) {
            return response()->json(['message' => 'Ray not found'], 404);
        }
        return response()->json($rayon);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $rayon = Rayon::create($request->all());
        return response()->json($rayon, 201);
    }

    public function update(Request $request, $id)
    {
        $rayon = Rayon::find($id);
        if (!$rayon) {
            return response()->json(['message' => 'Ray not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
        ]);

        $rayon->update($request->all());
        return response()->json($rayon);
    }

    public function destroy($id)
    {
        $rayon = Rayon::find($id);
        if (!$rayon) {
            return response()->json(['message' => 'Ray not found'], 404);
        }

        $rayon->delete();
        return response()->json(['message' => 'Ray removed']);
    }
}