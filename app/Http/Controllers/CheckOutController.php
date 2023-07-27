<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Cart;
use App\Models\Province;
use App\Models\City;
use App\Models\Courier;
use App\Models\Product;
use App\Models\Transaction;
use Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Resources\OngkosKirim;

class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        // $carts = Cart::get();
        // $couriers = Courier::pluck('title', 'code');
        // $provinces = Province::pluck('title', 'province_id');
        // return view('shop.checkout', compact('carts', 'couriers', 'provinces'));
        //  dd($request->all());
        if ($request->destination && $request->weight) {
            // $origin = 79;
            $destination = $request->destination;
            $weight = $request->weight;

            $response = Http::asForm()->withHeaders([
                'key' => 'b4dff0ffc700fd9d30077f0ef237a894'
            ])->post('https://api.rajaongkir.com/starter/cost', [
                    'origin' => 78,
                    'destination' => $destination,
                    'weight' => $weight,
                    'courier' => 'jne',
                ]);
            $cekongkir = $response['rajaongkir']['results'][0]['costs'];
            //  $cekongkir->first('service', 'OKE');

        } else {
            $origin = '';
            $destination = '';
            $weight = '';
            $courier = '';
            $cekongkir = null;
        }

        // dd($response['rajaongkir']);



        // $origin = 501 ;
        // $destination = 114;
        // $weight = 1700;
        // $courier = "jne";



        // $provinces = Province::all();


        //midtrans section

        // $request->request->add(['total_price' => $request->qty * 10000, 'status' => 'Unpaid']);
// $checkout =Checkout::create($request->all());
        $checkout = CheckOut::where('status', 'Belum Bayar')->whereHas('transaction', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })
            ->with('product')
            ->get();
        $total = 0;
        foreach ($checkout as $o) {
            $total += ($o->product->price * $o->total_qty);
        }
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-LbEfRH4sR0hjSzah2zAtNNew';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;


        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'last_name' => '',
                'email' => Auth::user()->email,
                'phone' => Auth::user()->no_telp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);


        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $couriers = Courier::pluck('title', 'code');
        $provinces = Province::pluck('title', 'province_id');
        return view('shop.checkout', compact('snapToken', 'checkout', 'provinces', 'carts', 'cekongkir', 'couriers', 'provinces'));
    }
    public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('title', 'city_id');
        return response()->json($city);
    }



    public function checkout(Request $request, Cart $carts)
    {
        $cartUser = Cart::select('carts.*')
            ->join('users', 'users.id', '=', 'carts.user_id')
            ->where('users.id', Auth::user()->id)
            ->get();

        if ($cartUser->isEmpty()) {
            return redirect('/cart')->with('error', 'Keranjang Anda kosong. Silakan tambahkan produk terlebih dahulu.');
        }

        foreach ($cartUser as $cart) {
            if ($cart->product->quantity <= 0) {
                return redirect('/cart')->with('error', 'Silahkan hapus terlebih dahulu produk yang telah sold out!');
            }
        }

        $transaction = Transaction::create([
            'user_id' => Auth::user()->id
        ]);

        foreach ($cartUser as $cart) {
            $transaction->detail()->create([
                'product_id' => $cart->product_id,
                'total_qty' => $cart->qty,
                // 'size_id' => $cart->size_id
            ]);
        }

        Cart::where('user_id', Auth::user()->id)->delete();

        return redirect('/checkout');


    }


    public function callback(Request $request)
    {
        $serverKey = 'SB-Mid-server-LbEfRH4sR0hjSzah2zAtNNew';
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {
                $checkout = Checkout::where('id', '>=' ,1)->get();

                foreach($checkout as $o )
                {
                if($o && $o->status == 'Sudah Bayar'){
                continue;
                }
                $checkout->update(['status' => 'Sudah Bayar']);
                $product = Product::find($checkout->product_id);
                $product->stock -= $checkout->qty;
                $product->save();
                }
            }
        }
    }


    // public function submit(Request $request)
//     {

    //         // dd($request->all());
//         if($request->origin && $request->destination && $request->weight && $request->courier){
//             $origin = $request->origin;
//             $destination = $request->destination;
//             $weight = $request->weight;
//             $courier = $request->courier;
//         } else {
//             $origin = '';
//             $destination = '';
//             $weight = '';
//             $courier = '';
//         }





    //         // $origin = 501 ;
//         // $destination = 114;
//         // $weight = 1700;
//         // $courier = "jne";


    //         $response = Http::asForm()->withHeaders([
//             'key' => '1c89905e2850c0597e039950ed51e72c'
//         ])->post('https://api.rajaongkir.com/starter/cost', [
//             'origin'        =>  $origin,
//             'destination'   =>  $destination,
//             'weight'        =>  $weight,
//             'courier'       =>  $courier,
//         ]);
// $cekongkir = $response['rajaongkir']['results'][0]['cost'];
// // $provinces = Province::all();
// // $carts = Cart::get();
// $couriers = Courier::pluck('title', 'code');
// $provinces = Province::pluck('title', 'province_id');
// return view('shop.checkout', compact('provinces', 'cekongkir', 'couriers', 'provinces'));       // // // $cost = RajaOngkir::OngkosKirim([

    //         // // ])->get();

    //         // dd($cost[0]['cost'][2]['cost']['value']);
//     }

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
        // Process payment and store order in database
        // ...

        // Checkout::create([
        //     'user_id'=> Auth::user()->id,
        //     'product_id'=> $request->product_id,
        //     'qty'=> $request->qty
        // ]);
        $carts = Cart::where('user_id', Auth::user()->id);
        $cartUser = $carts->get();
        $transaction = Transaction::create(
            [
                'user_id' => Auth::user()->id
            ]
        );

        foreach ($cartUser as $cart) {
            $transaction->detail()->create(
                [
                    'product_id' => $cart->product_id,
                    'total_qty' => $cart->qty,
                ]
            );

            Cart::where('user_id', Auth::user()->id)->delete();
            return redirect('/checkout')->with('success', 'Barang berhasil di tambahkan');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
