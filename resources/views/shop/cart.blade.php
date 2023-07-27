@extends('template.base')

<link rel="stylesheet" href="{{ asset('CSS/cart.css') }}">
@section('content')
    <section>

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

        @php
            $total = 0;
        @endphp
        <div class="wrap cf">
            <div class="heading cf">
                <h1>{{ Auth::user()->name }} Cart</h1>
            </div>
            <div class="cart">
                <!--    <ul class="tableHead">
                    <li class="prodHeader">Product</li>
                    <li>Quantity</li>
                    <li>Total</li>
                     <li>Remove</li>
                  </ul>-->
                <ul class="cartWrap">@can ('










                ', Model::class)

                @endcan




                @if ($carts->count() == 0)
                        Anda tidak memiliki barang di keranjang belanja Anda.
                    @endif
                    @foreach ($carts as $cart)
                        <li class="items odd">

                            <div class="infoWrap">
                                <div class="cartSection">
                                    <img src=" {{ asset('/storage/storage/product/' . $cart->product->image) }}"
                                        alt="" class="itemImg" />
                                    <p class="itemNumber">{{ $cart->product->category->category_name }}</p>
                                    <h3>{{ $cart->product->name }}</h3>
                                    @if ($cart->product->quantity > $cart->qty)
                                        <p>

                                            <input name="qty" class="quantity" data-item="{{ $cart->id }}"
                                                value="{{ $cart->qty }}">
                                            {{-- <option value="{{ $i }}"{{ $cart->qty == $i ? 'selected' : '' }}>
                                            {{ $i }}</option> --}}

                                            {{-- </select> --}}
                                            Rp.{{ number_format($cart->product->price) }},00
                                        </p>

                                        <p class="stockStatus"> In Stock</p>



                                        @php
                                            $total += $cart->product->price * $cart->qty;
                                        @endphp
                                    @else
                                        <p class="stockStatus out"> Out Of Stock</p>
                                    @endif
                                </div>


                                <div class="prodTotal cartSection">
                                    <p>Rp. {{ number_format($cart->product->price * $cart->qty) }},00</p>
                                </div>
                                <div class="cartSection removeWrap">
                                    <a href="{{ url('/delete/cart/' . $cart->id) }}" class="remove">x</a>
                                </div>
                            </div>
                        </li>
                    @endforeach




                    <!--<li class="items even">Item 2</li>-->

                </ul>
            </div>



            <div class="subtotal cf">
                <ul>


                    {{-- <li class="totalRow"><span class="label">Subtotal</span><span class="value">Rp.{{number_format( $total)  }},00</span></li> --}}

                    {{-- <li class="totalRow"><span class="label">Shipping</span><span class="value">$5.00</span></li>

                  <li class="totalRow"><span class="label">Tax</span><span class="value">$4.00</span></li> --}}
                    <li class="totalRow final"><span class="label">Total</span><span
                            class="value">Rp.{{ number_format($total) }},00</span></li>
                            @if ($carts->count() == 0)
                            <form action="{{ route('cart') }}" method="GET" id="checkout">
                                @csrf
                                <li class="totalRow"><button type="submit" class="btn continue">Checkout</button></li>
                            </form>

                            @else

                            <form action="{{ route('checkout.store') }}" method="POST">
                                @csrf
                                <li class="totalRow"><button type="submit" class="btn continue">Checkout</button></li>
                            </form>
                            @endif
                </ul>
            </div>
        </div>
{{--
        @csrf
        <button type="submit" class="btn btn-primary mt-4 mb-5">Checkout</button> --}}

        {{-- @endif --}}
    </section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>

    <script type="text/javascript">
        (function() {
            const classname = document.querySelectorAll('.quantity');

            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function() {
                    const id = element.getAttribute('data-item');
                    axios.patch(`/cart/${id}`, {
                            quantity: this.value,
                            id: id
                        })
                        .then(function(response) {
                            //console.log(response);
                            window.location.href = '/cart'
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                })
            })
        })();
    </script>
@endsection
