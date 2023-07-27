@extends('template.base')
<link rel="stylesheet" href="{{ asset('CSS/create.css') }}" />
@section('content')
    <div class="store-page container-xxl">

        <div class="page">

            <div class="store-left">
                <div class="categoriestore">
                    <div class="block-title">
                        <strong>GAMING</strong>
                    </div>
                    <div class="category">
                        <ul class="list-group">
                            <a href="/shop ">
                                <li class="list-group-item ">All
                                </li>
                            </a>
                            @if ($categories->count() == 0)
                                <div class="no-display" style="height:300px;">
                                    No Categories Display
                                </div>
                            @endif
                            @foreach ($categories as $category)
                            <a href="{{ route('shop.category',['slug_category'=> $category->slug_category]) }}">
                                    <li class="list-group-item ">{{ $category->category_name }}</li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>


            @guest
                <div class="store-right">

                    <div class="store">
                        @if ($products->count() == 0)
                            <div class="no-display" style="height:300px;">
                                No Product Display
                            </div>
                        @endif
                        @foreach ($products as $product)
                            <div class="card">

                                <a href="{{ route('product',  $product->slug) }}" class="shop">
                                    <div class="card-header">
                                        <img src="{{ asset('/storage/storage/product/' . $product->image) }}" alt="rover" />
                                    </div>
                                </a>
                                <div class="card-body">
                                    @if ($product->category->category_name == 'Headphone')
                                        <a href="/shop/{{ $product->category->slug_category}}"
                                            class="tag tag-teal h--ffc16f">{{ $product->category->category_name }}</a>
                                    @elseif($product->category->category_name)
                                        <a href="/shop/{{ $product->category->slug_category }}"
                                            class="tag tag-teal">{{ $product->category->category_name }}</a>
                                    @endif
                                    <a href="{{ route('product',  $product->slug) }}">
                                        <h4>
                                            {{ $product->name }}
                                        </h4>
                                    </a>
                                    <span>
                                        Rp.{{ number_format($product->price, 0, '.', '.') }},00
                                    </span>
                                    <div class="user">
                                        <div class="user-info">

                                                    <form action="/cart/store" method="POST">
                                                        @csrf
                                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                        <button type="submit" class="button" value="">Add To Cart <i
                                                                class="fa fa-cart-plus" aria-hidden="true"></i></button>
                                                                {{-- <input type="submit" class="button "  value="Add To Cart"> --}}
                                                    </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pagi d-flex mt-5 justify-content-end">
                        {{ $products->onEachSide(0)->links() }}
                    </div>

                </div>
            @else
                @can('isUser')
                    <div class="store-right">

                        <div class="store">
                            @if ($products->count() == 0)
                                <div class="no-display" style="height:300px;">
                                    No Product Display
                                </div>
                            @endif
                            @foreach ($products as $product)
                                <div class="card">

                                    <a href="{{ route('product',  $product->slug) }}" class="shop">
                                        <div class="card-header">
                                            <img src="{{ asset('/storage/storage/product/' . $product->image) }}" alt="rover" />
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        @if ($product->category->category_name == 'Headphone')
                                            <a href="/shop/{{ $product->category->category_name }}"
                                                class="tag tag-teal h--ffc16f">{{ $product->category->category_name }}</a>
                                        @elseif($product->category->category_name)
                                            <a href="/shop/{{ $product->category->category_name }}"
                                                class="tag tag-teal">{{ $product->category->category_name }}</a>
                                        @endif
                                        <a href="{{ route('product',  $product->slug) }}">
                                            <h4>
                                                {{ $product->name }}
                                            </h4>
                                        </a>
                                        <span>
                                            Rp.{{ number_format($product->price, 0, '.', '.') }},00
                                        </span>
                                        <div class="user">
                                            <div class="user-info">
                                                <form action="/cart/store" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                    <button type="submit" class="button" value="">Add To Cart <i
                                                            class="fa fa-cart-plus" aria-hidden="true"></i></button>
                                                            {{-- <input type="submit" class="button "  value="Add To Cart"> --}}
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="pagi d-flex mt-5 justify-content-end">
                            {{ $products->onEachSide(0)->links() }}
                        </div>

                    </div>
                @elsecan('isAdmin')
                    <div class="store-right">


                        <div class="bar admin">

                            @if ($message = Session::get('tambah'))
                                <div class="alert alert-success" role="alert">
                                    <i class="fa fa-check" aria-hidden="true"></i><span>
                                        {{ $message }}
                                    </span>
                                </div>
                            @endif
                            @if ($message = Session::get('ubah'))
                                <div class="alert alert-info" role="alert">
                                    <i class="fa fa-check" aria-hidden="true"></i><span>
                                        {{ $message }}
                                    </span>
                                </div>
                            @endif
                            @if ($message = Session::get('delete'))
                                <div class="alert alert-danger" role="alert">
                                    <i class="fa fa-check" aria-hidden="true"></i><span>
                                        {{ $message }}
                                    </span>
                                </div>
                            @endif
                            @if ($message = Session::get('waduh'))
                                <div class="alert alert-danger" role="alert">
                                    <i class="fa fa-check" aria-hidden="true"></i><span>
                                        {{ $message }}
                                    </span>
                                </div>
                            @endif
                            <div class="dont">
                                <form action="/shop/delete" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#modal-category">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                                @include('shop.createcategory')
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>

                                <!-- Modal -->
                              @include('shop.create')



                            </div>
                        </div>
                        <div class="store">
                            @if ($products->count() == 0)
                                <div class="no-display" style="height:300px;">
                                    No Product Display

                                </div>
                            @endif
                            @foreach ($products as $product)
                                <div class="card">

                                    <a href="{{ route('product',  $product->slug) }}" class="shop">
                                        <div class="card-header">

                                            <input type="checkbox" name="ids[{{ $product->id }}]" id="" class="checkBoxClass"
                                                value="{{ $product->id }}">
                                            <img src="{{ asset('/storage/storage/product/' . $product->image) }}"
                                                alt="rover" />
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        @if ($product->category->category_name == 'Headphone')
                                            <a href="/shop/{{ $product->category->category_name }}"
                                                class="tag tag-teal h--ffc16f">{{ $product->category->category_name }}</a>
                                        @elseif($product->category->category_name)
                                            <a href="/shop/{{ $product->category->category_name }}"
                                                class="tag tag-teal">{{ $product->category->category_name }}</a>
                                        @endif
                                        <a href="{{ route('product',  $product->slug) }}">
                                            <h4>
                                                {{ $product->name }}
                                            </h4>
                                        </a>
                                        <span>
                                            Rp.{{ number_format($product->price, 0, '.', '.') }},00
                                        </span>
                                        <div class="user">
                                            <div class="user-info">
                                                <a class="button admin" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#ModalEdit{{ $product->id }}"><i class="fa fa-pencil"
                                                        aria-hidden="true"></i></a>
                                                    @include('shop.edit')

                                                {{-- <a class="button" href="{{ route('edit', ['id' => $product->id]) }}"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i></a> --}}
                                                    <form action="/shop/{{ $product->id }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="button admin" type="submit" value="Delete" onclick="return confirm('Are You Sure Want To Delete?')"><i class="fa fa-trash"
                                                                aria-hidden="true"></i></button>
                                                    </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        <div class="pagi d-flex mt-5 justify-content-end">
                            {{ $products->onEachSide(0)->links() }}
                        </div>

                    </div>
                @endcan
            @endguest
        </div>
    </div>


    <script type="text/javascript">
        function sort(value) {
            object.assign(query, {
                'sortByCreated_at': value
            });

            window.location.href = "{{ route('store') }}?" + $.param(query);
        }
    </script>
    <script>
        $(function(e) {
            $("#chkCheckAll").click(function() {
                $(".checkBoxClass").prop('checked', $(this).prop('checked'));
            })
        });
    </script>
@endsection
