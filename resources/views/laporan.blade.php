@extends('parent.parent')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="mb-4">Laporan Penjualan Mingguan</h1>
        </div>
        <div class="col-md-6 text-md-end">
            <button class="btn btn-success me-2" onclick="exportToExcel()">
                <i class="fas fa-file-excel me-2"></i>Export ke Excel
            </button>
            <a href="/export-pdf" class="btn btn-danger">
                <i class="fas fa-file-pdf me-2"></i>Export ke PDF
            </a>
        </div>
    </div>

    <div class="card shadow bg-dark">
        <div class="card-body">
            <div class="table-responsive">
                <table id="salesTable" class="table table-dark table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Nomor Pesanan</th>
                            <th>Nama Pemesan</th>
                            <th>Daftar Pesanan</th>
                            <th>Total Harga</th>
                            <th>Tanggal Konfirmasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalHarga = 0; // Inisialisasi total harga
                        @endphp
                        @foreach ($lapor as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->namapemesan }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#orderModal{{ $item->id }}">
                                        Lihat Pesanan
                                    </button>
                                </td>
                                <td>Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                                <td>{{ $item->updated_at->format('d-m-Y H:i') }}</td>
                            </tr>

                            @php
                                $totalHarga += $item->total; // Tambahkan total harga
                            @endphp

                            <!-- Modal for order details -->
                            <div class="modal fade" id="orderModal{{ $item->id }}" tabindex="-1" aria-labelledby="orderModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-dark text-light">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="orderModalLabel{{ $item->id }}">Daftar Pesanan #{{ $item->id }}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{ $item->daftarpesanan }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Tampilkan Total Harga -->
            <div class="mt-4">
                <h5 class="text-light">Total Pemasukan: Rp. {{ number_format($totalHarga, 0, ',', '.') }}</h5>
                <p class="text text-light">laporan ini akan tereset otomatis seminggu sekali</p>
            </div>
        </div>
    </div>
</div>
@endsection
