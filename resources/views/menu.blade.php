@extends('parent.parent')

@section('title', 'Menu')

@section('content')
<div class="container-fluid py-4">
    <h1 class="mb-4">Order Makanan/Minuman</h1>

    <!-- Modal untuk menampilkan pesanan -->
    <div class="modal fade" id="pesananModal" tabindex="-1" aria-labelledby="pesananModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="pesananModalLabel">Detail Pesanan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Daftar Pesanan:</h6>
                    <ul id="pesananList" class="list-group bg-dark text-light">
                        <!-- Pesanan akan ditambahkan di sini -->
                    </ul>
                    <h6 class="mt-3">Total Harga:</h6>
                    <p id="modalTotalHarga" class="fw-bold">Rp. 0</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk notifikasi proses pesanan -->
    <div class="modal fade" id="prosesModal" tabindex="-1" aria-labelledby="prosesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="prosesModalLabel">Proses Pesanan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Pesanan Anda sedang diproses, harap tunggu...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <h2 class="mb-3">Menu:</h2>
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control bg-dark text-light" placeholder="Cari nama atau kategori menu...">
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="menuContainer">
                @foreach ($menu as $item)
                    <div class="col menu-item" data-category="{{ $item->kategori->nama }}">
                        <div class="card h-100 bg-dark text-light">
                            <img src="{{ asset('foto/'.$item->foto) }}" alt="{{ $item->nama }}" class="card-img-top mx-auto d-block" style="object-fit: cover; height: 200px;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->nama }}</h5>
                                <p class="card-text">Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
                                <button class="btn btn-primary btn-sm" onclick="tambahPesanan('{{ $item->nama }}', {{ $item->harga }})">Pesan</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
            <h2 class="mb-3">Input Pesanan</h2>
            <form id="pesananForm" action="/pesanan" method="POST" onsubmit="showProsesModal(event)">
                @csrf
                <div class="mb-3">
                    <label for="namaPemesan" class="form-label">Nama Pemesan</label>
                    <input type="text" class="form-control bg-dark text-light" id="namaPemesan" name="namaPemesan" required>
                </div>
                <div class="mb-3">
                    <label for="daftarPesanan" class="form-label">Daftar Pesanan</label>
                    <textarea class="form-control bg-dark text-light" id="daftarPesanan" rows="5" readonly></textarea>
                </div>
                <div class="mb-3">
                    <label for="totalHarga" class="form-label">Total Harga</label>
                    <input type="text" class="form-control bg-dark text-light" id="totalHarga" name="totalHarga" readonly>
                </div>
                <input type="hidden" id="inputDaftarPesanan" name="daftarPesanan">
                <input type="hidden" id="inputTotalHarga" name="totalHarga">
                <button type="submit" class="btn btn-success" id="prosesPesananBtn" disabled>Proses Pesanan</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Pencarian berdasarkan nama atau kategori
    document.getElementById('searchInput').addEventListener('input', function () {
        const searchQuery = this.value.toLowerCase();
        const menuItems = document.querySelectorAll('.menu-item');

        menuItems.forEach(item => {
            const itemName = item.querySelector('.card-title').textContent.toLowerCase();
            const itemCategory = item.getAttribute('data-category').toLowerCase();

            if (itemName.includes(searchQuery) || itemCategory.includes(searchQuery)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Array untuk menyimpan pesanan
    let pesanan = [];
    let totalHarga = 0;

    function tambahPesanan(nama, harga) {
        // Tambahkan pesanan ke array
        pesanan.push({ nama, harga });
        totalHarga += harga;

        // Tampilkan nama dan harga pesanan
        alert(`Anda telah memesan: ${nama} - Rp. ${harga.toLocaleString('id-ID')}`);

        // Perbarui field daftar pesanan
        updateDaftarPesanan();

        // Enable the "Proses Pesanan" button if there are items
        document.getElementById('prosesPesananBtn').disabled = pesanan.length === 0;

        // Tampilkan modal dengan daftar pesanan
        tampilkanModalPesanan();
    }

    function updateDaftarPesanan() {
    const daftarPesananField = document.getElementById('daftarPesanan');
    const inputDaftarPesanan = document.getElementById('inputDaftarPesanan');
    const inputTotalHarga = document.getElementById('inputTotalHarga');

    // Reset field daftar pesanan
    daftarPesananField.value = '';

    // Bangun string daftar pesanan
    let daftarPesanan = '';
    pesanan.forEach((item) => {
        daftarPesanan += `${item.nama} - Rp. ${item.harga.toLocaleString('id-ID')}\n`;
    });

    // Perbarui field terkait
    daftarPesananField.value = daftarPesanan.trim();
    inputDaftarPesanan.value = daftarPesanan.trim(); // Hidden input
    inputTotalHarga.value = totalHarga; // Hidden total harga
    document.getElementById('totalHarga').value = `Rp. ${totalHarga.toLocaleString('id-ID')}`; // Visible total harga
}


    function hapusPesanan(index) {
    // Hapus item dari pesanan
    totalHarga -= pesanan[index].harga;
    pesanan.splice(index, 1); // Hapus item berdasarkan index

    // Perbarui daftar pesanan dan total harga
    updateDaftarPesanan();

    // Disable button jika pesanan kosong
    document.getElementById('prosesPesananBtn').disabled = pesanan.length === 0;

    // Render ulang daftar pesanan di modal
    tampilkanModalPesanan(true); // Tambahkan argumen untuk mencegah modal tertutup
}


function tampilkanModalPesanan(keepOpen = false) {
    const pesananList = document.getElementById('pesananList');
    const modalTotalHarga = document.getElementById('modalTotalHarga');

    // Kosongkan daftar sebelumnya
    pesananList.innerHTML = '';

    // Tambahkan item pesanan ke modal
    pesanan.forEach((item, index) => {
        const li = document.createElement('li');
        li.className = 'list-group-item bg-dark text-light border-light';
        li.innerHTML = `
            ${item.nama} - Rp. ${item.harga.toLocaleString('id-ID')}
            <button class="btn btn-danger btn-sm float-end" onclick="hapusPesanan(${index})">Hapus</button>
        `;
        pesananList.appendChild(li);
    });

    // Perbarui total harga di modal
    modalTotalHarga.textContent = `Rp. ${totalHarga.toLocaleString('id-ID')}`;

    // Tampilkan atau pertahankan modal
    if (!keepOpen) {
        const modal = new bootstrap.Modal(document.getElementById('pesananModal'));
        modal.show();
    }
}


    function showProsesModal(event) {
        event.preventDefault(); // Mencegah pengiriman formulir default

        // Tampilkan modal proses
        const modal = new bootstrap.Modal(document.getElementById('prosesModal'));
        modal.show();

        // Kirim formulir setelah modal ditampilkan
        setTimeout(() => {
            document.getElementById('pesananForm').submit();
        }, 2000); // Tunggu 2 detik sebelum mengirim formulir
    }
</script>
@endsection
