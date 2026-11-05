<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class DataDummySeeder extends Seeder
{
    public function run(): void
    {
        // --- Kategori ---
        $kategori = [
            'Makanan'    => 'Makanan ringan dan instan',
            'Minuman'    => 'Minuman kemasan dan sachet',
            'Alat Tulis' => 'Perlengkapan sekolah dan kantor',
            'Kebersihan' => 'Perlengkapan mandi dan kebersihan',
        ];

        $idKategori = [];
        foreach ($kategori as $nama => $keterangan) {
            $k = Kategori::firstOrCreate(
                ['nama_kategori' => $nama],
                ['keterangan' => $keterangan]
            );
            $idKategori[$nama] = $k->id_kategori;
        }

        // --- Produk: kode, nama, kategori, harga beli, harga jual, stok, satuan ---
        $produk = [
            ['MKN-001', 'Mie Instan Goreng',    'Makanan',    2800,  3500, 100, 'pcs'],
            ['MKN-002', 'Biskuit Cokelat',      'Makanan',    6500,  8000,  50, 'pak'],
            ['MKN-003', 'Keripik Singkong',     'Makanan',    7000,  9000,  30, 'bungkus'],
            ['MNM-001', 'Air Mineral 600ml',    'Minuman',    2000,  3000, 120, 'botol'],
            ['MNM-002', 'Teh Botol',            'Minuman',    4000,  5500,  80, 'botol'],
            ['MNM-003', 'Kopi Sachet',          'Minuman',    1200,  2000, 200, 'sachet'],
            ['ATK-001', 'Pulpen Hitam',         'Alat Tulis', 2500,  4000,  60, 'pcs'],
            ['ATK-002', 'Buku Tulis 38 Lembar', 'Alat Tulis', 3500,  5000,  75, 'pcs'],
            ['ATK-003', 'Penghapus',            'Alat Tulis', 1500,  2500,   3, 'pcs'],   // stok rendah
            ['KBR-001', 'Sabun Mandi Batang',   'Kebersihan', 2500,  3500,  40, 'pcs'],
            ['KBR-002', 'Sampo Sachet',         'Kebersihan',  500,  1000, 150, 'sachet'],
            ['KBR-003', 'Tisu Wajah',           'Kebersihan', 8000, 11000,   0, 'pak'],   // stok habis
        ];

        foreach ($produk as [$kode, $nama, $kat, $beli, $jual, $stok, $satuan]) {
            Produk::firstOrCreate(
                ['kode_produk' => $kode],
                [
                    'id_kategori' => $idKategori[$kat],
                    'nama_produk' => $nama,
                    'harga_beli'  => $beli,
                    'harga_jual'  => $jual,
                    'stok'        => $stok,
                    'satuan'      => $satuan,
                ]
            );
        }

        // --- Pelanggan ---
        $pelanggan = [
            ['Budi Santoso',    'Jl. Mawar No. 12',   '081234567801', 'budi@example.com'],
            ['Siti Aminah',     'Jl. Melati No. 5',   '081234567802', 'siti@example.com'],
            ['Agus Prasetyo',   'Jl. Kenanga No. 8',  '081234567803', null],
            ['Dewi Lestari',    'Jl. Anggrek No. 21', '081234567804', 'dewi@example.com'],
            ['Rina Wulandari',  'Jl. Dahlia No. 3',   '081234567805', null],
        ];

        foreach ($pelanggan as [$nama, $alamat, $telepon, $email]) {
            Pelanggan::firstOrCreate(
                ['nama_pelanggan' => $nama],
                ['alamat' => $alamat, 'telepon' => $telepon, 'email' => $email]
            );
        }
    }
}