<?php

namespace App\Http\Controllers;

use App\Models\KeranjangModel;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Order',
            'order' => OrderModel::where('id', Auth::guard('user')->user()->id)->get(),
        ];

        return view('v_order', $data);
    }

    public function prosesOrder(Request $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'total_harga' => $request->total_harga,
            'bank' => $request->bank,
            'va' => '9237472378548'
        ];
        OrderModel::create($data);

        KeranjangModel::where('user_id', $request->user_id)->delete();

        return response()->json(['success' => 'Success']);
    }
}
