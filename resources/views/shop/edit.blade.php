<div class="modal mt-5 fade" id="ModalEdit{{ $product->id }}" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Produk
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="container">
                    <form action="/update/{{ $product->id }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-create">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>ID Produk</label>
                                        <input type="text" name="product_id"
                                            unique
                                            class="@error('product_id') is-invalid @enderror" value="{{ $product->product_id }}">
                                        @error('product_id')
                                            <div class="invalid-feedback"
                                                role="alert">
                                                @if ($errors->has('product_id'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('product_id') }}</span>
                                                @endif
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Nama Produk</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror" value="{{ $product->name }}" id="name">
                                        @error('name')
                                            <div class="invalid-feedback"
                                                role="alert">
                                                @if ($errors->has('name'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Slug</label>
                                        <input type="text" name="slug"
                                            class="form-control @error('slug') is-invalid @enderror" value="{{ $product->slug }}" id="slug">
                                        @error('slug')
                                            <div class="invalid-feedback"
                                                role="alert">
                                                @if ($errors->has('slug'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('slug') }}</span>
                                                @endif
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Kategori</label>

                                        <select name="category_id"
                                            class="form-control @error('category_id') is-invalid @enderror"
                                            id="category">

                                        @foreach ($categories as $category)

                                        <option
                                            value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                        @endforeach

                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback"
                                                role="alert">
                                                @if ($errors->has('category_id'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('category_id') }}</span>
                                                @endif
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group" id="price">
                                        <label>Harga</label>
                                        <input type="number"
                                            class="@error('price') is-invalid @enderror"
                                            name="price" numeric value="{{ $product->price }}">
                                        @error('price')
                                            <div class="invalid-feedback"
                                                role="alert">
                                                @if ($errors->has('price'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('price') }}</span>
                                                @endif
                                            </div>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col">
                                    <div class="form-group">
                                        <label>Kuantitas</label>
                                        <input type="number" name="quantity" numeric value="{{ $product->quantity }}">
                                        @error('quantity')
                                            <div class="invalid-feedback"
                                                role="alert">
                                                @if ($errors->has('quantity'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('quantity') }}</span>
                                                @endif
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="image"
                                            id="gambar">Gambar</label>
                                            <div class="col-sm-2">
                                                <img src="/storage/storage/product/{{ $product->image }}" class="img-thumbnail img-preview">
                                              </div>
                                        <input type="file" name="image" class="@error('image') is-invalid @enderror"
                                            id="image" value="{{ $product->image}}">
                                        @error('image')
                                            <div class="invalid-feedback"
                                                role="alert">
                                                @if ($errors->has('image'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('image') }}</span>
                                                @endif
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea type="text" id="desc" name="description" resize=false>{{ $product->description }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback"
                                                role="alert">
                                                @if ($errors->has('description'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('description') }}</span>
                                                @endif
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <input type="submit" value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

<script>
    $('#name').change(function(e) {
       $.get('{{ route('shop.getSlug') }}',
       { 'name':$(this).val() },
       function( data ) {
           $('#slug').val(data.slug);
       }
       );
    });
</script>



