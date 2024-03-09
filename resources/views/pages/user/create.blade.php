@extends('layout.app')
@section('content')
<h2>Tambah Petugas</h2>
<div class="box box-primary">
    <form method="POST" action="{{ route('user.store') }}">
        <div class="box-header">
            <div class="box-title">Masukkan Data Petugas</div>
        </div>
        <div class="box-body">
            @csrf
    
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
    
            <div class="form-group">
                <label for="name">Nama</label>
                <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" autocomplete="name" autofocus required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" id="password" name="password" autocomplete="new-password" autofocus required>
            </div>
            <div class="form-group">
                <label for="password-confirm">Konfirmasi Password</label>
                <input class="form-control" type="password" id="password-confirm" name="password_confirmation" autocomplete="new-password" autofocus required>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    
</div>
@endsection