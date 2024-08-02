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
                            <a href="" class="add_cart_btn">
                                <span>
                                    Add To Cart
                                </span>
                            </a>
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
