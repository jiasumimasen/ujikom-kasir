<?php

// app/Http/Controllers/BarangController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;

class BarangController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    // Menampilkan halaman input data barang
    public function index()
    {
        $barangs = Barang::with('kategori')->get();
        return view('pages.barang.index',['barangs' => $barangs]);
    }
    public function create()
    {   
        $kategori = Kategori::all();
        return view('pages.barang.tambahbarang', compact('kategori'));
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategoris = Kategori::all(); // Mengambil semua data kategori
        return view('pages.barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $barang = Barang::findOrFail($id);

        // Update the existing data
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori,
        ]);

        return redirect()->route('barang')->with('success', 'Data barang berhasil diperbarui');
    }

    public function destroy($id)
{
    Barang::findOrFail($id)->delete();

    return redirect()->back()->with('success', 'Barang berhasil dihapus');
}


    // Menyimpan data barang baru
    public function store(Request $request)
{
    $request->validate([
        'nama_barang' => 'required|string|max:255',
        'harga' => 'required|numeric|min:0',
        'stok' => 'required|integer|min:0',
        'kategori' => 'required', // Validasi kategori
    ]);

    Barang::create([
        'nama_barang' => $request->nama_barang,
        'harga' => $request->harga,
        'stok' => $request->stok,
        'kategori_id' => $request->kategori, // Menyimpan ID kategori
    ]);

    return redirect('/barang')->with('success', 'Data barang berhasil ditambahkan');
}

}