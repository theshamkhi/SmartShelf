<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function getStats()
    {
        $mostSoldProducts = Order::select('product_id', DB::raw('COUNT(*) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->with(['product' => function ($query) {
                $query->select('id', 'name', 'quantity');
            }])
            ->get();

        $criticalStockProducts = Product::where('quantity', '<=', 1)
            ->orderBy('quantity')
            ->get(['id', 'name', 'quantity']);

        return response()->json([
            'most_sold_products' => $mostSoldProducts,
            'critical_stock_products' => $criticalStockProducts,
        ]);
    }
}