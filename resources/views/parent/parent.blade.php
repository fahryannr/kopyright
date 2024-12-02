<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #121212; /* Warna gelap untuk latar belakang */
            color: #e0e0e0; /* Warna teks terang */
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #1f1f1f; /* Warna sidebar */
            padding-top: 20px;
            transition: all 0.3s;
            z-index: 1000;
        }
        .sidebar-header {
            padding: 10px 15px;
            text-align: center;
        }
        .sidebar-header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .sidebar-menu {
            padding: 0;
            list-style: none;
        }
        .sidebar-menu li {
            margin-bottom: 10px;
        }
        .sidebar-menu a {
            display: block;
            padding: 10px 15px;
            color: #b0b0b0; /* Warna teks menu */
            text-decoration: none;
            transition: all 0.3s;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: #3a3a3a; /* Warna latar belakang saat hover */
            color: #ffffff; /* Warna teks saat hover */
        }
        .sidebar-menu i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        .content-wrapper {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
        }
        .toggle-btn {
            position: fixed;
            left: 10px;
            top: 10px;
            z-index: 1001;
            background-color: #3a3a3a; /* Warna tombol toggle */
            color: #ffffff; /* Warna teks tombol */
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .content-wrapper {
                margin-left: 0;
            }
            .toggle-btn {
                display: block;
            }
        }
    </style>
</head>
<body>
    <button class="toggle-btn" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="storage/foto/kopyright.jpg" alt="Logo">
        </div>
        <ul class="sidebar-menu">
            <li><a href="/" class="{{ Request::is('/') ? 'active' : '' }}"><i class="fas fa-home"></i> <span>Home</span></a></li>

            @if(Auth::check() && Auth::user()->peran->name === 'kasir')
    <li><a href="/pengelolaan" class="{{ Request::is('pengelolaan') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> <span>Pengelolaan</span></a></li>
@endif



            <li><a href="/menu" class="{{ Request::is('menu') ? 'active' : '' }}"><i class="fas fa-utensils"></i> <span>Daftar Menu</span></a></li>
            <li>
                @if(Auth::check() && Auth::user()->peran->name === 'kasir')
    <a href="/pesanan" class="{{ Request::is('pesanan') ? 'active' : '' }}">
        <i class="fas fa-shopping-cart"></i> 
        <span>Pesanan</span>
        <span class="badge bg-danger" id="pesananBadge" style="display: none;">0</span>
    </a>
@endif

            <li><a href="/logout"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
        </ul>
    </div>

    <div class="content-wrapper" id="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const sidebarToggle = document.getElementById('sidebarToggle');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                if (window.innerWidth > 768) {
                    content.style.marginLeft = sidebar.classList.contains('active') ? '250px' : '0';
                }
            });

            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.add('active');
                    content.style.marginLeft = '250px';
                } else {
                    sidebar.classList.remove('active');
                    content.style.marginLeft = '0';
                }
            });

            // Initial check
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('active');
                content.style.marginLeft = '0';
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
