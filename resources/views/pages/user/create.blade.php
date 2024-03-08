<form method="POST" action="{{route('user')}}>">
    @csrf
    <label for="name">Nama:</label>
    <input type="text" id="name" name="name">
    {{-- Tambahkan input untuk atribut lainnya --}}
    <button type="sumbit">Simpan</button>
    <form>