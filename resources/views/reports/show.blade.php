<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen relative">

<!-- HEADER -->
<div class="bg-[#7fc8c6] px-8 py-6 shadow">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Detail Laporan</h1>
            <p class="text-white text-sm">{{ Auth::user()->name }} - Sindang</p>
        </div>
        <img src="{{ asset('images/logo_e-report.png') }}" class="h-12 bg-white px-2 py-1 rounded shadow">
    </div>
</div>

<!-- BACKGROUND -->
<div class="absolute inset-0 -z-10">
    <img src="{{ asset('images/kecamatan.jpeg') }}" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/30"></div>
</div>

<!-- CONTENT -->
<div class="flex justify-center mt-10">
    <div class="w-[600px] bg-white/70 backdrop-blur-md rounded-2xl p-6 shadow-xl">

        <h3 class="font-semibold mb-4">Detail Laporan</h3>

        <div class="space-y-3 text-sm">

            <!-- JUDUL -->
            <div><b>Judul:</b><br>{{ $report->judul }}</div>

            <!-- LOKASI -->
            <div><b>Lokasi:</b><br>{{ $report->lokasi }}</div>

            <!-- DESA TUJUAN -->
            <div>
                <b>Desa Tujuan:</b><br>
                {{ $report->desaRelasi ? $report->desaRelasi->nama_desa : '-' }}
            </div>

            <!-- KECAMATAN -->
            <div>
                <b>Kecamatan:</b><br>
                {{ $report->kecamatan ?: '-' }}
            </div>

            <!-- KABUPATEN -->
            <div>
                <b>Kabupaten:</b><br>
                {{ $report->kabupaten ?: '-' }}
            </div>

            <!-- PROVINSI -->
            <div>
                <b>Provinsi:</b><br>
                {{ $report->provinsi ?: '-' }}
            </div>

            <!-- STATUS -->
            <div>
                <b>Status:</b><br>
                <span class="inline-block px-3 py-1 text-xs rounded-full font-semibold
                    @if($report->status == 'selesai') bg-green-100 text-green-700
                    @elseif($report->status == 'diproses') bg-blue-100 text-blue-700
                    @elseif($report->status == 'ditolak') bg-red-100 text-red-700
                    @else bg-yellow-100 text-yellow-700 @endif">
                    {{ ucfirst($report->status) }}
                </span>
            </div>

            <!-- KEWENANGAN -->
            <div>
                <b>Kewenangan:</b><br>
                @if($report->kewenangan == 'Kecamatan')
                    <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-700 font-semibold">🏛️ Kewenangan Kecamatan</span>
                @elseif($report->kewenangan == 'Kabupaten')
                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-semibold">🏢 Kewenangan Kabupaten</span>
                @elseif($report->kewenangan == 'Provinsi')
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 font-semibold">🏛️ Kewenangan Provinsi</span>
                @else
                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">🏘️ Kewenangan Desa</span>
                @endif
            </div>

            <!-- ALASAN DITOLAK (LENGKAP DARI SEMUA LEVEL) -->
            @if($report->status == 'ditolak')
            <div>
                <b>Alasan Ditolak:</b><br>
                @if($report->alasan_tolak_provinsi)
                    <p class="text-red-600 bg-red-50 rounded-lg px-3 py-2 mt-1">
                        <strong>Ditolak oleh Provinsi:</strong> {{ $report->alasan_tolak_provinsi }}
                    </p>
                @endif
                @if($report->alasan_tolak_kabupaten)
                    <p class="text-red-600 bg-red-50 rounded-lg px-3 py-2 mt-1">
                        <strong>Ditolak oleh Kabupaten:</strong> {{ $report->alasan_tolak_kabupaten }}
                    </p>
                @endif
                @if($report->alasan_tolak_kecamatan)
                    <p class="text-red-600 bg-red-50 rounded-lg px-3 py-2 mt-1">
                        <strong>Ditolak oleh Kecamatan:</strong> {{ $report->alasan_tolak_kecamatan }}
                    </p>
                @endif
                @if($report->alasan_tolak)
                    <p class="text-red-600 bg-red-50 rounded-lg px-3 py-2 mt-1">
                        <strong>Ditolak oleh Desa:</strong> {{ $report->alasan_tolak }}
                    </p>
                @endif
            </div>
            @endif

            <!-- CATATAN DARI ADMIN DESA -->
            @if($report->catatan)
            <div>
                <b>Catatan dari Admin Desa:</b><br>
                <p class="bg-blue-50 rounded-lg px-3 py-2 mt-1">{{ $report->catatan }}</p>
            </div>
            @endif

            <!-- CATATAN DARI ADMIN KECAMATAN -->
            @if($report->catatan_kecamatan)
            <div>
                <b>Catatan dari Admin Kecamatan:</b><br>
                <p class="bg-purple-50 rounded-lg px-3 py-2 mt-1">{{ $report->catatan_kecamatan }}</p>
            </div>
            @endif

            <!-- CATATAN DARI ADMIN KABUPATEN -->
            @if($report->catatan_kabupaten)
            <div>
                <b>Catatan dari Admin Kabupaten:</b><br>
                <p class="bg-blue-50 rounded-lg px-3 py-2 mt-1">{{ $report->catatan_kabupaten }}</p>
            </div>
            @endif

            <!-- CATATAN DARI ADMIN PROVINSI -->
            @if($report->catatan_provinsi)
            <div>
                <b>Catatan dari Admin Provinsi:</b><br>
                <p class="bg-green-50 rounded-lg px-3 py-2 mt-1">{{ $report->catatan_provinsi }}</p>
            </div>
            @endif

            <!-- TANGGAL -->
            <div><b>Tanggal:</b><br>{{ $report->created_at->format('d M Y H:i') }}</div>

            <!-- DESKRIPSI -->
            <div><b>Deskripsi:</b><br>{{ $report->deskripsi }}</div>

            <!-- FOTO KERUSAKAN -->
            @if($report->foto && file_exists(public_path($report->foto)))
            <div>
                <b>Foto Kerusakan:</b><br>
                <img src="{{ asset($report->foto) }}" class="mt-2 rounded-lg max-w-full max-h-64 object-cover">
            </div>
            @elseif($report->foto)
            <div>
                <b>Foto Kerusakan:</b><br>
                <img src="{{ asset($report->foto) }}" class="mt-2 rounded-lg max-w-full max-h-64 object-cover">
            </div>
            @endif

            <!-- FOTO BUKTI PERBAIKAN -->
            @if($report->foto_perbaikan && file_exists(public_path($report->foto_perbaikan)))
            <div>
                <b>Foto Bukti Perbaikan:</b><br>
                <img src="{{ asset($report->foto_perbaikan) }}" class="mt-2 rounded-lg max-w-full max-h-64 object-cover">
                <p class="text-xs text-green-600 mt-1">✅ Fasilitas telah diperbaiki</p>
            </div>
            @endif

        </div>

        <!-- BUTTON -->
        <div class="mt-6 flex justify-between items-center">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-300 rounded-lg text-sm">Kembali</a>

            <!-- EDIT HANYA MUNCUL JIKA STATUS MENUNGGU DAN KEWENANGAN DESA -->
            @if($report->status == 'menunggu' && $report->kewenangan == 'Desa')
                <a href="{{ route('reports.edit', $report->id) }}" class="px-4 py-2 bg-yellow-400 rounded-lg text-sm">Edit</a>
            @endif
        </div>

    </div>
</div>

</body>
</html>
