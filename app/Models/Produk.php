<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    public $timestamps = false;

    protected $fillable = [
        'id_kategori',
        'kode_produk',
        'nama_produk',
        'deskripsi',
        'harga_beli',
        'harga_jual',
        'stok',
        'satuan',
        'keterangan'
    ];

    public function detail_penjualan(): HasMany
    {
        return $this->hasMany(DetailPenjualan::class, 'id_produk', 'id_produk');
    }
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}
