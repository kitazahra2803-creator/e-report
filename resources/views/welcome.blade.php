<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Report - Lapor Kerusakan Fasilitas Umum</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- TOP BAR -->
    <div class="bg-[#A8DADC] text-center text-xs py-2 tracking-wide font-semibold">
        LAPOR KERUSAKAN FASILITAS UMUM
    </div>

    <!-- NAVBAR -->
    <div class="bg-white shadow-md sticky top-0 z-40">
        <div class="container mx-auto px-6 py-4">
            <!-- LOGO DI TENGAH -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo_e-report.png') }}" 
                     alt="Logo E-Report" 
                     class="h-16 w-auto">
            </div>
            
            <!-- MENU DAN TOMBOL -->
            <div class="relative w-full max-w-6xl mx-auto px-4">
                <!-- Menu di tengah -->
                <div class="flex justify-center space-x-8">
                    <a href="#beranda" id="menu-beranda" class="text-blue-600 border-b-2 border-blue-600 font-medium pb-1">BERANDA</a>
                    <a href="#layanan" id="menu-layanan" class="text-gray-700 hover:text-blue-600 font-medium pb-1">LAYANAN</a>
                    <a href="#tentang" id="menu-tentang" class="text-gray-700 hover:text-blue-600 font-medium pb-1">TENTANG</a>
                </div>

                <!-- Tombol kanan -->
                <div class="absolute right-0 top-1/2 transform -translate-y-1/2">
                    @auth
                        <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-600">Halo, {{ Auth::user()->name }}</span>
                    @else
                        <a href="/register"
                           class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-full shadow transition">
                            Masuk/Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== BERANDA SECTION (DENGAN BACKGROUND GAMBAR) ==================== -->
    <section id="beranda" class="scroll-mt-32 relative">
        <!-- BACKGROUND GAMBAR -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/kecamatan.jpeg') }}" 
                 alt="Background Kecamatan Sindang" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/50"></div>
        </div>
        
        <!-- KONTEN BERANDA -->
        <div class="relative z-10">
            <!-- HERO SECTION -->
            <div class="py-20">
                <div class="container mx-auto px-6 text-center">
                    
                </div>
            </div>

            <!-- KECAMATAN SECTION -->
            <div class="container mx-auto px-6 py-16">
                <div class="rounded-2xl shadow-lg p-8 text-center">
                </div>
            </div>

            <!-- TOMBOL LAPOR -->
            <div class="container mx-auto px-6 pb-16 text-center">
                @guest
                    <a href="{{ route('register') }}" class="inline-block bg-blue-600 text-white px-12 py-4 rounded-full text-xl font-bold hover:bg-red-700 shadow-lg">
                        LAPOR
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="inline-block bg-blue-600 text-white px-12 py-4 rounded-full text-xl font-bold hover:bg-red-700 shadow-lg">
                        LAPOR
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <!-- ==================== LAYANAN SECTION ==================== -->
    <section id="layanan" class="scroll-mt-32 bg-gray-100 py-16">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">LAYANAN</h1>
                <p class="text-gray-600 mt-4 text-lg">Pelaporan Online</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Pelaporan Online</h3>
                    <p class="text-gray-600">Melalui pelaporan online, Anda dapat dengan mudah melaporkan kerusakan fasilitas umum yang terjadi di Kecamatan Sindang.</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Notifikasi Pelaporan</h3>
                    <p class="text-gray-600">Ingin tahu status pelaporan? Cek saja di pelaporan online! Pelapor bisa dapat notifikasi otomatis.</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Informasi Pelaporan</h3>
                    <p class="text-gray-600">Publik bisa tahu pelaporan yang ada, baik itu dari proses sampai dengan status pelaporan selesai.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== TENTANG SECTION ==================== -->
    <section id="tentang" class="scroll-mt-32 py-16">
        <div class="container mx-auto px-6">
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">Tentang E-Report</h1>
                    <div class="w-24 h-1 bg-blue-600 mx-auto"></div>
                </div>
                
                <div class="max-w-3xl mx-auto">
                    <p class="text-gray-700 text-lg leading-relaxed mb-6">
                        <span class="font-bold text-blue-600">E-Report</span> adalah sistem pelaporan kerusakan fasilitas umum berbasis web untuk memudahkan warga Sindang melaporkan kerusakan fasilitas umum seperti jalan berlubang, lampu mati, drainase tersumbat, atau kerusakan lainnya.
                    </p>
                    
                    <p class="text-gray-700 text-lg leading-relaxed mb-8">
                        Setiap laporan akan diverifikasi oleh admin desa dan diteruskan ke instansi terkait untuk segera ditindaklanjuti. Laporkan, pantau, dan bersama-sama wujudkan infrastruktur yang lebih baik!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-blue-600 text-white text-center py-4 mt-8">
        © 2026 E-Report Kecamatan Sindang
    </footer>

    <!-- SCRIPT UNTUK GARIS BAWAH BERPINDAH SAAT SCROLL -->
    <script>
        const menuBeranda = document.getElementById('menu-beranda');
        const menuLayanan = document.getElementById('menu-layanan');
        const menuTentang = document.getElementById('menu-tentang');
        
        const sectionBeranda = document.getElementById('beranda');
        const sectionLayanan = document.getElementById('layanan');
        const sectionTentang = document.getElementById('tentang');

        function removeActiveClass() {
            menuBeranda.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
            menuBeranda.classList.add('text-gray-700');
            menuLayanan.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
            menuLayanan.classList.add('text-gray-700');
            menuTentang.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
            menuTentang.classList.add('text-gray-700');
        }

        function setActiveMenu(menu) {
            menu.classList.remove('text-gray-700');
            menu.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
        }

        window.addEventListener('scroll', function() {
            let scrollPosition = window.scrollY + 150;
            let berandaTop = sectionBeranda.offsetTop;
            let layananTop = sectionLayanan.offsetTop;
            let tentangTop = sectionTentang.offsetTop;
            
            if (scrollPosition >= berandaTop && scrollPosition < layananTop) {
                removeActiveClass();
                setActiveMenu(menuBeranda);
            }
            else if (scrollPosition >= layananTop && scrollPosition < tentangTop) {
                removeActiveClass();
                setActiveMenu(menuLayanan);
            }
            else if (scrollPosition >= tentangTop) {
                removeActiveClass();
                setActiveMenu(menuTentang);
            }
        });
        
        window.dispatchEvent(new Event('scroll'));
    </script>

</body>
</html>