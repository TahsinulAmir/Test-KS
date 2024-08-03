<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'tb_order';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'user_id', 'total_harga', 'status', 'bank', 'va'];
}
