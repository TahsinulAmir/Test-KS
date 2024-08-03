@extends('layout.main')

@section('content')
    <div class="container">
        <div class="heading_container heading_center">
            <h2>{{ $title }}</h2>
        </div>
        <div class="row">
            @foreach ($products as $item)
                <div class="col-sm-6 col-lg-4">
                    <div class="box">
                        <div class="img-box">
                            <img src="{{ asset('/assets/images/' . $item->foto) }}" alt="">
                            @if (Auth::guard('user')->check())
                                {{-- <form id="tambahKeranjang{{ $item->id }}"> --}}
                                @csrf
                                {{-- <input type="hidden" name="produk_id" id="produk_id" value="{{ $item->id }}"> --}}
                                <button class="add_cart_btn" data-id="{{ $item->id }}"
                                    id="tambahKeranjang{{ $item->id }}" name="produk_id" id="produk_id" type="submit">
                                    <span>Add To Cart</span>
                                </button>
                                {{-- </form> --}}
                            @else
                                <a href="/login" class="add_cart_btn">
                                    <span>Add To Cart</span>
                                </a>
                            @endif
                        </div>
                        <div class="detail-box">
                            <h5>{{ $item->produk }}</h5>
                            <div class="product_info">
                                <h5><span>Rp</span> {{ $item->harga }}</h5>
                                <div class="star_container">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('myscript')
    @foreach ($products as $item)
        <script>
            $(document).on('click', '#tambahKeranjang{{ $item->id }}', function(e) {
                e.preventDefault();
                // var produk_id = $('#produk_id').val();
                var produk_id = $(this).data('id');

                $.ajax({
                    url: '/tambah-keranjang',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        produk_id: produk_id,
                    },
                    success: function(response) {

                        Swal.fire({
                            title: "Berhasil!",
                            text: "Berhasil ditambahkan ke kerangjang!",
                            icon: "success"
                        })
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Gagal menambahkan ke keranjang!',
                            icon: 'error',
                            confirmButtonText: 'Oke'
                        })
                    }
                });
            });
        </script>
    @endforeach
@endpush
