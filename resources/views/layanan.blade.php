<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Layanan</title>
    @vite(['resources/css/app.css'])
</head>

<!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-[Poppins]">

<!-- TOP BAR -->
<div class="bg-[#A8DADC] text-center text-xs py-1 tracking-wide">
    LAPOR KERUSAKAN FASILITAS UMUM
</div>

<!-- HEADER -->
<div class="bg-white text-center py-6 shadow-sm">
    <h1 class="text-5xl font-bold tracking-tight">
        E-Report<span class="text-blue-600">.</span>
    </h1>
    



<!-- NAVBAR -->
<div class="bg-[#A8DADC] relative py-3 shadow">

    <!-- MENU TENGAH -->
    <div class="flex justify-center gap-10 font-semibold text-sm tracking-wide">

        <a href="{{ url('/') }}"
           class="{{ request()->is('/') ? 'text-red-500 border-b-2 border-red-500 pb-1' : 'hover:text-blue-600' }}">
            BERANDA
        </a>

        <a href="{{ url('/layanan') }}"
           class="{{ request()->is('layanan') ? 'text-red-500 border-b-2 border-red-500 pb-1' : 'hover:text-blue-600' }}">
            LAYANAN
        </a>

        <a href="{{ url('/tentang') }}"
           class="{{ request()->is('tentang') ? 'text-red-500 border-b-2 border-red-500 pb-1' : 'hover:text-blue-600' }}">
            TENTANG
        </a>

    </div>

    <!-- BUTTON KANAN -->
    <div class="absolute right-10 top-1/2 transform -translate-y-1/2">
        @auth
            <a href="/dashboard"
               class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-full shadow transition">
                Dashboard
            </a>
        @else
            <a href="/login"
               class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-full shadow transition">
                Masuk / Daftar
            </a>
        @endauth
    </div>

</div>

<!-- ISI LAYANAN -->
<section class="bg-white py-16 px-10">

    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold mb-2">
            Layanan Pelaporan Online
        </h2>
        <p class="text-gray-500">
            Laporkan, pantau, dan wujudkan fasilitas yang lebih baik
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-8 text-center">

        <div class="p-6 rounded-xl shadow">
            <div class="text-4xl mb-3">📩</div>
            <h3 class="font-bold text-lg mb-2">Pelaporan Online</h3>
            <p class="text-gray-600 text-sm">
                Laporkan kerusakan fasilitas umum dengan mudah.
            </p>
        </div>

        <div class="p-6 rounded-xl shadow">
            <div class="text-4xl mb-3">🔔</div>
            <h3 class="font-bold text-lg mb-2">Notifikasi Pelaporan</h3>
            <p class="text-gray-600 text-sm">
                Dapatkan update status laporan secara otomatis.
            </p>
        </div>

        <div class="p-6 rounded-xl shadow">
            <div class="text-4xl mb-3">📄</div>
            <h3 class="font-bold text-lg mb-2">Informasi Pelaporan</h3>
            <p class="text-gray-600 text-sm">
                Lihat semua laporan secara transparan.
            </p>
        </div>

    </div>

</section>

</body>
</html>