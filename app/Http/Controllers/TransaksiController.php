<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\vwProduk;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\transaksidetail;
// use Illuminate\Support\Facades\Auth;


class TransaksiController extends Controller
{
    // Menampilkan semua transaksi
    public function index()
    {
        // $transaksis = Transaksi::all();
        $products = Barang::all();
        // if($products){
        //     var_dump($products);die();
            
        // }else{
            return view('transaksi.index', compact('products'));

        }
    // }

    // Menampilkan formulir untuk membuat transaksi baru
    public function create()
    {
        // Jika Anda memiliki data yang perlu dipassing ke formulir, Anda bisa menambahkannya di sini
        return view('transaksi.create');
    }

    // Menyimpan transaksi baru yang dibuat
    public function store(Request $request)
    {

        // $user = Auth::user()->id;
        $id_produk  = $request->id_produk; 
        $jumlah_produk     = $request->jumlah; 
        $sub_total  = $request->sub_total;
        $total      = $request->total; 
        $bayar      = $request-> bayar;
        $kembalian  = $request->kembalian;

        // var_dump($id_produk );die();
        $transaksi = Transaksi::create([
            'id_kasir' => '0',
            'total' => $total,
            'bayar' => $bayar,
            'kembalian' => $kembalian,
            'tanggal' => date('Y-m-d'),
        ]);
        
        // Ambil ID dari transaksi yang baru saja dibuat
        $id_transaksi = $transaksi->id;
        
        for ($i = 0; $i < count($id_produk); $i++) {
            $id = $id_produk[$i];
            $jumlah = $jumlah_produk[$i];
            $subtotal = $sub_total[$i];

            transaksidetail::create([
                'id_transaksi' => $id_transaksi,
                'id_produk' => $id,
                'jumlah' => $jumlah,
                'total' => $total,
            ]);
        }
        // var_dump($request);die();
        // Validasi data dari request
        

        // Buat transaksi baru berdasarkan data yang diterima dari request

        // Redirect ke halaman indeks transaksi dengan pesan sukses
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // Menampilkan detail transaksi
    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.show', ['transaksi' => $transaksi]);
    }

    // Menampilkan formulir untuk mengedit transaksi
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.edit', ['transaksi' => $transaksi]);
    }

    // Menyimpan perubahan pada transaksi yang diubah
    public function update(Request $request, $id)
    {
        // Validasi data dari request
        $request->validate([
            // Sesuaikan aturan validasi sesuai kebutuhan Anda
            'nama' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            // Tambahkan aturan validasi lainnya
        ]);

        // Ambil transaksi yang akan diubah
        $transaksi = Transaksi::findOrFail($id);

        // Perbarui data transaksi berdasarkan data yang diterima dari request
        $transaksi->update([
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            // Isi ini sesuai dengan kolom yang ada di tabel transaksi
        ]);

        // Redirect ke halaman indeks transaksi dengan pesan sukses
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    // Menghapus transaksi
    public function destroy($id)
    {
        // Cari transaksi berdasarkan ID dan hapus
        Transaksi::findOrFail($id)->delete();

        // Redirect ke halaman indeks transaksi dengan pesan sukses
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}