@extends('template.base')
<link rel="stylesheet" href="{{ asset('CSS/checkout.css') }}">

@section('content')
<section>

<div class="container" id="checkout">

    <div class="check-left">
        <div class="check-left-inner">
            <div class="check title">
                <h3>CheckOut</h3>
            </div>

            <div>Nama Penerima : {{ Auth::user()->name }}</div>
            <div>Alamat Penerima : {{ Auth::user()->address }}</div>
<form action="{{ route('checkout') }}" role="form" method="GET">
    @csrf
    {{-- <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nama</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" >
      </div> --}}
      {{-- <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nama</label>
        <input name="name" id="name" class="form-control" value="{{ Auth::user()->name }}"  placeholder="Name">
      </div> --}}
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Provinsi Tujuan</label>
        <select name="province_to" class="form-control" id="">
            <option value="">--Provinsi--</option>
            @foreach ($provinces as $province => $value)
            <option value="{{ $province }}">{{ $value }}</option>
            @endforeach
        </select>
      </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Kota Tujuan</label>
        <select name="destination" class="form-control" id="">
            <option value="">--Pilih Kota--</option>
        </select>
      </div>
      <div class="mb-3">
        {{-- <label class="form-label">Berat (g)</label> --}}
        <input type="hidden" name="weight" class="form-control" id="" value="100">
      </div>
      {{-- <div class="mb-3 address">
        <label for="exampleFormControlInput1" class="form-label">Alamat Lengkap</label>
        <textarea name="address" id="address" class="form-control"  placeholder="Address">{{ Auth::user()->address }}</textarea>
      </div> --}}

      {{-- <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Kurir</label>
        <select name="courier" class="form-control" id="">
            <option value="">--Jasa Kirim--</option>
            @foreach ($couriers as $courier => $value)
            <option value="{{ $courier }}">{{ $value }}</option>
            @endforeach
        </select>
    </div> --}}
      {{-- <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div> --}}
      <div class="mb-3">
        <button class="btn btn-primary" type="submit">Submit</button>
      </div>
</form>

@if ($cekongkir)
<div class="row">
    @foreach ($cekongkir as $result)
    @php
        $ongkir = $result['cost'][0]['value'];
    @endphp
    @endforeach
</div>
@endif


<span></span>
    </div>
    </div>

    <div class="checkout">
        @php
            $total = 0;
        @endphp
            <div class="check-pay-title">
                <h3>Payment</h3>
            </div>
                  <hr>
                  @foreach ($checkout as $check)
                <ul class="cartWrap">
                    @if ($check->count() == 0)
                        Anda tidak memiliki barang di keranjang belanja Anda.
                    @endif
                    @if ($check->status == 'Belum Bayar')

                <li class="items odd">
                    <div class="infoWrap">
                        <div class="cartSection">
                            <img src=" {{ asset('/storage/storage/product/' . $check->product->image) }}"
                            alt="" class="itemImg" />

                            <h3>{{ $check->product->name }}</h3>
                            @if ($check->product->quantity > $check->qty)
                            <p>
                                <input name="qty" class="quantity" data-item="{{ $check->id }}"
                                    value="{{ $check->total_qty }}" disabled>
                                        Rp.{{ number_format($check->product->price)}},00
                                    </p>
                                    <p class="stockStatus"> In Stock</p>
                                    @php
                                      $total += $check->product->price * $check->total_qty;
                                    @endphp
                            @else
                            <p class="stockStatus out"> Out Of Stock</p>
                            @endif
                            @endif
                        </div>
                        <div class="prodTotal cartSection">
                            <p>Rp. {{ number_format($check->product->price * $check->total_qty) }},00</p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="subtotal cf">
                <ul>
                     <li class="totalRow"><span class="label">Subtotal</span><span class="value">Rp.{{number_format( $total)  }},00</span></li>

                     @if ($cekongkir)
                        <li class="totalRow"><span class="label">Ongkir</span><span class="value">Rp.{{ number_format($ongkir) }},00</span></li>



                        <li class="totalRow final"><span class="label">Total</span><span
                            class="value">Rp.{{ number_format($total + $ongkir) }},00</span></li>
                            @else
                            <li class="totalRow"><span class="label">Ongkir</span><span
                                class="value">Rp.0,00</span></li>
                        <li class="totalRow final"><span class="label">Total</span><span
                            class="value">Rp.{{ number_format($total) }},00</span></li>
                        @endif
                        {{-- <form action="/checkout" method="POST" id="checkout"> --}}
                            {{-- @csrf --}}
                        <li class="totalRow"><button id="pay-button" class="button continue">Pay!</button></li>
                        {{-- </form> --}}

                </ul>
            </div>

</div>
</div>

</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script type="text/javascript"
src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="SB-Mid-client-X9lvbS-70Ebv9hlu"></script>
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
     // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
     window.snap.pay('{{$snapToken}}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            alert("payment success!"); console.log(result);
          },
          onPending: function(result){
            /* You may add your own implementation here */
            alert("wating your payment!"); console.log(result);
          },
          onError: function(result){
            /* You may add your own implementation here */
            alert("payment failed!"); console.log(result);
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
          }
        })
      });
  </script>

<script>
    $(document).ready(function(){
        $('select[name="province_from"]').on('change', function(){
            let provinceId = $(this).val();
            if(provinceId) {
                jQuery.ajax({
                    url: '/checkout/province/' + provinceId + '/cities',
                    type:"GET",
                    dataType :"json",
                    success:function(data) {
                        $('select[name="origin"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="origin"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                $('select[name="origin"]').empty();
            }
        });
        $('select[name="province_to"]').on('change', function(){
            let provinceId = $(this).val();
            if(provinceId) {
                jQuery.ajax({
                    url: '/checkout/province/' + provinceId+'/cities',
                    type:"GET",
                    dataType :"json",
                    success:function(data) {
                        $('select[name="destination"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="destination"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                        });
        } else {
            $('select[name="destination"]').empty();
        }
    });
    });

</script>


@endsection
