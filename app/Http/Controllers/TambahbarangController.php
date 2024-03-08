<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TambahbarangController extends Controller
{
    public function index()
    {
        return back()->with('pages.barang.');
    }
}
