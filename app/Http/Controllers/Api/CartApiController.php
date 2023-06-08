<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartApiController extends Controller
{
    //
    public function addToCart(Request $request, $slug)
    {

        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return response()->json([
                'message' => false,
                'data' => 'product_not_found',
            ]);
        }
        // $product_qty = $product->total_quantity;

        $findInCart = ProductCart::where('user_id', $request->user_id)->where('product_id', $product->id)->first();

        // $cart_qty = $findInCart->total_quantity;


        // return $request->all();
        if ($findInCart) {
            $total_quantity = $findInCart->total_quantity + 1;
            $findInCart->update([
                'total_quantity' => $total_quantity,
            ]);
        } else {
            ProductCart::create([
                'product_id' => $product->id,
                'user_id' => $request->user_id,
                'total_quantity' => 1,
            ]);
        }

        $cart_count = ProductCart::where('user_id', $request->user_id)->count();
        return response()->json([
            'message' => true,
            'data' => $cart_count,
        ]);
    }
}
