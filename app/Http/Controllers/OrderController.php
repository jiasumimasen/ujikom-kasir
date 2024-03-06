<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Order;

class OrderController extends Controller
{
    public function index()
{
    // $products = Product::orderBy('created_at', 'DESC')->get();
    // return view('orders.add', compact('produk'));
    return view('pages.order.add');
}

/**Update the specified resource in storage.*/


public function edit()
{
 return view('pages.order.edit');
}
}