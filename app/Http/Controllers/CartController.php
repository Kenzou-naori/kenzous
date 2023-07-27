<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function __construct()
        {
            $this->middleware('auth');
        }
    public function index()
    {
        // $old_cartitems = Cart::where('user_id',Auth::user()->id)->get();
        // foreach($old_cartitems as $item)
        // {
        //     if(!Product::where('id', $item->product_id)->where('quantity','>=', $item->qty)->exists());
        //     {
        //         $removeitem = Cart::where('user_id', Auth::user()->id)->where('product_id', $item->product_id)->first();
        //         $removeitem->delete();

        //     }
        // }

        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('shop.cart', compact('carts'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $duplicate = Cart::where('product_id', $request->product_id)->first();

        if($duplicate){
            return redirect('/cart')->with('error', 'Barang sudah ada di keranjang anda');
        }

        Cart::create([
            'user_id'=> Auth::user()->id,
            'product_id'=> $request->product_id,
            'qty'=> 1
        ]);

        return redirect('/cart')->with('success', 'Barang berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show( Request $request,Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart, $id)
    {
        Cart::where('id', $id) ->update([
            'qty' => $request->quantity
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart, $id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
}
