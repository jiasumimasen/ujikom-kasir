<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('pages.transaction.index', compact('barang'));
    }
    public function store(Request $request)
    {
        // Validasi request jika diperlukan
        $request->validate([
            'total' => 'required|numeric',
            // Anda mungkin juga perlu menambahkan validasi untuk kuantitas barang, tergantung pada kebutuhan aplikasi Anda
        ]);

        $id_produk = $request->idbarang;
        $jumlah_produk = $request->quantity;
        
        if ($id_produk && $jumlah_produk) {
            for ($i = 0; $i < count($id_produk); $i++) {
                $barang = Barang::find($id_produk[$i]);
                if ($barang) {
                    $barang->stok -= $jumlah_produk[$i];
                    $barang->save();
                }
            }
        }
        

        // Buat objek transaksi baru
        $transaksi = new Transaksi();
        $transaksi->kasir_id = Auth()->id();
        $transaksi->total_harga = $request->total;
        // Simpan transaksi ke dalam database
        $transaksi->save();

        // Jika ingin memberikan respon atau redirect setelah menyimpan
        return redirect('transaction');
    }
}
