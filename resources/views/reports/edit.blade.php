<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laporan - E-Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen relative">

<!-- HEADER (SAMA PERSIS) -->
<div class="bg-[#7fc8c6] px-8 py-6 shadow">
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-white">
                Edit Laporan
            </h1>
            <p class="text-white text-sm">
                Perbarui laporan kerusakan fasilitas umum
            </p>
        </div>

        <img src="{{ asset('images/logo_e-report.png') }}"
             class="h-12 bg-white px-2 py-1 rounded shadow">
    </div>
</div>

<!-- BACKGROUND (SAMA PERSIS) -->
<div class="absolute inset-0 -z-10">
    <img src="{{ asset('images/kecamatan.jpeg') }}"
         class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/30"></div>
</div>

<!-- FORM -->
<div class="flex justify-center mt-10">

    <div class="w-[600px] bg-white/70 backdrop-blur-md rounded-2xl p-6 shadow-xl">

        <h3 class="font-semibold text-base mb-1">Edit Laporan Saya</h3>
        <p class="text-sm text-gray-600 mb-4">
            Perbarui data laporan jika ada kesalahan
        </p>

        <form action="{{ route('reports.update', $report->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-3 text-sm">

                <!-- JUDUL -->
                <div>
                    <label class="font-semibold">Judul Laporan*</label>
                    <input type="text" name="judul"
                        value="{{ $report->judul }}"
                        class="w-full mt-1 bg-white rounded-lg px-4 py-2 border">
                </div>

                <!-- DESA (kalau ada di DB) -->
                <div>
                    <label class="font-semibold">Desa*</label>
                    <input type="text" name="desa"
                        value="{{ $report->desa ?? '' }}"
                        class="w-full mt-1 bg-white rounded-lg px-4 py-2 border">
                </div>

                <!-- LOKASI -->
                <div>
                    <label class="font-semibold">Lokasi Spesifik*</label>
                    <input type="text" name="lokasi"
                        value="{{ $report->lokasi }}"
                        class="w-full mt-1 bg-white rounded-lg px-4 py-2 border">
                </div>

                <!-- DESKRIPSI -->
                <div>
                    <label class="font-semibold">Deskripsi Kerusakan*</label>
                    <textarea name="deskripsi"
                        class="w-full mt-1 bg-white rounded-lg px-4 py-2 border h-20">{{ $report->deskripsi }}</textarea>
                </div>

                <!-- FOTO -->
                <div>
                    <label class="font-semibold">Foto Kerusakan (Opsional)</label>

                    @if($report->foto)
                        <div class="mt-2 mb-2">
                            <img src="{{ asset('storage/' . $report->foto) }}"
                                 class="w-full h-40 object-cover rounded-lg">
                        </div>
                    @endif

                    <label class="border-2 border-dashed rounded-lg p-6 text-center text-gray-500 block cursor-pointer">
                        Klik untuk ganti foto
                        <input type="file" name="foto" class="hidden">
                    </label>
                </div>

                <!-- BUTTON -->
                <div class="flex justify-between mt-4">
                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 bg-gray-300 rounded-lg">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg">
                        Update Laporan
                    </button>
                </div>

            </div>
        </form>

    </div>

</div>

</body>
</html>