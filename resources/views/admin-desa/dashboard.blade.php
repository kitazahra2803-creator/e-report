<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

    <!-- HEADER -->
    <div class="bg-[#7fc8c6] px-8 py-6 shadow">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white">Dashboard {{ $namaDesa }}</h1>
                <p class="text-white text-sm">Admin {{ $namaDesa }}</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <button id="dropdownBtn" class="flex items-center text-white text-sm font-medium focus:outline-none">
                        {{ Auth::user()->name }}
                        <svg class="ms-2 h-4 w-4 fill-current" viewBox="0 0 20 20">
                            <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                        </svg>
                    </button>
                    <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
                <img src="{{ asset('images/logo_e-report.png') }}" class="h-12 bg-white px-2 py-1 rounded shadow">
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="py-10">
        <div class="w-full px-6">

            <!-- CARD STATISTIK -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                <div class="rounded-xl shadow p-4 text-center bg-white">
                    <div class="text-blue-500 text-3xl mb-1">📄</div>
                    <p class="text-2xl font-bold">{{ $totalReports ?? 0 }}</p>
                    <p class="text-sm text-gray-500">Total Laporan</p>
                </div>
                <div class="rounded-xl shadow p-4 text-center bg-white">
                    <div class="text-yellow-500 text-3xl mb-1">⏱️</div>
                    <p class="text-2xl font-bold">{{ $waitingReports ?? 0 }}</p>
                    <p class="text-sm text-gray-500">Menunggu</p>
                </div>
                <div class="rounded-xl shadow p-4 text-center bg-white">
                    <div class="text-blue-500 text-3xl mb-1">🔄</div>
                    <p class="text-2xl font-bold">{{ $processedReports ?? 0 }}</p>
                    <p class="text-sm text-gray-500">Diproses</p>
                </div>
                <div class="rounded-xl shadow p-4 text-center bg-white">
                    <div class="text-green-500 text-3xl mb-1">✅</div>
                    <p class="text-2xl font-bold">{{ $completedReports ?? 0 }}</p>
                    <p class="text-sm text-gray-500">Selesai</p>
                </div>
            </div>

            <!-- FILTER -->
            <div class="flex flex-wrap justify-between items-center gap-3 mt-6 mb-4">
                <div class="flex gap-3 flex-wrap">
                    <select id="statusFilter" class="px-4 py-2 border rounded-lg text-sm bg-white shadow-sm">
                        <option value="semua">Semua Status</option>
                        <option value="menunggu">Menunggu</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                    <select id="kewenanganFilter" class="px-4 py-2 border rounded-lg text-sm bg-white shadow-sm">
                        <option value="semua">Semua Kewenangan</option>
                        <option value="Desa">Kewenangan Desa</option>
                        <option value="Kecamatan">Kewenangan Kecamatan</option>
                    </select>
                </div>
                <p class="text-sm text-gray-500" id="totalLaporanText">
                    Menampilkan {{ $reports->count() }} dari {{ $totalReports }} laporan
                </p>
            </div>

            <!-- TABEL LAPORAN -->
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Laporan Dari Masyarakat {{ $namaDesa }}</h3>
                    <p class="text-sm text-gray-500">Daftar laporan yang masuk dari warga {{ $namaDesa }}</p>
                </div>
                <div class="p-4">
                    @if(isset($reports) && count($reports) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse">
    <thead>
        <tr class="border-b border-gray-200 bg-gray-50">
            <th class="text-left py-3 px-3 text-sm font-semibold text-gray-700">Tanggal</th>
            <th class="text-left py-3 px-3 text-sm font-semibold text-gray-700">Judul Laporan</th>
            <th class="text-left py-3 px-3 text-sm font-semibold text-gray-700">Lokasi</th>
            <th class="text-left py-3 px-3 text-sm font-semibold text-gray-700">Pelapor</th>
            <th class="text-left py-3 px-3 text-sm font-semibold text-gray-700">Status</th>
            <th class="text-left py-3 px-3 text-sm font-semibold text-gray-700">Kewenangan</th>
            <th class="text-left py-3 px-3 text-sm font-semibold text-gray-700">Alasan Ditolak</th>
            <th class="text-left py-3 px-3 text-sm font-semibold text-gray-700">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reports as $report)
        <tr class="border-b border-gray-100 hover:bg-gray-50 report-row" 
            data-status="{{ $report->status }}" 
            data-kewenangan="{{ $report->kewenangan ?? 'Desa' }}">
            <td class="py-3 px-3 text-sm text-gray-700">{{ $report->created_at->format('d/m/Y') }}</td>
            <td class="py-3 px-3 text-sm font-medium text-gray-800">{{ $report->judul }}</td>
            <td class="py-3 px-3 text-sm text-gray-700">{{ $report->lokasi }}</td>
            <td class="py-3 px-3 text-sm text-gray-700">{{ $report->user->name ?? 'Unknown' }}</td>
            
            <!-- STATUS -->
            <td class="py-3 px-3">
                <span class="px-3 py-1 text-xs rounded-full font-semibold
                    @if($report->status == 'selesai') bg-green-100 text-green-700
                    @elseif($report->status == 'diproses') bg-blue-100 text-blue-700
                    @elseif($report->status == 'ditolak') bg-red-100 text-red-700
                    @else bg-yellow-100 text-yellow-700 @endif">
                    {{ ucfirst($report->status) }}
                </span>
            </td>
            
            <!-- KEWENANGAN -->
            <td class="py-3 px-3">
                @if(($report->kewenangan ?? 'Desa') == 'Kecamatan')
                    <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-700 font-semibold">🏛️ Kecamatan</span>
                @else
                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">Desa</span>
                @endif
            </td>
            
            <!-- ALASAN -->
            <td class="py-3 px-3 text-sm text-red-600 max-w-[200px] truncate">
                @if($report->status == 'ditolak')
                    @if($report->alasan_tolak_kecamatan)
                        <span title="{{ $report->alasan_tolak_kecamatan }}">❌ Kec: {{ Str::limit($report->alasan_tolak_kecamatan, 30) }}</span>
                    @elseif($report->alasan_tolak)
                        <span title="{{ $report->alasan_tolak }}">⚠️ Desa: {{ Str::limit($report->alasan_tolak, 30) }}</span>
                    @else
                        -
                    @endif
                @else
                    -
                @endif
            </td>
            
            <!-- AKSI -->
            <td class="py-3 px-3">
                @if(($report->kewenangan ?? 'Desa') == 'Kecamatan')
                    <a href="{{ route('admin-desa.reports.show', $report->id) }}" class="text-blue-600 hover:text-blue-800 text-sm">Lihat Detail</a>
                @else
                    <a href="{{ route('admin-desa.reports.show', $report->id) }}" class="text-blue-600 hover:text-blue-800 text-sm">Detail</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
                    </div>
                    @else
                    <div class="text-center py-12">
                        <div class="text-6xl mb-4">📭</div>
                        <p class="text-gray-500 mb-4">Belum ada laporan dari masyarakat</p>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('dropdownBtn').addEventListener('click', function() {
            var menu = document.getElementById('dropdownMenu');
            menu.classList.toggle('hidden');
        });
        window.addEventListener('click', function(e) {
            var menu = document.getElementById('dropdownMenu');
            var btn = document.getElementById('dropdownBtn');
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });

        function filterTable() {
            let statusValue = document.getElementById('statusFilter').value;
            let kewenanganValue = document.getElementById('kewenanganFilter').value;
            let rows = document.querySelectorAll('.report-row');
            let visibleCount = 0;
            
            rows.forEach(row => {
                let statusMatch = (statusValue === 'semua' || row.dataset.status === statusValue);
                let kewenanganMatch = (kewenanganValue === 'semua' || row.dataset.kewenangan === kewenanganValue);
                
                if (statusMatch && kewenanganMatch) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            document.getElementById('totalLaporanText').innerText = `Menampilkan ${visibleCount} dari {{ $totalReports }} laporan`;
        }
        
        document.getElementById('statusFilter').addEventListener('change', filterTable);
        document.getElementById('kewenanganFilter').addEventListener('change', filterTable);
    </script>

</body>
</html>