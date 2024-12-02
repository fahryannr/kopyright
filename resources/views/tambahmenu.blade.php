@extends('parent.parent')
@section('title', 'Kelola Menu')

<style>
    body {
        background-color: #1a1a1a;
        color: #e0e0e0;
        font-family: Arial, sans-serif;
    }
    .con-1 {
        max-width: 800px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #2a2a2a;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .form-label {
        color: #ffffff;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
    .form-control {
        background-color: #3a3a3a;
        border: 1px solid #4a4a4a;
        color: #e0e0e0;
        padding: 0.75rem;
        border-radius: 4px;
        width: 100%;
    }
    .form-control:focus {
        background-color: #3a3a3a;
        border-color: #5a5a5a;
        color: #e0e0e0;
        box-shadow: 0 0 0 0.2rem rgba(90, 90, 90, 0.25);
    }
    .btn {
        background-color: #E9DCBE;
        border-color: #4a4a4a;
        color: #1a1a1a;
        padding: 0.75rem 1.5rem;
        font-weight: bold;
        transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
    }
    .btn:hover {
        background-color: #8E8B82;
        border-color: #5a5a5a;
        color: #ffffff;
    }
    .custom-label {
        font-size: 0.9rem;
    }
    .table {
        margin-top: 2rem;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .img-thumbnail {
        max-width: 100px;
        height: auto;
    }
</style>

@section('content')

<div class="container-fluid py-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

<div class="container con-1">
    <form action="/tambahmenu" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container m-1">
            <h2 class="mb-4 text-center">Tambah Menu</h2>
            <div class="mb-3">
                <label for="nama" class="form-label custom-label">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label custom-label">Harga</label>
                <input type="number" name="harga" class="form-control" id="harga" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label custom-label">Foto</label>
    <input type="file" name="foto" class="form-control" id="foto" required>
            </div>
            <div class="mb-3">
                <label for="kategori_id" class="form-label custom-label">Kategori</label>
                <select name="kategori_id" class="form-control" id="kategori_id" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($kat as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-secondary">Simpan</button>
        </div>
    </form>
</div>

<div class="container">
    <div class="table-responsive p-1">
        <table class="table table-dark table-striped table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th class="">Harga</th> <!-- Sembunyikan kolom ini di layar kecil -->
                    <th class="d-none d-md-table-cell">Kategori</th> <!-- Sembunyikan kolom ini di layar kecil -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tmenu as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item -> nama}}</td>
                    <td class="">{{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td class="d-none d-md-table-cell">{{ $item->kategori->nama }}</td> <!-- Sembunyikan kolom ini di layar kecil -->
                    <td>
                        <a href="/menup/{{$item->id}}" class="btn btn-info btn-sm">Edit</a>
                        <form action="{{ url('menhap/'.$item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection