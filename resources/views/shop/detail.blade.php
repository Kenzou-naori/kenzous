@extends('template.base')
<link rel="stylesheet" href="{{ asset('CSS/detail.css') }}">
@section('content')

<section id="detail">



  <div class="detail">
   <div class="left">
    <div class="product-name">
    <h2>{{ $products->name }} <br> <span>{{ $products->category->category_name }}</span> </h2>
    </div>
    <div class="product-price">
       <span>Rp. {{ number_format($products->price, 0, '.', '.') }},00</span>
    </div>

    <div class="button-redirect">
        <div class="cart-redirect">
            <form action="/cart/store" method="POST">
                @csrf
                <input type="hidden" value="{{ $products->id }}" name="product_id">
                <button type="submit" class="button btn btn-cart" value=""><i
                        class="fa fa-cart-plus" aria-hidden="true"></i>Add To Cart</button>

                        {{-- <input type="submit" class="btn btn-cart"  value="Add To Cart"> --}}
            </form>
            {{-- <a href="#" class="btn btn-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add To Cart</a> --}}
        </div>
        <div class="buy-redirect">
            <a href="#" class="btn btn-buy"> <i class="fa fa-buysellads" aria-hidden="true"></i> Beli Langsung</a>
        </div>
    </div>
   </div>
   <div class="middle">
    <div class="product-photo">
        <img src="{{ asset('/storage/storage/product/' . $products->image) }}" alt="">
    </div>

   </div>
   <div class="right">
    <div class="description">
        <span>{{ $products->description }}</span>
    </div>
   </div>
  </div>
   </section>



@endsection
