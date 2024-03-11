@extends('layout.app')
@section('content')
<h2>Transaction</h2>
<div class="row">
    <div class="col-md-8">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Daftar Barang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive" style="min-height: 585px; max-height: 585px; overflow-y: auto;">
                    <table class="table no-margin">
                        <thead style="position: sticky; top: 0; background-color: #fff; z-index: 1;">
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->kategori->nama }}</td>
                                <td>Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>
                                    <button class="btn btn-secondary tambah-keranjang" data-id="{{ $item->id }}"
                                        data-nama_barang="{{ $item->nama_barang }}" data-harga="{{ $item->harga }}" data-stok="{{ $item->stok }}"><i
                                            class="fa fa-plus"></i></button>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Keranjang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form id="transaksiForm" action="{{ route('transaction.store') }}" method="POST">
                    @csrf
                    <div class="table" style="max-height: 450px; overflow-y:auto;">
                        <table class="table table-sm no-margin" style="width: 100%">
                            <thead style="position: sticky; top: 0; background-color: #fff; z-index: 1;">
                                <tr>
                                    <th style="width: 10%;">No</th>
                                    <th style="width: 40%;">Nama Barang</th>
                                    <th style="width: 25%;">Qty</th>
                                    <th style="width: 25%;">Harga</th>
                                </tr>
                            </thead>
                            <tbody id="keranjang">
                                <tr>
                                    <td id="no-item" colspan="4" class="text-center" style="min-height: 450px;">
                                        <p>{{ __('Keranjang kosong :(') }}</p>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right">Total</td>
                                    <td>
                                        <input type="text" name="total" id="total" value="" style="width: 60px; border:none;" readonly>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <div class="form-group">
                        <input type="hidden" id="totalHidden" name="totalHidden" class="form-control" readonly>
                        <input type="number" id="bayar" name="bayar" class="form-control" placeholder="Bayar">
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Simpan Transaksi</button>
                </div>
                </form>
            </div>
            
            <!-- /.box-footer -->
        </div>
    </div>
</div>
@endsection
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var number = 1; // Variabel untuk menyimpan nomor urut barang di keranjang

    $('.tambah-keranjang').click(function() {
        var itemId = $(this).data('id'); // Ambil ID barang dari atribut data-id
        var stokBarang = $(this).data('stok'); // Ambil stok barang dari atribut data-stok
        var namaBarang = $(this).closest('tr').find('td:eq(1)').text(); // Ambil nama barang dari kolom kedua
        var hargaBarang = $(this).closest('tr').find('td:eq(3)').text().replace('Rp. ', '').replace('.', ''); // Ambil harga barang dari kolom keempat
        var total = parseInt($('#total').val()) || 0; // Ambil total harga yang sudah ada atau 0 jika kosong
        
        // Cek apakah stok barang masih tersedia
        if (stokBarang > 0) {
            // Cek apakah barang dengan ID yang sama sudah ada di keranjang
            var existingItem = $('#keranjang tr[data-id="' + itemId + '"]');
            if (existingItem.length > 0) {
                // Jika barang sudah ada, tambahkan qty-nya
                var qty = parseInt(existingItem.find('.quantity').val());
                existingItem.find('.quantity').val(qty + 1);
            } else {
                // Jika barang belum ada, tambahkan sebagai item baru
                var newRow = '><tr data-id="' + itemId + '"><input type="hidden" name="idbarang[]" value="'+ itemId +'"><td>' + number + '</td><td>' + namaBarang + '</td><td><button class="remove-item">-</button><input type="number" name="quantity[]" class="quantity" value="1" style="width:50px; border:none;" readonly></td><td>Rp. ' + hargaBarang + '</td></tr>'; // Buat baris baru untuk ditambahkan ke keranjang
                $('#keranjang').append(newRow); // Tambahkan baris baru ke keranjang
                number++; // Tambahkan nomor urut untuk item berikutnya
            }
            total += parseInt(hargaBarang); // Tambahkan harga barang yang baru ditambahkan ke total
            $('#total').val(total); // Update nilai total
            $('#no-item').hide(); // Sembunyikan pesan 'Keranjang kosong'
            $(this).data('stok', stokBarang - 1); // Kurangi stok barang
        } else {
            alert('Stok barang ' + namaBarang + ' sudah habis.'); // Tampilkan pesan jika stok barang habis
        }
    });

    // Fungsi untuk mengurangi qty saat tombol (-) diklik
    $('#keranjang').on('click', '.remove-item', function() {
    var row = $(this).closest('tr');
    var qty = parseInt(row.find('.quantity').val());
    var hargaBarang = parseInt(row.find('td:eq(3)').text().replace('Rp. ', '').replace('.', ''));
    var total = parseInt($('#total').val());

    if (qty > 1) {
        row.find('.quantity').val(qty - 1);
        total -= hargaBarang; // Kurangi harga barang yang dihapus dari total
        $('#total').val(total); // Update nilai total
    } else {
        total -= hargaBarang; // Kurangi harga barang yang dihapus dari total
        $('#total').val(total); // Update nilai total
        row.remove(); // Hapus baris jika qty sudah 1
        if ($('#keranjang tr').length === 0) {
            $('#no-item').show(); // Tampilkan pesan 'Keranjang kosong' jika tidak ada barang lagi
        }
        resetNumber(); // Setel ulang nomor urutan barang hanya saat barang dihapus
    }
});


    // Fungsi untuk setel ulang nomor urutan barang
    function resetNumber() {
        number = 0;
        $('#keranjang tr').each(function() {
            $(this).find('td:first').text(number++);
        });
    }
});

function updateTotal() {
    var total = 0;

    // Loop melalui setiap item di keranjang dan tambahkan harga masing-masing
    $('#keranjang').find('tr').each(function(){
        var quantity = parseInt($(this).find('.qty-input').val()); // Menggunakan kelas untuk input qty
        var price = parseFloat($(this).find('.price').text()); // Menggunakan kelas untuk harga

        // Cetak nilai quantity dan harga untuk debugging
        console.log("Quantity: ", quantity);
        console.log("Price: ", price);

        // Jika nilai quantity atau harga tidak valid, cetak pesan kesalahan
        if(isNaN(quantity) || isNaN(price)) {
            console.log("Error: Quantity or price is not valid.");
            return; // Menghentikan iterasi loop jika ada nilai yang tidak valid
        }

        total += quantity * price;
    });

    // Tampilkan total harga di elemen dengan id 'total'
    $('#total').val(total.toFixed(2)); // Menggunakan toFixed(2) untuk menampilkan dua angka di belakang koma
}
</script>