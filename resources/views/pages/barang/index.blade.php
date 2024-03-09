@extends('layout.app')
@section('content')
    <h2>Barang</h2>
  <div class="box box-primary">
    <div class="box-header">
      <div class="box-title">Daftar Barang</div>
      <div class="box-tools">
        <a href="{{ route('tambahbarang') }}" class="btn btn-primary">Tambah Data</a>
      </div>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-hover">
        <tr>
          <th style="width: 5%">No</th>
            <th style="width: 30%">Nama Barang</th>
            <th style="width: 20%">Kategori</th>
            <th style="width: 15%">Harga</th>
            <th style="width: 15%">Stok</th>
            <th style="width: 15%">Aksi</th>
        </tr>
        @foreach ($barangs as $item)
        <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->nama_barang }}</td>
              <td>{{ $item->kategori->nama }}</td>
              <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
              <td>{{ $item->stok }}</td>
              <td>
                <div class="btn-group">
                  {{-- <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></a>
                  <form action="{{ route('barang.destroy', $item->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')"><i class="fa fa-trash"></i></button> --}}
                  <a href="{{ route('barang.edit', ['id' => $item->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                    <form id="delete-form-{{ $item->id }}" action="{{ route('barang.destroy', $item->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a href="#" class="btn btn-danger" onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin mengahapus barang  ini?')) document.getElementById('delete-form-{{ $item->id }}').submit();">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
              </td>
          @endforeach
        </tr>
      </table>
    </div>
  </div>
  @endsection