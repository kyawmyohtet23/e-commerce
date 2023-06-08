<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // index
    public function index()
    {
        $orders = ProductOrder::orderBy('id', 'desc')->with('product')->paginate(3);

        // return $orders;
        // $data = ProductOrder::where('status', 'success')->with('product')->get();


        // return  ProductOrder::where('product_id', $products->id)->get();

        return view('admin.order.index', compact('orders'));
    }

    // change status
    public function changeStatus(Request $request)
    {
        $data = ProductOrder::where('id', $request->id)->with('product')->first();
        // return $data;
        $product = Product::where('id', $data->product->id)->first();


        $data->update([
            'status' => $request->status,
        ]);

        if ($data->status == 'success') {
            $product->update([
                'total_quantity' => DB::raw('total_quantity - ' . $data->total_quantity),
            ]);
        }
        return back()->with('success', 'Status Changed...');
    }
}
