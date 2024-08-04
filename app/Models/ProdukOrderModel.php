<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukOrderModel extends Model
{
    use HasFactory;

    protected $table = 'tb_produk_order';
    protected $primaryKey = 'id';
    protected $fillable = ['produk_id', 'order_id', 'qty'];
}
