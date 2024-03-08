@extends('layout.app')
@section('content')
<h2>Edit Kategori</h2>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Masukkan Data Kategori Baru</h3>
        </div>
        <form method="POST" action="{{ route('kategori.store') }}" enctype="multipart/form-data" role="form">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="nama">Nama Kategori</label>
                    <input class="form-control" type="text" id="nama" name="nama"
                        autocomplete="off" autofocus required>
                </div>
                {{-- <button class="btn btn-primary" type="submit">Simpan</button> --}}
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    @endsection