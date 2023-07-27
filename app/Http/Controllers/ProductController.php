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

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * nse
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request, $id = null)
    {
        $categories = Category::all();
        // $search = $request->input('search');
        $products = Product::where('name', 'like', '%' . $request->search . '%')->with('category')->orderBy('products.created_at', 'DESC')->paginate(16);
        return view('shop.index', compact('products', 'categories', 'id'));
    }
    public function category(Request $request, $id)
    {
        $categories = Category::all();
        $products = Product::join('categories', 'products.category_id', '=','categories.id' )->where('categories.slug_category', $id)->orderBy('products.created_at', 'DESC')->paginate(16);
        // $products = Product::where('category_id',$id)->paginate(15);
        // $categories = Category::where('slug', $slug)->first();
        // $products = Product::where('category_id', $categories->id)->where('status', '0')->get();
        return view('shop.index', compact('products', 'categories'));

    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        $categories = Category::all();
        return view('shop.insert', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function insertdata(Request $request)
    {
        $messages = [
            'product_id.unique' => 'ID Product harus Berbeda. Serius!~',
            'product_id.required' => 'ID Product harus di isi. Serius!~',
            'name.required' => 'Nama Produk harus di isi. Serius!~',
            'price.required' => 'Harga harus di isi. Serius!~',
            'quantity.required' => 'Kuantitas harus di isi. Serius!~',
            'category_id.required' => 'Kategori harus di isi. Serius!~',
            'image.required' => 'Gambar Produk harus di isi. Serius!~',
            'description.required' => 'Deskripsi harus di isi. Serius!~',
        ];
        $request->validate(
            [
                'product_id' => "required|unique:products",
                'name' => "required|min:3|max:100",
                'slug' => "required|min:3|max:255|unique:products",
                'price' => "required",
                'quantity' => "required",
                'category_id' => "required",
                'description' => "required",
            ],
            $messages
        );
        $input = $request->all();

        if ($request->file('image')) {
            $destinationPath = 'public/storage/product/';
            $image = $request->file('image');
            $image_name = date('mdYHis') . $image->getClientOriginalExtension();
            $path = $request->file('image')->storeAs($destinationPath, $image_name);
            $input['image'] = $image_name;
        }

        Product::create($input);


        return redirect()->route('shop')->with('tambah', "Berhasil di tambahkan");
    }

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
            'slug_category' => "required"  ,


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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, $slug)
    {

        $products = Product::where('slug', $slug)->firstOrFail();
        // $products = Product::find($id);
        return view('shop.detail', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Product $product)
    {
        $messages = [
            // 'product_id.unique' => 'ID Product harus Berbeda. Serius!~',
            'product_id.required' => 'ID Product harus di isi. Serius!~',
            'name.required' => 'Nama Produk harus di isi. Serius!~',
            'price.required' => 'Harga harus di isi. Serius!~',
            'category_id.required' => 'Kategori harus di isi. Serius!~',
            'image.required' => 'Gambar Produk harus di isi. Serius!~',
            'description.required' => 'Deskripsi harus di isi. Serius!~',
        ];
        $request->validate(
            [
                'product_id' => "required",
                'name' => "required",
                'price' => "required",
                'category_id' => "required",
                'image' => "required",
                'description' => "required",


            ],
            $messages
        );
        $request->validate([
            'product_id' => "required",
            'name' => "required",
            'price' => "required",
            'category_id' => "required",
            'image' => "required",
            'description' => "required",


        ]);

        $ubah = Product::findorfail($id);
        $slug = Str::slug($request->title, '-');
        $awal = $ubah->image;

        $dt = [
            'product_id' => $request['product_id'],
            'name' => $request['name'],
            'price' => $request['price'],
            'category_id' => $request['category_id'],
            'image' => $awal,
            'description' => $request['description'],
        ];

        $request->image->storeAs('public/storage/product', $awal);
        // $ubah->update($request->all());
        // dd($ubah);

        $ubah->update($dt);
        return redirect('shop')->with('ubah', "Data Sudah di Ubah");

        // $data = Product::find($id);

        //     $product = Product::find($id);
//     $product->product_id = $request->input('product_id');
//     $product->name = $request->input('name');
//     $product->category_id = $request->input('category_id');
//     $product->quantity = $request->input('quantity');
//     $product->price = $request->input('price');
// $product->description = $request->input('description');

        // if ($request
// ->hasFile('image')) {
//     $destination = 'public/storage/product/'. $product->image;
//     if (File::exists($destination)) {
//         File::delete($destination);
//     }
//     $file = $request->file('image');
//     $extension = $file->getClientOriginalExtension();
//     $filename = time().'.'.$extension;
//     $file->move('public/storage/product/', $filename);
//     $product->image = $filename;
//     }
//     $product->save();


        // $input = $request->all();

        // if ( $request->file('image')) {
//     $destinationPath = 'public/storage/product/';
// $image =$request->file('image');
// $image_name =$image->getClientOriginalName();
// $path = $request->file('image')->move($destinationPath,$image_name);
//     // $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
//     // $image->move($destinationPath, $profileImage);
//     $input['image'] = $image_name;
// }

        // $product->update($input);
        return redirect('shop')->with('error', "Anda tidak dapat mengakses halaman ini");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function getSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);
    }
    public function destroy(Product $product, Request $request, $id)
    {
        // $product = product::findOrfail($id);
        // $product->update(['deleted' => true]);
        // $product->was_name = $product->name;
        // $product->name = '[DELETED]';
        // $product->save();

        $product = Product::find($id);
        $product->delete();
        return redirect('/shop')->with('delete', 'Product has been delete');
    }
}
