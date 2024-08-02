<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'tb_order';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'produk_id', 'qty', 'status', 'bank', 'va'];
}
