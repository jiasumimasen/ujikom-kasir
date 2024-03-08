@extends('layout.app')
@section('content')


    </div><div class="container-fluid">
    <h1>Data Barang</h1>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Harga</th>
          <th>Stok</th>
        </tr>
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <a href="{{ route('tambahbarang') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fas fa-plus"></i> Tambah Data</a>
      </div>
      <?php $no = 1; ?>
      @foreach($barangs as $barang)
      <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $barang->nama_barang }}</td>
          <td>{{ $barang->harga }}</td>
          <td>{{ $barang->stok }}</td>
          <td>
              <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning">Edit</a>
              <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" style="display:inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
              </form>
          </td>
      </tr> 
  @endforeach
  @endsection
</tbody>
</table>
</div>
</div>