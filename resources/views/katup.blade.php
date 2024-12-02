@extends('parent.parent')
@section('title', 'Edit Kategori')


<style>
    body {
        background-color: #1a1a1a;
        color: #e0e0e0;
        font-family: Arial, sans-serif;
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


<div class="container">
    <form action="/katedit/{{$update->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="container m-2">
            <h2 class="mb-4 text-center">Ubah Kategori</h2>
            <div class="mb-3">
                <label for="nama" class="form-label form-label-sm">Nama Kategori</label>
                <input type="text" name="nama" class="form-control" id="nama" value="{{ $update->nama }}" required>
            </div>
            <button type="submit" class="btn btn-secondary">Simpan</button>
        </div>
    </form>
</div>




@endsection