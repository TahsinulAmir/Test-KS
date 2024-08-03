@extends('layout.main')

@section('content')
    <div class="container">
        <div class="heading_container heading_center">
            <h2>{{ $title }}</h2>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th scope="col">Id Order</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Bank</th>
                            <th scope="col">Virtual Account</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>Rp. {{ $item->total_harga }}</td>
                                <td>{{ Str::upper($item->bank) }}</td>
                                <td>{{ $item->va }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a href="{{ url('/order/'.$item->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
