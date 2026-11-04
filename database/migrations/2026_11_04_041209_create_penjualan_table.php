<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id('id_penjualan');
            $table->foreignId('id_pelanggan')->nullable()
                  ->constrained('pelanggan', 'id_pelanggan')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
            $table->foreignId('id_user')
                  ->constrained('user', 'id_user')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();
            $table->string('no_nota', 50)->unique();
            $table->dateTime('tgl_penjualan');
            $table->decimal('total', 15, 2)->default(0);
            $table->decimal('diskon', 15, 2)->default(0);
            $table->decimal('pembayaran', 15, 2)->default(0);
            $table->decimal('kembalian', 15, 2)->default(0);
            $table->integer('stok_akhir')->nullable();
            $table->text('keterangan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};