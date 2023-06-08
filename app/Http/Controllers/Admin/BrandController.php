<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $brand = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $data = $request->all();
        $validator = $this->validation($request);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('image');
        $file_name = uniqid() . $file->getClientOriginalName();
        $file->move(public_path('/images'), $file_name);

        Brand::create([
            'slug' => Str::slug($request->name) . uniqid(),
            'name' => $request->name,
            'image' => $file_name,
        ]);

        return redirect()->back()->with('success', 'Brand Created');
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
        $brand = Brand::where('slug', $id)->first();
        if (!$brand) {
            return redirect()->back()->with('error', 'Brand Not Found');
        }

        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // $validator = $this->validation($request);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $brand = Brand::where('slug', $id)->first();
        // dd($brand);

        $file = $request->file('image');
        if ($file) {
            $file_name = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('/images'), $file_name);

            File::delete(public_path('/images'), $brand->image);
        } else {
            $file_name = $brand->image;
        }

        $slug = Str::slug($request->name) . uniqid();

        Brand::where('slug', $id)->update([
            'slug' => $slug,
            'name' => $request->name,
            'image' => $file_name,
        ]);

        return redirect()->route('brand.edit', $slug)->with('success', 'Brand Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function validation($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
        ]);
    }
}
