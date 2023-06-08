<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $category = Category::latest()->paginate(5);
        // dd($category);
        // return $category;
        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = $this->validation($request);



        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $image = $request->file('image');
        $image_name = uniqid() . ($image->getClientOriginalName());
        $image->move(public_path('/images'), $image_name);

        Category::create([
            'slug' => Str::slug($request->name) . uniqid(),
            'name' => $request->name,
            'mm_name' => $request->mm_name,
            'image' => $image_name,
        ]);

        return redirect()->back()->with('success', 'Category Created Successfully');
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
        $category = Category::where('slug', $id)->first();


        if (!$category) {
            return redirect()->back()->with('error', 'Category Not Found!');
        }

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        // dd($request->image);
        $category = Category::where('slug', $id)->first();

        if (!$category) {
            return redirect()->back()->with('error', 'Category Not Found!');
        }

        if ($file = $request->file('image')) {

            $file_name = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('/images'), $file_name);
        } else {

            $file_name = $category->image;
        }

        $slug = Str::slug($request->name) . uniqid();

        Category::where('slug', $id)->update([
            'slug' => $slug,
            'name' => $request->name,
            'mm_name' => $request->mm_name,
            'image' => $file_name,
        ]);

        return redirect()->route('category.edit', $slug)->with('success', 'Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::where('slug', $id)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Category Not Found!');
        }
        $category->delete();
        return redirect()->back()->with('success', 'Category Deleted!');
    }


    private function validation($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required',
            'mm_name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
        ]);
    }
}
