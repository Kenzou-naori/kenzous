<div class="modal mt-5 fade" id="modal-category" tabindex="-1"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Category</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="container">
                <form action="/shop/insertcategory" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-create">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Nama Category</label>
                                    <input type="text" name="category_name"
                                        class="form-control @error('category_name') is-invalid @enderror" {{ old('category_name') }} id="category_name">
                                    @error('category_name')
                                        <div class="invalid-feedback" role="alert">
                                            @if ($errors->has('category_name'))
                                                <span
                                                    class="text-danger">{{ $errors->first('category_name') }}</span>
                                            @endif
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input type="text" name="slug_category"
                                        class="form-control @error('slug_category') is-invalid @enderror" {{ old('slug_category') }} id="kategori">
                                    @error('slug_category')
                                        <div class="invalid-feedback" role="alert">
                                            @if ($errors->has('slug_category'))
                                                <span
                                                    class="text-danger">{{ $errors->first('slug_category') }}</span>
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
    $('#category_name').change(function(e) {
       $.get('{{ route('shop.cekSlug') }}',
       { 'category_name':$(this).val() },
       function( data ) {
           $('#kategori').val(data.slug);
       }
       );
    });
</script>
