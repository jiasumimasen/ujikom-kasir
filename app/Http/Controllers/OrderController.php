<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;

class OrderController extends Controller
{
    public function index()
{
    // $products = Product::orderBy('created_at', 'DESC')->get();
    // return view('orders.add', compact('produk'));
    return view('pages.order.add');
}
}
