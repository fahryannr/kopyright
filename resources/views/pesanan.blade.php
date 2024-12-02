@extends('parent.parent')

@section('title', 'Pesanan')

@section('content')

<div class="container-fluid py-4">
    <h1 class="mb-4">Pesanan Anda</h1>
    @foreach ($pesan as $item)
        <div class="card bg-dark text-light mb-3" id="pesanan-{{ $item->id }}">
            <div class="card-body">
                <h5 class="card-title">Nama Pemesan: {{ $item->namaPemesan }}</h5>
                <p>Daftar Pesanan: {{$item->daftarPesanan}}</p>
                <p>Total Harga: Rp. {{ number_format($item->totalHarga, 0, ',', '.') }}</p>
                <div class="d-flex align-items-center">
                    <div id="status-pesanan-{{ $item->id }}" class="me-2">
                        @if ($item->status == 'confirmed')
                            <strong class="text-info">Pesanan Sedang Disiapkan</strong>
                        @else
                            <!-- Form untuk konfirmasi pesanan -->
                            <form action="{{ route('pesanan.konfirmasi', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Konfirmasi</button>
                            </form>
                        @endif
                    </div>
                    <!-- Form untuk menghapus pesanan -->
                    <form action="{{ url('pesanan/'.$item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Selesai</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if(session('success'))
    <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="konfirmasiModalLabel">{{ session('success') }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Pesanan Sedang Disiapkan, jangan lupa tekan tombol selesai ya jika sudah siap dihidangkan</p>
                </div>
                <div class="modal-footer">
                    <button id="tutupModalBtn" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successModal = new bootstrap.Modal(document.getElementById('konfirmasiModal'));
            successModal.show(); // Tampilkan modal setelah halaman selesai dimuat
        });
    </script>
@endif


@endsection
