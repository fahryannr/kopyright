@extends('parent.parent')
@section('title', 'Edit Menu')


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

<div class="container con-1">
    <form action="/menuedit/{{$update->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="container m-1">
            <h2 class="mb-4 text-center">Edit Menu</h2>
            <div class="mb-3">
                <label for="nama" class="form-label custom-label">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" value="{{ $update->nama }}" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label custom-label">Harga</label>
                <input type="number" name="harga" class="form-control" id="harga" value="{{ $update->harga}}" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label custom-label">Foto</label>
                <input type="file" name="foto" class="form-control" id="foto" value="" required>
            </div>
            <div class="mb-3">
                <label for="kategori_id" class="form-label custom-label">Kategori</label>
                <select name="kategori_id" class="form-control" id="kategori_id" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ $update->kategori_id == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-secondary">Simpan</button>
        </div>
    </form>
</div>

@endsection