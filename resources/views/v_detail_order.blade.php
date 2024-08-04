@extends('layout.main')

@section('content')
    <div class="container">
        <div class="heading_container heading_center">
            <h2>{{ $title }}</h2>
        </div>
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="3">
                        <table>
                            <tr>
                                <td class="title">
                                    @if ($detail_order->status == 'Paid')
                                        <h1 class="fw-bold text-success">Lunas</h1>
                                    @else
                                        <h1 class="fw-bold text-danger">Belum Lunas</h1>
                                    @endif

                                    @if (!$detail_order->va)
                                        <button class="btn btn-primary" type="submit" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">Pilih Bank</button>
                                    @endif

                                </td>
                                <td>
                                    Invoice #: {{ $detail_order->id }}<br>
                                    Created: {{ date($detail_order->created_at) }}<br>
                                    Due:{{ date('Y-m-d H:i:s', strtotime('+1 day', strtotime($detail_order->created_at))) }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    {{ $detail_order->name }}<br>
                                    {{ $detail_order->email }}<br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="heading col">
                    <td>
                        Metode Pembayaran
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        Virtual Account
                    </td>
                </tr>
                <tr class="details col">
                    <td>
                        Virtual Account ({{ Str::upper($detail_order->bank) }})
                    </td>
                    <td>
                        <strong>{{ $detail_order->va }}</strong>
                    </td>
                </tr>
                <tr class="heading">
                    <td>
                        Item
                    </td>
                    <td>
                        Pcs
                    </td>
                    <td>
                        Price
                    </td>
                    <td>
                        Total
                    </td>
                </tr>
                @foreach ($produk_order as $item)
                    <tr class="item">
                        <td>
                            {{ $item->produk }}
                        </td>
                        <td>
                            {{ $item->qty }}
                        </td>
                        <td>
                            Rp. {{ $item->harga }}
                        </td>
                        <td>
                            Rp. {{ $item->harga * $item->qty }}
                        </td>
                    </tr>
                @endforeach

                <tr class="total">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <strong>Rp. {{ $total_order }}</strong>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    {{-- !-- Modal --> --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Bank</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="prosesPembayaran">
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
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Bayar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $('#prosesPembayaran').on('submit', function(e) {
            e.preventDefault();
            var order_id = '{{ $detail_order->id }}';
            var bank = $('#bank').val();

            $.ajax({
                url: '/prosesPembayaran/' + order_id,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    order_id: order_id,
                    bank: bank,
                },
                success: function(response) {
                    // alert(response.message);
                    console.log(response);

                    Swal.fire({
                        title: "Berhasil!",
                        text: "Silahkan bayar dengan VA yang telah disediakan!",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // window.location.href = '/order';
                            window.location.reload()
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
