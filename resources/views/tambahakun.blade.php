@extends('parent.parent')
@section('title', 'Kelola Akun')

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
        font-size: 0.9rem;
    }
    .text-danger {
        margin-top: 0.25rem;
        font-size: 0.875rem;
    }
</style>

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container con-1">
    <form action="/tambahakun" method="POST">
        @csrf
        <h2 class="mb-4 text-center">Buat Akun</h2>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" required>
            @error('username')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <div class="mb-3">
            <label for="validasiPassword" class="form-label">Konfirmasi Password</label>
            <input type="password" name="validasiPassword" class="form-control" id="validasiPassword" required>
            @error('validasiPassword')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="role_id" class="form-label custom-label">Kategori Akun</label>
            <select name="role_id" class="form-control" id="role" required>
                <option value="">Pilih Kategori</option>
                @foreach ($role as $roles)
                    <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-secondary">Simpan</button>
    </form>
</div>

<div class="container">
    <div class="table-responsive p-2">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tamakun as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->username }}</td>
                    <td>
                        @foreach ($role as $roleItem)
                            @if ($roleItem->id == $item->role_id)
                                {{ $roleItem->name }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <form action="{{ url('akun/'.$item->id) }}" method="POST" style="display:inline;">
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
