@extends('layout.app')
@section('content')
<h2>Tambah Barang</h2>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Masukkan Data Barang Baru</h3>
        </div>
        <form method="POST" action="{{ route('barang.update', $barang->id) }}" enctype="multipart/form-data" role="form">
            @csrf
            @method('PUT')
            <div class="box-body">
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input class="form-control" type="text" id="nama_barang" name="nama_barang"
                        value="{{ $barang->nama_barang }}" autocomplete="off" autofocus required>
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select class="form-control" id="kategori" name="kategori" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ $kategori->id == $barang->kategori_id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input class="form-control" type="number" id="harga" name="harga" min="0" autocomplete="off"
                    value="{{ $barang->harga }}" autocomplete="off" autofocus required>
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input class="form-control" type="number" id="stok" name="stok" min="0" autocomplete="off"
                    value="{{ $barang->stok }}" autocomplete="off" autofocus required>
                </div>
                {{-- <button class="btn btn-primary" type="submit">Simpan</button> --}}
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    @endsection