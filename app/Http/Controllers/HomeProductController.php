<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
// use Faker\Provider\fr_FR\Color;

class HomeProductController extends Controller
{
    //
    public function detail($slug)
    {

        $product = Product::where('slug', $slug)->with('category', 'brand', 'color', 'review.user')->first();


        if (!$product) {
            return redirect()->route('home')->with('error', 'Product Not Found');
        }

        return view('product-detail', compact('slug', 'product'));
    }

    // all product
    public function allProduct(Request $request)
    {
        $category = Category::all();
        $color =  Color::all();
        $brand = Brand::all();

        $product = Product::orderBy('id', 'desc');
        // return $product;

        // category 
        $category_slug = $request->category_slug;
        if ($category_slug) {
            $category_id = Category::where('slug', $category_slug)->first()->id;
            $product->where('category_id', $category_id);
        }

        $brand_slug = $request->brand_slug;
        if ($brand_slug) {
            $brand_id = Brand::where('slug', $brand_slug)->first()->id;
            $product->where('brand_id', $brand_id);
        }

        $color_slug = $request->color_slug;
        if ($color_slug) {
            $color_id = Color::where('slug', $color_slug)->first()->id;
            $product->whereHas('color', function ($query) use ($color_id) {
                $query->where('product_color.color_id', $color_id);
            });
        }

        $nameSearch = $request->nameSearch;
        if ($nameSearch) {
            $product->where('name', 'like', "%$nameSearch%");
        }


        $product = $product->paginate(12);

        // return 'not choose';



        return view('all-product', compact('category', 'color', 'brand', 'product'));
    }
}
