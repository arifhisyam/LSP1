<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->foreignId('id_kategori')
                  ->constrained('kategori', 'id_kategori')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();
            $table->string('kode_produk', 50)->unique();
            $table->string('nama_produk', 150);
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_beli', 15, 2)->default(0);
            $table->decimal('harga_jual', 15, 2)->default(0);
            $table->integer('stok')->default(0);
            $table->string('satuan', 30)->nullable();
            $table->text('keterangan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};