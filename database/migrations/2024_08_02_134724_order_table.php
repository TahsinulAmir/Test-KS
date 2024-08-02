<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_order', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('produk_id');
            $table->integer('qty');
            $table->enum('status', ['Unpaid', ['Paid']]);
            $table->string('bank');
            $table->bigInteger('va');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_order');
    }
};
