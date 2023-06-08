<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\File;
use App\Models\ProductAddTransaction;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $product = Product::latest()->select('id', 'slug', 'name', 'image', 'total_quantity', 'trend')->paginate(5);

        // dd($product->count());
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $category = Category::all();
        $supplier = Supplier::all();
        $brand = Brand::all();
        $color = Color::all();
        return view('admin.product.create', compact('category', 'supplier', 'brand', 'color'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $validation = $this->validation($request);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        // image upload
        $image = $request->file('image');
        $image_name = uniqid() . ($image->getClientOriginalName());
        $image->move(public_path('/images'), $image_name);

        // product store

        $category = Category::where('slug', $request->category_slug)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found!');
        }

        $supplier = Supplier::where('id', $request->supplier_slug)->first();
        if (!$supplier) {
            return redirect()->back()->with('error', 'Supplier not found!');
        }

        $brand = Brand::where('slug', $request->brand_slug)->first();
        if (!$brand) {
            return redirect()->back()->with('error', 'Brand not found!');
        }

        $colors = [];
        foreach ($request->color_slug as $col) {
            $color = Color::where('slug', $col)->first();
            if (!$color) {
                return redirect()->back()->with('error', 'Color not found!');
            }

            $colors[] = $color->id;
        }

        // product store
        $product = Product::create([
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
            'brand_id' => $brand->id,
            'slug' =>  uniqid() . Str::slug($request->name),
            'name' => $request->name,
            'image' => $image_name,
            'discount_price' => $request->discount_price,
            'buy_price' => $request->buy_price,
            'sale_price' => $request->sale_price,
            'total_quantity' => $request->total_quantity,
            'view_count' => 0,
            'like_count' => 0,
            'description' => $request->description,
        ]);



        // add to transaction
        ProductAddTransaction::create([
            'product_id' => $product->id,
            'supplier_id' => $supplier->id,
            'total_quantity' => $request->total_quantity,
        ]);

        //store to product_order
        $p = Product::find($product->id);
        $p->color()->sync($colors);

        return redirect()->back()->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $category = Category::all();
        $supplier = Supplier::all();
        $brand = Brand::all();
        $color = Color::all();

        $product = Product::where('slug', $id)
            ->with('supplier', 'brand', 'category', 'color')
            ->first();

        // return ($product);

        return view('admin.product.edit', compact('category', 'supplier', 'brand', 'color', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $updateProduct = Product::where('slug', $id);

        // dd($request->file('image')); 

        if (!$updateProduct->first()) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $product_id = $updateProduct->first()->id;

        if ($file = $request->file('image')) {

            $file_name = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('/images'), $file_name);
            File::delete(public_path('/images'), $updateProduct->first()->image);
        } else {

            $file_name = $updateProduct->first()->image;
        }

        //update

        $category = Category::where('slug', $request->category_slug)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found!');
        }

        $supplier = Supplier::where('id', $request->supplier_slug)->first();
        if (!$supplier) {
            return redirect()->back()->with('error', 'Supplier not found!');
        }

        $brand = Brand::where('slug', $request->brand_slug)->first();
        if (!$brand) {
            return redirect()->back()->with('error', 'Brand not found!');
        }

        $colors = [];
        foreach ($request->color_slug as $col) {
            $color = Color::where('slug', $col)->first();
            if (!$color) {
                return redirect()->back()->with('error', 'Color not found!');
            }

            $colors[] = $color->id;
        }

        // product store
        $slug = uniqid() . Str::slug($request->name);
        $updateProduct->update([
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
            'brand_id' => $brand->id,
            'slug' =>  $slug,
            'name' => $request->name,
            'image' => $file_name,
            'discount_price' => $request->discount_price,
            'buy_price' => $request->buy_price,
            'sale_price' => $request->sale_price,
            'total_quantity' => $request->total_quantity,
            'view_count' => 0,
            'like_count' => 0,
            'description' => $request->description,
        ]);


        // color
        $product = Product::find($product_id);
        $product->color()->sync($colors);

        return redirect()->route('product.edit', $slug)->with('success', 'Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $color = Color::all();

        $p = Product::where('slug', $id)->first();

        if (!$p) {
            return redirect()->back()->with('error', 'Product not found');
        }

        File::delete(public_path('/images/' . $p->image));

        Product::find($p->id)->color()->sync([]);

        $p->delete();
        return redirect()->back()->with('success', 'Product deleted');
    }


    // create product add
    public function createProductAdd($slug)
    {
        $supplier = Supplier::all();
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        return view('admin.product.create-product-add', compact('product', 'supplier'));
    }


    // store product add
    public function storeProductAdd(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        //store transaction
        ProductAddTransaction::create([
            'product_id' => $product->id,
            'supplier_id' => $request->supplier_slug,
            'total_quantity' => $request->total_quantity,
            'description' => $request->description,
        ]);

        // update 
        $product->update([
            'total_quantity' => DB::raw('total_quantity+ ' . $request->total_quantity),
        ]);

        return redirect()->back()->with('success', $request->total_quantity . ' added');
    }

    // create product reduce
    public function createProductReduce($slug)
    {
        $supplier = Supplier::all();
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        return view('admin.product.create-product-reduce', compact('product', 'supplier'));
    }


    // store product reduce
    public function storeProductReduce(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        //store transaction
        ProductAddTransaction::create([
            'product_id' => $product->id,
            'supplier_id' => $request->supplier_slug,
            'total_quantity' => $request->total_quantity,
            'description' => $request->description,
        ]);

        // update 
        $product->update([
            'total_quantity' => DB::raw('total_quantity- ' . $request->total_quantity),
        ]);

        return redirect()->back()->with('success', $request->total_quantity . 'reduced');
    }


    // trend / not_trend 
    public function trend(Request $request)
    {
        // return $request->all();
        $trend_data = Product::where('id', $request->id)->first();

        $trend_data->update([
            'trend' => $request->trend,
        ]);

        return back()->with('success', 'Changed to ' . $request->trend);
    }


    // transaction page
    public function productTransaction()
    {
        $transactions = ProductAddTransaction::with('product')->paginate(5);
        // return $transactions;
        return view('admin.product.transaction', compact('transactions'));
    }



    private function validation($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
            'description' => 'required|string',
            'total_quantity' => 'required|integer',
            'buy_price' => 'required|integer',
            'sale_price' => 'required|integer',
            'supplier_slug' => 'required|string',
            'category_slug' => 'required|string',
            'brand_slug' => 'required|string',
            'color_slug.*' => 'required|string',
        ]);
    }
}
