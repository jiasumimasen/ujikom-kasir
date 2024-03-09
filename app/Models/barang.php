<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang', 'kategori_id', 'harga', 'stok'
    ];

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
    
    // Definisikan nilai kategori yang diperbolehkan
    // public static $kategoriValues = ['makanan', 'minuman'];

}