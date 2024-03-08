@extends('layout.app')
@section('content')


<div class="container-fluid">
    <h1>Barang</h1>
    <div class="card-body">
      <div class="content">
          <div class="card card-info card-outline">
              <div class="card-header">
                  <h4>Tambah Barang</h4>
              </div>
            <div class="card-body">

                <form method="POST" action="{{ route('barang.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Add your form fields for 'foto', 'nama_barang', 'kategori', 'harga', and 'stok' -->
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang:</label>
                        <input type="text" name="nama_barang" autocomplete="off" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga:</label>
                        <input type="number" name="harga" min="0"  autocomplete="off" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok:</label>
                        <input type="number" name="stok" min="0" autocomplete="off" autofocus required>
                    </div>
                    <button type="submit">Submit</button>
                </form>

                </div>
            </div>
        </div>
    </div>
</tbody>
  @endsection
</tbody>
</table>
</div>
</div>