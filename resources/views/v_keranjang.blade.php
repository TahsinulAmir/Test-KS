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
                                    <input type="number" class="form-control" value="{{ $item->jumlah }}" min="1">
                                </td>
                                <td>Rp. {{ $item->harga }}</td>
                                <td>Rp. {{ $item->jumlah * $item->harga }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm">Hapus</button>
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
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Checkout</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Bank</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="prosesOrder">
                    <div class="modal-body">
                        @csrf
                        <div>
                            <select class="form-select" name="bank" id="bank" aria-label="Default select example">
                                <option selected disabled>-----Pilih Bank------</option>
                                <option value="bri">BRI</option>
                                <option value="bni">BNI</option>
                                <option value="bca">BCA</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $('#prosesOrder').on('submit', function(e) {
            e.preventDefault();
            var total_harga = '{{ $total_harga }}';
            var user_id = '{{ Auth::guard('user')->user()->id }}';
            var bank = $('#bank').val();

            $.ajax({
                url: '/prosesOrder',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    total_harga: total_harga,
                    user_id: user_id,
                    bank: bank,
                },
                success: function(response) {
                    // alert(response.message);
                    Swal.fire({
                        title: "Berhasil!",
                        text: "Order Berhasil Dibuat!",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/order';
                        }
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Order Gagal Dibuat',
                        icon: 'error',
                        confirmButtonText: 'Oke'
                    })
                }
            });
        });
    </script>
@endpush
