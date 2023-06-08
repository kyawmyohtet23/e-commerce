<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    //
    public function index($slug)
    {

        $productByCategory = Category::where('slug', $slug)->with('product')->get();

        foreach ($productByCategory as $p) {

            $products = $p->product;
        }


        return view('category-product', compact('products'));
    }

    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->with('category', 'brand', 'color', 'review.user')->first();
        if (!$product) {
            return back()->with('error', 'Product Not Found');
        }

        $category_slug = $product->category->slug;

        return view('detail', compact('product', 'category_slug'));
    }
}
