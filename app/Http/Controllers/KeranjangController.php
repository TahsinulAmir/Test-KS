<?php

namespace App\Http\Controllers;

use App\Models\KeranjangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function keranjang()
    {
        $user_id = Auth::guard('user')->user()->id;
        $keranjang = KeranjangModel::where('user_id', $user_id)
            ->join('tb_produk', 'tb_keranjang.produk_id', '=', 'tb_produk.id')
            ->get();

        $total_harga = 0;
        foreach ($keranjang as $key => $value) {
            $total_harga += $value->harga * $value->jumlah;
        }

        $data = [
            'title' => 'Keranjang',
            'keranjang' => $keranjang,
            'total_harga' => $total_harga
        ];
        return view('v_keranjang', $data);
    }

    public function tambahKeranjang(Request $request)
    {
        $data = [
            'user_id' => Auth::guard('user')->user()->id,
            'produk_id' => $request->produk_id,
            'jumlah' => 1,
        ];
        KeranjangModel::create($data);

        return redirect()->back()->with('success', 'Success');
    }
}
