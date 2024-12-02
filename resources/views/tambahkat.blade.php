@extends('parent.parent')
@section('title', 'Kelola Kategori')


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
        color: #ffffff;
        padding: 0.75rem 1.5rem;
        font-weight: bold;
        transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
    }
    .btn:hover {
        background-color: #8E8B82;
        border-color: #5a5a5a;
    }

    .custom-label {
    font-size: 0.9rem; /* Atur ukuran font sesuai kebutuhan */
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
<form action="/tambahkat" method="POST">
    @csrf
    <div class="container m-2">
        <h2 class="mb-4 text-center">Tambah Kategori</h2>
        <div class="mb-3">
            <label for="nama" class="form-label form-label-sm">Nama Kategori</label>
            <input type="text" name="nama" class="form-control" id="nama" required>
        </div>
        <button type="submit" class="btn btn-secondary">Simpan</button>
    </div>
</form>
</div>


<div class="container">
    <div class="table-responsive p-2">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tamkat as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->nama}}</td>
                    <td>
                        <a href="/katup/{{$item->id}}" class="btn btn-info btn-sm">Edit</a>
                        <form action="{{ url('kathap/'.$item->id) }}" method="POST" style="display:inline;">
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