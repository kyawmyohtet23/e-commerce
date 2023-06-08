<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeApiController extends Controller
{
    //
    public function home()
    {
        $category = Category::withCount('product')->take(5)->get();
        $featuredProduct = Product::all()->random(2);

        $productByCategory = Category::has('product')->take(2)->get();

        $allProduct = Product::latest()->get();
        // return $allProduct;


        $trendProduct = Product::where('trend', 'trend')->get();


        foreach ($productByCategory as $key => $value) {
            $productByCategory[$key]->product = Product::where('category_id', $value->id)->get();
        }

        // return $productByCategory;
        return response()->json([
            'success' => true,
            'data' => [
                'category' => $category,
                'featuredProduct' => $featuredProduct,
                'productByCategory' => $productByCategory,
                'allProduct' => $allProduct,
                'trendProduct' => $trendProduct,
            ],
        ]);
    }
}
