<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksis';
    protected $fillable = [
        'kasir_id','total'
    ];

    public function kasir(){
        return $this->belongsTo(User::class, 'kasir_id', 'id');
    }
}