@extends('layout.app')
@section('content')
<h2>Kategori</h2>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Daftar Kategori</h3>
        <div class="box-tools">
            <a href="{{ route('tambahkategori') }}" class="btn btn-primary">Tambah Data</a>
            {{-- <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div> --}}
        </div>
    </div>

    <div class="box-body table-responsive">
        <table class="table table-hover">
            <tr>
                <th style="width: 40px;">No</th>
                <th>Nama Kategori</th>
                <th style="width: 100px;">Aksi</th>
            </tr>
             @foreach ($kategori as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td><div class="btn-group">
                    <a href="{{ route('kategori.edit', ['id' => $item->id]) }}" class="btn bg-purple"><i class="fa fa-pencil"></i></a>
                    <form id="delete-form-{{ $item->id }}" action="{{ route('kategori.destroy', ['id' => $item->id]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a href="#" class="btn btn-danger" onclick="event.preventDefault(); if(confirm('Yakin data akan dihapus?')) document.getElementById('delete-form-{{ $item->id }}').submit();">
                        <i class="fa fa-trash"></i>
                    </a>
                    </div></td>
            </tr>
            @endforeach

        </table>
    </div>

</div>

</div>
</div>
</section>

</div>
@endsection