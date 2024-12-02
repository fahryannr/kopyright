<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Warna latar belakang */
            color: #212529; /* Warna teks */
        }

        .container-fluid {
            margin-top: 20px;
        }

        h1 {
            text-align: center; /* Rata tengah judul */
            margin-bottom: 20px;
        }

        table {
            width: 100%; /* Menggunakan lebar penuh */
            border-collapse: collapse; /* Menghapus jarak antara border */
            margin-top: 20px; /* Margin atas untuk jarak dari elemen lain */
        }

        th, td {
            padding: 12px; /* Ruang dalam sel */
            text-align: left; /* Rata kiri teks dalam sel */
            border: 1px solid #dee2e6; /* Border antara sel */
        }

        th {
            background-color: #007bff; /* Warna latar belakang header */
            color: white; /* Warna teks header */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Warna latar belakang baris genap */
        }

        tr:hover {
            background-color: #e9ecef; /* Warna latar belakang saat hover */
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <h1 class="mb-4">Laporan Penjualan</h1>
    
        <table class="table">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Nama Pemesan</th>
                    <th>Daftar Pesanan</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Tanggal Konfirmasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($export as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->namapemesan }}</td>
                        <td>{{ $item->daftarpesanan }}</td>
                        <td>Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->updated_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
