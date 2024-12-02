@extends('parent.parent')

@section('title', 'Home')

@section('content')

<style>
    .baner {
        background-image: url('storage/foto/b.jpg'); 
        background-size: cover; 
        background-position: center; 
        height: 60vh; 
    }

    .text {
    font-weight: bold; /* Menggunakan font-weight untuk membuat teks lebih tebal */
    font-size: 3rem; /* Ukuran font yang lebih besar */
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7); /* Menambahkan bayangan pada teks */
    letter-spacing: 9px; /* Menambah jarak antar huruf */
    text-transform: uppercase; /* Mengubah teks menjadi huruf kapital */
    color: #ffcc00; /* Warna teks */
}

    .kami {
        background-color: #2a2a2a;
        color: black;
    }

    .kategori-makanan {
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('storage/foto/makanan.jpg');
        background-size: contain;
        background-position: center;
        height: 200px;
        color: white;
    }

    .kategori-minuman {
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('storage/foto/minuman.jpg');
        background-size: contain;
        background-position: center;
        height: 200px;
        color: white;
    }

    .kategori-sarapan {
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('storage/foto/sarapan.jpg');
        background-size: contain;
        background-position: center;
        height: 200px;
        color: white;
    }

    .no-dekor {
        text-decoration: none;
        color: white;
    }

    .kategori {
        transition: transform 0.3s ease, box-shadow 0.3s ease, background-size 0.3s ease;
    }

    .kategori:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        background-size: 110%;
    }

    .kategori h4 a {
        transition: color 0.3s ease;
    }

    .kategori:hover h4 a {
        color: #ffcc00;
    }

    /* Footer Styles */
    .footer {
        background-color: #0000;
        color: white;
        padding: 20px 0;
        text-align: center;
    }

    .footer a {
        color: white;
        margin: 0 10px;
        font-size: 24px;
        transition: color 0.3s ease;
    }

    .footer a:hover {
        color: #ffcc00;
    }

    .footer-logo {
        margin-bottom: 10px;
        font-size: 20px;
    }

</style>

    <!-- Banner Section -->
    <div class="container-fluid baner d-flex align-items-center">
        <div class="container text-center text-white text">
            <h1>Selamat Datang di kopyright</h1>
            <div class="col-md-8 offset-md-2"></div>
        </div>
    </div>

    <!-- Highlight Kategori Section -->
    <div class="container-fluid py-5 konten">
        <div class="container text-center">
            <h3>Menu Spesial</h3>
            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <div class="higlighted-kategori kategori-makanan d-flex justify-content-center align-items-center kategori">
                        <h4><a href="{{'/menu'}}" class="no-dekor">Makanan</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="higlighted-kategori kategori-minuman d-flex justify-content-center align-items-center kategori">
                        <h4><a href="{{'/menu'}}" class="no-dekor">Minuman</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="higlighted-kategori kategori-sarapan d-flex justify-content-center align-items-center kategori">
                        <h4><a href="{{'/menu'}}" class="no-dekor">Sarapan</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tentang Kami Section -->
    <div class="container-fluid py-5 kami">
        <div class="container text-center text-white">
            <h3>Tentang Kami</h3>
            <p>Kopyright berdiri pada tahun 2022, cafe ini menjadi tempat tongkrongan populer anak muda dari sejak mulai berdiri sampai kini. Meski sudah berdiri sejak 2 tahun yang lalu kopyright tetap eksis hingga sekarang, karna terletak di tempat yang strategis dan juga dekat dengan lingkungan mahasiswa yang membuat kopyright tidak pernah sepi setiap harinya </p>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <div class="footer-logo">Follow Us</div>
            <a href="https://www.instagram.com/kopyright.co?igsh=dGgwb2pwbm1raTRn" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me/+6282277506600" target="_blank"><i class="fab fa-whatsapp"></i></a>
            <p class="mt-2">Daily open: 10:00-23:00 | Jl.Balamsakti, Panam, Pku</p>
            <p class="mt-2">© 2022 kopyright. All Rights Reserved.</p>
        </div>
    </footer>

<!-- Menambahkan Font Awesome untuk ikon -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

@endsection
