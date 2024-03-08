@extends('layout.app')
@section('content')
<h2>Tambah Barang</h2>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Masukkan Data Barang Baru</h3>
        </div>
        <form method="POST" action="{{ route('barang.store') }}" enctype="multipart/form-data" role="form">
            <div class="box-body">
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input class="form-control" type="text" id="nama_barang" name="nama_barang"
                        autocomplete="off" autofocus required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input class="form-control" type="number" id="harga" name="harga" min="0" autocomplete="off"
                        autofocus required>
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input class="form-control" type="number" id="stok" name="stok" min="0" autocomplete="off"
                        autofocus required>
                </div>
                {{-- <button class="btn btn-primary" type="submit">Simpan</button> --}}
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    @endsection