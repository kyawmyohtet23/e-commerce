<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductDetailApiController extends Controller
{
    //
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->with('category', 'brand', 'color', 'review.user')->first();


        if (!$product) {
            return response()->json([
                'message' => false,
                'data' => 'Product_Not_Found',
            ]);
        }

        return response()->json([
            'message' => true,
            'data' => $product,
        ]);
    }
}
