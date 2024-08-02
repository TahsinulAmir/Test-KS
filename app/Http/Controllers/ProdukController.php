<?php

namespace App\Http\Controllers;

use App\Models\ProdukModel;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Produk Kami',
            'products' => ProdukModel::all()
        ];

        return view('v_produk', $data);
    }
}
