<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen relative">

<!-- HEADER -->
<div class="bg-[#7fc8c6] px-8 py-6 shadow">
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-white">
                Buat Laporan Baru
            </h1>
            <p class="text-white text-sm">
                Laporkan Kerusakan Fasilitas Umum
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

<!-- FORM -->
<div class="flex justify-center mt-10">

    <!-- CARD PUTIH TRANSPARAN -->
    <div class="w-[600px] bg-white/70 backdrop-blur-md rounded-2xl p-6 shadow-xl">

        <!-- TITLE -->
        <h3 class="font-semibold text-base mb-1">Laporan Saya</h3>
        <p class="text-sm text-gray-600 mb-4">
            Isi formulir di bawah ini dengan lengkap dan jelas!
        </p>

        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-3 text-sm">

                <!-- JUDUL -->
                <div>
                    <label class="font-semibold">Judul Laporan*</label>
                    <input type="text" name="judul"
                        placeholder="Contoh: Jalan Rusak di Depan Sekolah"
                        class="w-full mt-1 bg-white rounded-lg px-4 py-2 border">
                </div>

                <!-- DESA -->
                <div>
                    <label class="font-semibold">Desa*</label>
                    <input type="text" name="desa"
                        placeholder="Pilih Desa"
                        class="w-full mt-1 bg-white rounded-lg px-4 py-2 border">
                </div>

                <!-- LOKASI -->
                <div>
                    <label class="font-semibold">Lokasi Spesifik*</label>
                    <input type="text" name="lokasi"
                        placeholder="Contoh: Jl. Raya Sindang No.12"
                        class="w-full mt-1 bg-white rounded-lg px-4 py-2 border">
                </div>

                <!-- DESKRIPSI -->
                <div>
                    <label class="font-semibold">Deskripsi Kerusakan*</label>
                    <textarea name="deskripsi"
                        placeholder="Deskripsikan kerusakan secara detail"
                        class="w-full mt-1 bg-white rounded-lg px-4 py-2 border h-20"></textarea>
                </div>

                <!-- FOTO -->
<div>
    <label class="font-semibold">Foto Kerusakan (Opsional)*</label>

    <label for="fotoUpload"
           class="mt-2 border-2 border-dashed rounded-lg p-6 text-center text-gray-500 block cursor-pointer hover:bg-gray-100">
        Klik untuk upload foto

        <p class="text-xs mt-1 text-gray-400">PNG, JPG, JPEG</p>
    </label>

    <input id="fotoUpload" type="file" name="foto" class="hidden">
</div>

                <!-- BUTTON -->
                <div class="flex justify-between mt-4">
                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 bg-gray-300 rounded-lg">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg">
                        Kirim Laporan
                    </button>
                </div>

            </div>
        </form>

    </div>

</div>

</body>
</html>