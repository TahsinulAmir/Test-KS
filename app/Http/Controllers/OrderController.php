<?php

namespace App\Http\Controllers;

use App\Models\KeranjangModel;
use App\Models\OrderModel;
use App\Models\ProdukOrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Lihat Order
    public function index()
    {
        $data = [
            'title' => 'Order',
            'order' => OrderModel::where('user_id', Auth::guard('user')->user()->id)->get(),
        ];

        return view('v_order', $data);
    }

    // Lihat Detail Order/Invoice
    public function detailOrder($id)
    {
        $order = OrderModel::where('tb_order.id', $id)
            ->join('users', 'tb_order.user_id', '=', 'users.id')
            ->select('tb_order.*', 'users.name', 'users.email')
            ->first();

        $produk_order = ProdukOrderModel::where('order_id', $id)
            ->join('tb_produk', 'tb_produk_order.produk_id', '=', 'tb_produk.id')
            ->get();

        $total_harga = 0;
        foreach ($produk_order as $key => $value) {
            $total_harga += $value->harga * $value->qty;
        }

        $data = [
            'title' => 'Detail Order',
            'detail_order' => $order,
            'produk_order' => $produk_order,
            'total_order' => $total_harga
        ];

        return view('v_detail_order', $data);
    }

    // Proses Buat Order
    public function prosesCheckout(Request $request)
    {
        $data = [
            'id' => time(),
            'user_id' => $request->user_id,
            'total_harga' => $request->total_harga,
        ];
        $order = OrderModel::create($data);

        $keranjang = KeranjangModel::where('user_id', $request->user_id)->get();
        foreach ($keranjang as $key => $value) {
            ProdukOrderModel::create([
                'produk_id' => $value->produk_id,
                'order_id' => $data['id'],
                'qty' => $value->jumlah,
            ]);
        }

        KeranjangModel::where('user_id', $request->user_id)->delete();

        return response()->json(['success' => 'Success', 'order_id' => $data['id']]);
    }

    // Meminta Virtual Account
    public function prosesPembayaran(Request $request, $id)
    {
        $order =  OrderModel::find($id);

        $url = 'https://api.sandbox.midtrans.com/v2/charge';
        $server_key = config('midtrans.server_key');

        $data = [
            "payment_type" => "bank_transfer",
            "transaction_details" => [
                "order_id" => $order->id,
                "gross_amount" => $order->total_harga
            ],
            "bank_transfer" => [
                "bank" => $request->bank
            ]
        ];

        $data_string = json_encode($data);
        $base64_server_key = base64_encode($server_key);

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Authorization: Basic ' . $base64_server_key,
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        $va = json_decode($response, true);
        $order->bank = $va['va_numbers'][0]['bank'];
        $order->va = $va['va_numbers'][0]['va_number'];
        $order->save();

        return response()->json(['success' => 'Success']);
    }

    // Callback Ketika sudah melakukan pembayaran
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $order = OrderModel::find($request->order_id);
                $order->update(['status' => 'Paid']);
            }
        }
    }
}
