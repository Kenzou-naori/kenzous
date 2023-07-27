<?php

namespace App\Http\Controllers;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category(Request $request, $slug)
    {

        $categories = Category::where('slug', $slug)->first();
        $products = Product::where('category_id', $categories->id)->orderBy('products.created_at', 'DESC')->paginate(16);
        return view('shop.index', compact('products', 'categories', 'slug'));

// $categories = Category::where('slug', $slug)->first();
// $products = Product::where('category_id', $categories->id)->where('status','0')->get();
// return view('shop.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function insertcategory(Request $request)
    {
        $messages = [
            'category_name.required' => 'Nama Category harus di isi. Serius!~',
            'category_name.unique' => 'Nama Category harus beda. Serius!~',
            'slug_category.required' => 'Slug harus di isi. Serius!~',
        ];
        $request->validate(
            [
                'category_name' => "required|unique:categories",
                'slug_category' => "required",



            ],
            $messages
        );
        $request->validate([
            'category_name' => "required|unique:categories",
            'slug_category' => "required",


        ]);
        // dd($request->all());
        Category::create($request->all());
        return redirect()->route('shop')->with('tambah', "Berhasil di tambahkan");
    }
    public function cekSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug_category', $request->category_name);

        return response()->json(['slug' => $slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
