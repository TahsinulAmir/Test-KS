<?php

namespace App\Http\Controllers;

use App\Models\KeranjangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    // Lihat Keranjang
    public function keranjang()
    {
        $user_id = Auth::guard('user')->user()->id;
        $keranjang = KeranjangModel::where('user_id', $user_id)
            ->join('tb_produk', 'tb_keranjang.produk_id', '=', 'tb_produk.id')
            ->select('tb_keranjang.id as keranjang_id', 'tb_keranjang.jumlah', 'tb_produk.*')
            ->get();

        $total_harga = 0;
        foreach ($keranjang as $key => $value) {
            $total_harga += $value->harga * $value->jumlah;
        }

        $data = [
            'title' => 'Keranjang',
            'keranjang' => $keranjang,
            'total_harga' => $total_harga,
            'count' => KeranjangModel::where('user_id', $user_id)->count()
        ];

        return view('v_keranjang', $data);
    }

    // Tambah Keranjang
    public function tambahKeranjang(Request $request)
    {
        $user_id = Auth::guard('user')->user()->id;
        $produk_id = $request->produk_id;

        $cek_produk = KeranjangModel::where('produk_id', $produk_id)
            ->where('user_id', $user_id)
            ->count();

        if ($cek_produk == 0) {
            $data = [
                'user_id' => $user_id,
                'produk_id' => $produk_id,
                'jumlah' => 1,
            ];

            $msg = 'Produk ditambahkan di Keranjang';
            KeranjangModel::create($data);
        } else {
            $produk = KeranjangModel::where('produk_id', $produk_id)
                ->where('user_id', $user_id)
                ->first();
            $produk->jumlah = $produk->jumlah + 1;
            $produk->save();

            $msg = 'Produk di Keranjang di perbarui';
        }

        return response()->json(['success' => $msg]);
    }

    // Update Jumlah Produk Pada Keranjang
    public function updateKeranjang(Request $request, $id)
    {
        $keranjang = KeranjangModel::findOrFail($id);
        $keranjang->jumlah = $request->jumlah;
        $keranjang->save();

        return response()->json(['success' => 'Success Update Jumlah!!']);
    }

    // Hapus Keranjang
    function hapusKeranjang($id)
    {
        $keranjang = KeranjangModel::findOrFail($id);
        $keranjang->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
