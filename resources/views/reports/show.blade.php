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
            <h1 class="text-2xl font-bold text-white">
                Detail Laporan
            </h1>
            <p class="text-white text-sm">
                {{ Auth::user()->name }} - Sindang
            </p>
        </div>

        <img src="{{ asset('images/logo_e-report.png') }}" 
             class="h-12 bg-white px-2 py-1 rounded shadow">
    </div>
</div>

<!-- BACKGROUND -->
<div class="absolute inset-0 -z-10">
    <img src="{{ asset('images/kecamatan.jpeg') }}"
         class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/30"></div>
</div>

<!-- CONTENT -->
<div class="flex justify-center mt-10">

    <div class="w-[600px] bg-white/70 backdrop-blur-md rounded-2xl p-6 shadow-xl">

        <h3 class="font-semibold mb-4">Detail Laporan</h3>

        <div class="space-y-3 text-sm">

            <div>
                <b>Judul:</b><br>
                {{ $report->judul }}
            </div>

            <div>
                <b>Lokasi:</b><br>
                {{ $report->lokasi }}
            </div>

            <div>
                <b>Status:</b><br>
                {{ $report->status }}
            </div>

            <div>
                <b>Tanggal:</b><br>
                {{ $report->created_at->format('d M Y H:i') }}
            </div>

            <div>
                <b>Deskripsi:</b><br>
                {{ $report->deskripsi }}
            </div>

            @if($report->foto)
            <div>
                <b>Foto:</b><br>
                <img src="{{ asset('storage/' . $report->foto) }}"
                     class="mt-2 rounded-lg">
            </div>
            @endif

        </div>

        <!-- BUTTON -->
        <div class="mt-6 flex justify-between">
            <a href="{{ route('dashboard') }}"
               class="px-4 py-2 bg-gray-300 rounded-lg text-sm">
                Kembali
            </a>

            <a href="{{ route('reports.edit', $report->id) }}"
               class="px-4 py-2 bg-yellow-400 rounded-lg text-sm">
                Edit
            </a>
        </div>

    </div>

</div>

</body>
</html>