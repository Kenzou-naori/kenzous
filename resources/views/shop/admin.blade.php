@extends('template.base')

@section('content')
    <div class="store-page">

        <div class="page">

            <div class="store-left">
                <div class="categoriestore">
                    <div class="category">
                        <h2 id="category-label">Categories</h2>
                        <ul class="list-group">
                        <li class="list-group-item active "><a href="/store ">All</a> </li>
                            @foreach ($categories as $category)
                            <li class="list-group-item {{ $category->id == $id ? 'active' : '' }}"><a href="/store/category/{{ $category->name }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>


            <div class="store-right">
                <div class="store">

                    @foreach ($products as $product)
                        <div class="card">

                            <div class="card-header">
                                <img src="{{ $product->image }}"
                                    alt="rover" />
                            </div>
                            <div class="card-body">
                                <a href="/store/category/{{ $category->name }}" class="tag tag-teal">{{ $category->name }}</a>
                                <h4>
                                    {{ $product->name}}
                                </h4>
                                <p>
                                    Rp.{{ number_format($product->price, 0, '.', '.') }},-
                                </p>
                                <div class="user">
                                    <div class="user-info">
                                        <form action="/cart/{id}" method="POST">
                                            @csrf
                                            <input type="hidden" value="" name="product_id">
                                            <button type="submit" class="button" value="">Add To Cart <i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
                <div class="d-flex mt-5 justify-content-end">
                    {{ $products->links() }}
                </div>

            </div>
        </div>
    @endsection
