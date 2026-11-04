<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    public $timestamps = false;

    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'telepon',
        'email'
    ];

    public function penjualan(): HasMany
    {
        return $this->hasMany(Penjualan::class, 'id_pelanggan', 'id_pelanggan');
    }
}
