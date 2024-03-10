@extends('layout.app')
@section('content')
<h2>Laporan</h2>
<div class="box box-primary">
    <div class="box-header">
        <div class="box-title">Daftar Laporan</div>
        <div class="box-tools pull-right">
            <form method="POST" action="{{ route('laporan.cetak') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-primary">Cetak</button>
        </div>
    </div>
    <div class="box-body table table-responsive">
        <div class="form-group">
            <label for="tgl_awal">Tanggal Awal</label>
            <input type="date" class="form-control" name="tgl_awal" id="">
        </div>
        <div class="form-group">
            <label for="tgl_akhir">Tanggal Akhir</label>
            <input type="date" class="form-control" name="tgl_akhir" id="">
        </div>
        </form>
        <table class="table table-hover">
            <tr>
                <th>No</th>
                <th>Kasir</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
            @foreach ($transaksi as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kasir->name }}</td>
                <td>{{ $item->total_harga }}</td>
                <td>{{ $item->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection