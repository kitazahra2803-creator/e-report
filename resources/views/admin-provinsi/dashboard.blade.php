<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Provinsi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-gray-100">

<!-- HEADER -->
<div class="bg-[#7fc8c6] px-8 py-4 shadow">
    <div class="flex justify-between items-center">
        <!-- Kiri: Dashboard Provinsi -->
        <div>
            <h1 class="text-2xl font-bold text-white">Dashboard Provinsi</h1>
            <p class="text-white text-sm">Admin Provinsi</p>
        </div>

        <!-- DROPDOWN USER -->
    <div class="relative">
        <button id="dropdownBtn" class="flex items-center text-white text-sm font-medium focus:outline-none">
            {{ Auth::user()->name }}
            <svg class="ms-2 h-4 w-4 fill-current" viewBox="0 0 20 20">
                <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
            </svg>
        </button>

        <!-- MENU -->
        <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden z-50">
            <a href="{{ route('profile.edit') }}"
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
               Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- LOGO -->
    <img src="{{ asset('images/logo_e-report.png') }}" class="h-10 bg-white px-2 py-1 rounded">

</div>
    </div>
</div>


<!-- CONTENT -->
<div class="p-6">

    <!-- CARD STATISTIK -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

        <div class="bg-white p-5 rounded-xl shadow text-center">
            <div class="text-3xl mb-2">📋</div>
            <p class="text-2xl font-bold">{{ $totalLaporan ?? 0 }}</p>
            <p class="text-gray-500 text-sm">Total Laporan</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow text-center">
            <div class="text-3xl mb-2">⏳</div>
            <p class="text-2xl font-bold">{{ $menunggu ?? 0 }}</p>
            <p class="text-gray-500 text-sm">Menunggu</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow text-center">
            <div class="text-3xl mb-2">⚙️</div>
            <p class="text-2xl font-bold">{{ $diproses ?? 0 }}</p>
            <p class="text-gray-500 text-sm">Diproses</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow text-center">
            <div class="text-3xl mb-2">✅</div>
            <p class="text-2xl font-bold">{{ $selesai ?? 0 }}</p>
            <p class="text-gray-500 text-sm">Selesai</p>
        </div>

    </div>

    <!-- TABEL DATA LAPORAN -->
    <div class="bg-white rounded-xl shadow">
        <div class="p-4 border-b">
            <h2 class="font-bold text-lg">Data Laporan Masyarakat</h2>
            <p class="text-sm text-gray-500">Semua laporan masuk</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3 text-left">Tanggal</th>
                        <th class="p-3 text-left">Judul</th>
                        <th class="p-3 text-left">Lokasi</th>
                        <th class="p-3 text-left">Pelapor</th>
                        <th class="p-3 text-left">Desa</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($reports ?? [] as $report)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $report->created_at->format('d/m/Y') }}</td>
                        <td class="p-3">{{ $report->judul }}</td>
                        <td class="p-3">{{ $report->lokasi }}</td>
                        <td class="p-3">{{ $report->user->name ?? 'User' }}</td>
                        <td class="p-3">{{ $report->desa ?? '-' }}</td>
                        <td class="p-3">
                            <span class="px-3 py-1 rounded-full text-xs
                                @if($report->status_kabupaten == 'selesai') bg-green-100 text-green-700
                                @elseif($report->status_kabupaten == 'diproses') bg-blue-100 text-blue-700
                                @elseif($report->status_kabupaten == 'ditolak') bg-red-100 text-red-700
                                @else bg-yellow-100 text-yellow-700 @endif">
                                {{ $report->status_provinsi ?? 'menunggu' }}
                            </span>
                        </td>
                        <td class="p-3">
                            <a href="{{ route('admin-provinsi.reports.show', $report->id) }}"class="text-blue-600 hover:text-blue-800">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-6 text-center text-gray-500">
                            Belum ada laporan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    // Dropdown toggle
    document.getElementById('dropdownBtn').addEventListener('click', function(e) {
        e.stopPropagation();
        document.getElementById('dropdownMenu').classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    window.addEventListener('click', function(e) {
        const btn = document.getElementById('dropdownBtn');
        const menu = document.getElementById('dropdownMenu');

        if (btn && menu && !btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
</script>

</body>
</html>