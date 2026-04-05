<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tentang</title>
    @vite(['resources/css/app.css'])

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

<!-- ISI TENTANG -->
<section class="bg-white py-24 px-6 text-center">

    <h2 class="text-4xl font-bold mb-8">
        Tentang Pelaporan Online
    </h2>

    <div class="max-w-3xl mx-auto text-gray-600 leading-relaxed text-lg space-y-6">

        <p>
            <span class="font-semibold text-black">E-Report</span> adalah sistem pelaporan 
            kerusakan fasilitas umum berbasis web untuk memudahkan warga Sindang 
            melaporkan kerusakan fasilitas umum seperti jalan berlubang, lampu mati, 
            drainase tersumbat, atau kerusakan lainnya.
        </p>

        <p>
            Setiap laporan akan diverifikasi oleh admin desa dan diteruskan ke instansi terkait 
            untuk segera ditindaklanjuti. Laporkan, pantau, dan bersama-sama wujudkan 
            infrastruktur yang lebih baik!
        </p>

    </div>

</section>


</body>
</html>