<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id('id_detail');
            $table->foreignId('id_penjualan')
                  ->constrained('penjualan', 'id_penjualan')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->foreignId('id_produk')
                  ->constrained('produk', 'id_produk')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();
            $table->decimal('harga_jual', 15, 2);
            $table->integer('jumlah');
            $table->decimal('diskon_item', 15, 2)->default(0);
            $table->decimal('subtotal', 15, 2);
            $table->integer('stok')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_penjualan');
    }
};