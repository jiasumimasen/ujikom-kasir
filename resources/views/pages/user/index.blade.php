@extends('layout.app ')

@section('content')
{{-- <div class="with-border">
    <button class="btn btn-primary mb-2" data-bs-toggle="modal" id="tambahUser"><i class="fas fa-plus mr-1"></i>Tambah
        Pegawai</button>
</div>
<table class="table table-striped data-table">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th width="100px">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<div class="modal fade" id="userModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="userForm" name="userForm" class="form-horizontal">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input name="name" id="name" label="Nama" placeholder="Masukkan nama petugas"
                                    class="form-control @error('name') is-invalid @enderror" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="role" class="control-label">Role</label>
                                <select name="role" id="role" label="Role" class="custom-select">
                                    <option selected disabled>Pilih Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                    <option value="kasir">Kasir</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" id="email" type="email" label="Email" placeholder="Masukkan email petugas"
                            class="form-control @error('email') is-invalid @enderror" />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" id="password" type="password" class="form-control" label="Password"
                            placeholder="Masukkan password" />
                    </div>
                    <button type="submit" class="btn btn-success" id="savedata" value="tambah">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}
<h2>Petugas</h2>
<div class="box box-primary">
    <div class="box-header">
        <div class="box-title">Daftar Petugas</div>
        <div class="box-tools">
            @if (auth()->id() === 1)
            <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah Data</a>
            @endif
        </div>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-hover">
            <tr>
                <th style="width: 10%">No</th>
                <th style="width: 40%">Nama</th>
                <th style="width: 30%">Email</th>
                <th style="width: 20%">Aksi</th>
            </tr>
            @foreach ($pegawai as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>
                    <div class="btn-group">
                        @if (auth()->id() === 1)
                        <form id="delete-form-{{ $item->id }}" action="{{ route('user.destroy', $item->id) }}"
                            method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="#" class="btn btn-danger"
                            onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin menghapus data ini?')) document.getElementById('delete-form-{{ $item->id }}').submit();">
                            <i class="fa fa-trash"></i>
                        </a>
                        @else
                        <!-- Tombol alternatif untuk pengguna dengan ID selain 1 -->
                        <button class="btn btn-secondary"><i class="fa fa-minus"></i></button>
                        @endif

                    </div>
                </td>
                @endforeach
            </tr>
        </table>
    </div>
</div>
@endsection

@section('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        // menampilkan tabel user
        var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          autoWidth: false,
          responsive: true,
          ajax: "{{ route('user') }}",
          columns: [
              {data: 'DT_RowIndex'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'role', name: 'role'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#tambahUser').click(function(){
            $('#savedata').val("tambah-user");
            $('#id').val('');
            $('#userForm').trigger("reset");
            $('#modalHeading').html("Tambah Pegawai");
            $('#userModal').modal('show');

        })

        $('#savedata').click(function (e) {
            e.preventDefault();
            var actionType = $('#savedata').val();
            $('#savedata').html('Simpan');

        $.ajax({
          data: $('#userForm').serialize(),
          url: "{{ route('user') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            Swal.fire(
                '!',
                'Data sukses disimpan!',
                'success'
            )
              $('#userForm').trigger("reset");
              $('#userModal').modal('hide');
              table.ajax.reload();
            },
            error: function (data) {
                console.log('Error:', data);
                toastr.options.progressBar = true;
                toastr.warning('Data tidak valid!');
            }
            });
        })

        $('body').on('click', '.editUser', function(){
            var user_id = $(this).data('id');
            $.get('pegawai' + '/' + user_id + '/' + 'edit' , function(data){
                $('#modalHeading').html("Edit Pegawai");
                $('#savedata').val("edit-pegawai");
                $('#user_id').val(data.id);
                $('#name').val(data.name);
                $('#role').val(data.role);
                $('#email').val(data.email);
                $('#password').val(data.password);
                $('#userModal').modal('show');
            })
        })

        $('body').on('click', '.deleteUser', function () {
            var id = $(this).data("id");
            Swal.fire({
            title: 'Kamu yakin?',
            text: "Anda tidak akan bisa mengembalikannya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed){
                    $.ajax({
                    type: "DELETE",
                    url: "{{ route('user') }}" + '/' + id,
                    success: function(data) {
                        toastr.options.progressBar = true;
                        toastr.success('Data berhasil dihapus!');
                        table.ajax.reload();
                    },
                    error: function (data) {
                    console.log('Error:', data);
                    }
                });
              }
           })
        });
</script>
@stop