<?php

// app/Http/Controllers/BarangController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    // Menampilkan halaman input data barang
    public function index()
    {
        $barangs = Barang::all();
        return view('pages.barang.index',['barangs'=> $barangs]);
    }
    public function create()
    {   

        return view('pages.barang.tambahbarang');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);

        return redirect()->back()->with('pages.barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $barang = Barang::findOrFail($id);

        // Update the existing data
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui');
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
        ]);
        

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
       
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil ditambahkan');
    }
}