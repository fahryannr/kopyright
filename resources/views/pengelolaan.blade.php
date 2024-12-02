@extends('parent.parent')
@section('title', 'Pengelolaan')


@section('content')


<style>
.card {
    background-color: #2a2a2a;
    border: none;
    margin-bottom: 20px;
    transition: transform 0.3s ease-in-out;
}
.card:hover {
    transform: translateY(-5px);
}
.card-body {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 200px;
}
.card-title {
    color: #ffffff;
    font-weight: bold;
    margin-top: 15px;
}
.card-icon {
    font-size: 3rem;
    color: #4a4a4a;
}

.card-body:hover h5 {
        color: #ffcc00;
        transition: color 0.3s ease; /* Transisi smooth saat warna berubah */
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <a href="/tambahmenu"><i class="bi bi-plus-circle card-icon"></i></a>
                    <h5 class="card-title">Kelola Menu</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                   <a href="/tambahkat"> <i class="bi bi-folder-plus card-icon"></i></a>
                    <h5 class="card-title">Kelola Kategori</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                   <a href="/tambahakun"> <i class="bi bi-person-plus card-icon"></i></a>
                    <h5 class="card-title">Kelola Akun</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                   <a href="/laporan"><i class="bi bi-file-earmark-text card-icon"></i></a>
                    <h5 class="card-title">Laporan Penjualan</h5>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection