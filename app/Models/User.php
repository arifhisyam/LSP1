<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class user extends Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = [
        'nama_user',
        'username',
        'password',
        'level',
        'status'
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function penjualan(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Penjualan::class, 'id_user','id_user');
    }
}