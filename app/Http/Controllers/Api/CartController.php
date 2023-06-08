<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProductOrder;


class CartController extends Controller
{
    //
    public function addToCart(Request $request)
    {
        // return $request->all();
        // check product
        $product = Product::where('slug', $request->slug)->first();



        // return $product;
        if (!$product) {
            return 'product_not_found';
        }

        if (!auth()->check()) {
            return 'not_authorized';
        }

        $carts = ProductCart::all();
        // return $carts;
        foreach ($carts as $c) {
            if ($c->product_id == $request->id) {
                $c->update([
                    'total_quantity' => DB::raw('total_quantity + ' . $request->cartQty),
                ]);
                die();
            }
        }

        ProductCart::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'total_quantity' => $request->cartQty,
        ]);
















        $cartTotal = ProductCart::where('user_id', auth()->id())->count();

        $data = [
            'success' => true,
            'cartTotal' => $cartTotal,
        ];
        return response()->json($data);
    }



    public function getCart()
    {
        $cart = ProductCart::where('user_id', auth()->id())->with('product')->orderBy('id', 'desc')->get();

        return response()->json($cart);
    }


    public function addCart(Request $request)
    {
        $id = $request->id;

        ProductCart::where('id', $id)->update([
            'total_quantity' => DB::raw('total_quantity + 1'),
        ]);

        return 'success';
    }

    public function subCart(Request $request)
    {
        $id = $request->id;

        ProductCart::where('id', $id)->update([
            'total_quantity' => DB::raw('total_quantity - 1'),
        ]);

        return 'sub_success';
    }



    // check out cart
    public function checkOut(Request $request)
    {
        $name = $request->name;
        $email = $request->email;


        $cartData = ProductCart::where('user_id', auth()->id())->get();   // get array & loop(may be one user has many carts)
        if (!$cartData) {
            return 'check_out_fail';
        }
        foreach ($cartData as $c) {
            ProductOrder::create([
                'user_id' => auth()->id(),
                'name' => $name,
                'email' => $email,
                'product_id' => $c->product_id,
                'total_quantity' => $c->total_quantity,
            ]);
        }

        ProductCart::where('user_id', auth()->id())->delete();


        return 'check_out_success';
    }

    // order
    public function order()
    {
        $order = ProductOrder::where('user_id', auth()->id())
            ->with('product')
            ->orderBy('id', 'desc')
            ->paginate(4);
        return response()->json($order);
    }
}
