<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    public $timestamps = false;

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'jenis', 'id_kategori');
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'barang', 'id_barang');
    }
}
