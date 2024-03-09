<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index()
    {
        $totalbarang = Barang::count();
        return view('dashboard.index', compact('totalbarang'));
    }
}
