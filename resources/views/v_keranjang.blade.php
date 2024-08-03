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
                            <th scope="col">Produk</th>
                            <th scope="col">Pcs</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keranjang as $item)
                            <tr>
                                <td>{{ $item->produk }}</td>
                                <td>
                                    <form id="updateJumlah{{ $item->keranjang_id }}">
                                        <div class="row">
                                            <div class="col-auto">
                                                <input type="number" class="form-control" name="jumlah{{ $item->keranjang_id }}" id="jumlah{{ $item->keranjang_id }}"
                                                    value="{{ $item->jumlah }}" min="1">
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td>Rp. {{ $item->harga }}</td>
                                <td>Rp. {{ $item->jumlah * $item->harga }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm btn-delete"
                                        data-id="{{ $item->keranjang_id }}">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-right"><strong>Total</strong></td>
                            <td colspan="2"><strong>Rp. {{ $total_harga }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                @if ($count != 0)
                    <form action="" id="prosesOrder">
                        <button class="btn btn-primary" type="submit">Checkout</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        // Checkout
        $('#prosesOrder').on('submit', function(e) {
            e.preventDefault();
            var total_harga = '{{ $total_harga }}';
            var user_id = '{{ Auth::guard('user')->user()->id }}';

            $.ajax({
                url: '/prosesOrder',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    total_harga: total_harga,
                    user_id: user_id,
                },
                success: function(response) {

                    Swal.fire({
                        title: "Berhasil!",
                        text: "Silahkan Lanjutkan Pembayaran!",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/order/' + response.order_id;
                        }
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Gagal Checkout!',
                        icon: 'error',
                        confirmButtonText: 'Oke'
                    })
                }
            });
        });

        // Konfirmasi Hapus
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            var id = $(this).data('id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Produk Akan Dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/hapusKeranjang/' + id,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Dihapus!',
                                'Produk berhasil dihapus!',
                                'success'
                            );

                            window.location.reload();
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'Gagal menghapus produk!',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>

    {{-- Update Jumlah --}}
    @foreach ($keranjang as $item)
        <script>
            $('#updateJumlah{{ $item->keranjang_id }}').on('submit', function(e) {
                e.preventDefault();
                var jumlah = $('#jumlah{{ $item->keranjang_id }}').val();

                $.ajax({
                    url: '/updateJumlah/{{ $item->keranjang_id }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        jumlah: jumlah,
                    },
                    success: function(response) {

                        Swal.fire({
                            title: "Berhasil!",
                            text: "Jumlah Berhasil Diperbarui!",
                            icon: "success"
                        })
                        window.location.reload();
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Jumlah Gagal Diperbarui!',
                            icon: 'error',
                            confirmButtonText: 'Oke'
                        })
                    }
                });
            });
        </script>
    @endforeach
@endpush
