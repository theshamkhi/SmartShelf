<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rayon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'rayon_id' => 'required|exists:rayons,id',
            'category' => 'required|string',
            'is_promoted' => 'boolean',
            'popularity' => 'integer',
        ]);

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric',
            'quantity' => 'sometimes|integer',
            'rayon_id' => 'sometimes|exists:rayons,id',
            'category' => 'sometimes|string',
            'is_promoted' => 'boolean',
            'popularity' => 'integer',
        ]);

        $product->update($request->all());
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product removed']);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        $products = Product::where('name', 'like', "%$query%")
            ->orWhere('category', 'like', "%$query%")
            ->get();
    
        return response()->json($products);
    }

    public function getProductsInRayon($rayonId)
    {
        $rayon = Rayon::find($rayonId);
        if (!$rayon) {
            return response()->json(['message' => 'Rayon not found'], 404);
        }

        $products = Product::where('rayon_id', $rayonId)
            ->where(function ($query) {
                $query->where('is_promoted', true)
                    ->orWhere('popularity', '>', 5);
            })
            ->get();

        return response()->json($products);
    }

    public function getAlert()
    {
        $lowThresholdProducts = Product::where('quantity', '<=', 10)->get(['id', 'name', 'quantity']);

        if($lowThresholdProducts){
            return response()->json(['message' => 'ATTENTION: These products needs restocking.', $lowThresholdProducts]);
        }
        
    }
}