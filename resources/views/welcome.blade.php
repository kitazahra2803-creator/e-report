<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Report</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FONT (BIAR MIRIP FIGMA) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-[Poppins]">

<!-- TOP BAR -->
<div class="bg-[#A8DADC] text-center text-xs py-1 tracking-wide">
    LAPOR KERUSAKAN FASILITAS UMUM
</div>

<!-- HEADER TITLE -->
<div class="bg-white text-center py-6 shadow-sm">
    <h1 class="text-5xl font-bold tracking-tight">
        E-Report<span class="text-blue-600">.</span>
    </h1>

    <div class="mt-2">
        <span class="bg-blue-600 text-white px-4 py-1 rounded-full text-sm shadow">
            Kec. Sindang
        </span>
    </div>
</div>

<!-- NAVBAR -->
<div class="bg-[#A8DADC] relative flex items-center px-12 py-3 shadow">

    <!-- MENU (DITENGAH) -->
    <div class="absolute left-1/2 transform -translate-x-1/2 flex gap-10 font-semibold text-sm tracking-wide">

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

    <!-- BUTTON (KANAN) -->
    <div class="ml-auto">
        @auth
            <a href="/dashboard"
               class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-full shadow transition">
                Dashboard
            </a>
        @else
            <a href="/login"
               class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-full shadow transition">
                Masuk/Daftar
            </a>
        @endauth
    </div>

</div>

</div>

</div>

<!-- HERO -->
<div class="relative h-[85vh] overflow-hidden">

    <!-- IMAGE -->
    <img src="{{ asset('images/kecamatan.jpeg') }}"
         class="absolute inset-0 w-full h-full object-cover scale-105">

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-black/30 backdrop-blur-[2px]"></div>

    <!-- CONTENT -->
    <div class="absolute inset-0 flex flex-col justify-end items-center text-center text-white pb-20">
        <a href="/reports/create"
           class="bg-blue-500 hover:bg-blue-600 px-12 py-4 rounded-full text-lg font-semibold shadow-2xl transition transform hover:scale-105">
            Lapor
        </a>

    </div>

</div>

<!-- FITUR -->
<section class="px-16 py-14 bg-white">
</section>

<!-- FOOTER -->
<footer class="bg-blue-600 text-white text-center py-4">
    © 2026 E-Report Kecamatan Sindang
</footer>

</body>
</html>