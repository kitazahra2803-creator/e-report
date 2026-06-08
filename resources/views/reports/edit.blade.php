<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laporan - E-Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen relative">

<!-- HEADER -->
<div class="bg-[#7fc8c6] px-8 py-6 shadow">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Edit Laporan Saya</h1>
            <p class="text-white text-sm">Perbarui data laporan jika ada kesalahan</p>
        </div>
        <img src="{{ asset('images/logo_e-report.png') }}" class="h-12 bg-white px-2 py-1 rounded shadow">
    </div>
</div>

<!-- BACKGROUND -->
<div class="absolute inset-0 -z-10">
    <img src="{{ asset('images/kecamatan.jpeg') }}" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/30"></div>
</div>

<!-- FORM EDIT -->
<div class="flex justify-center mt-10">
    <div class="w-[600px] bg-white/70 backdrop-blur-md rounded-2xl p-6 shadow-xl">

        <h3 class="font-semibold text-base mb-1">Edit Laporan Saya</h3>
        <p class="text-sm text-gray-600 mb-4">Perbarui data laporan jika ada kesalahan</p>

        <form action="{{ route('reports.update', $report) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-3 text-sm">

                <!-- JUDUL -->
                <div>
                    <label class="font-semibold">Judul Laporan*</label>
                    <input type="text" name="judul" value="{{ old('judul', $report->judul) }}" required
                        class="w-full mt-1 bg-white rounded-lg px-4 py-2 border">
                </div>

                <!-- DESA (DROP DOWN) -->
                <div>
                    <label class="font-semibold">Desa Tujuan*</label>
                    <select name="desa_id" required class="w-full mt-1 bg-white rounded-lg px-4 py-2 border">
                        <option value="">Pilih Desa</option>
                        @foreach($desas as $desa)
                            <option value="{{ $desa->id }}" {{ $report->desa_id == $desa->id ? 'selected' : '' }}>
                                {{ $desa->nama_desa }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- KECAMATAN (DROP DOWN) -->
                <div>
                    <label class="font-semibold">Kecamatan Tujuan</label>
                    <select name="kecamatan" class="w-full mt-1 bg-white rounded-lg px-4 py-2 border">
                        <option value="">Pilih Kecamatan</option>
                        <option value="Kecamatan Sindang" {{ $report->kecamatan == 'Kecamatan Sindang' ? 'selected' : '' }}>Kecamatan Sindang</option>
                        <option value="Kecamatan Losarang" {{ $report->kecamatan == 'Kecamatan Losarang' ? 'selected' : '' }}>Kecamatan Losarang</option>
                        <option value="Kecamatan Anjatan" {{ $report->kecamatan == 'Kecamatan Anjatan' ? 'selected' : '' }}>Kecamatan Anjatan</option>
                        <option value="Kecamatan Indramayu" {{ $report->kecamatan == 'Kecamatan Indramayu' ? 'selected' : '' }}>Kecamatan Indramayu</option>
                    </select>
                </div>

                <!-- KABUPATEN (DROP DOWN) -->
                <div>
                    <label class="font-semibold">Kabupaten Tujuan</label>
                    <select name="kabupaten" class="w-full mt-1 bg-white rounded-lg px-4 py-2 border">
                        <option value="">Pilih Kabupaten</option>
                        <option value="Kabupaten Indramayu" {{ $report->kabupaten == 'Kabupaten Indramayu' ? 'selected' : '' }}>Kabupaten Indramayu</option>
                        <option value="Kabupaten Cirebon" {{ $report->kabupaten == 'Kabupaten Cirebon' ? 'selected' : '' }}>Kabupaten Cirebon</option>
                        <option value="Kabupaten Majalengka" {{ $report->kabupaten == 'Kabupaten Majalengka' ? 'selected' : '' }}>Kabupaten Majalengka</option>
                        <option value="Kabupaten Kuningan" {{ $report->kabupaten == 'Kabupaten Kuningan' ? 'selected' : '' }}>Kabupaten Kuningan</option>
                    </select>
                </div>

                <!-- PROVINSI (DROP DOWN) -->
                <div>
                    <label class="font-semibold">Provinsi Tujuan</label>
                    <select name="provinsi" class="w-full mt-1 bg-white rounded-lg px-4 py-2 border">
                        <option value="">Pilih Provinsi</option>
                        <option value="Jawa Barat" {{ $report->provinsi == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                        <option value="Jawa Tengah" {{ $report->provinsi == 'Jawa Tengah' ? 'selected' : '' }}>Jawa Tengah</option>
                        <option value="Jawa Timur" {{ $report->provinsi == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
                        <option value="Banten" {{ $report->provinsi == 'Banten' ? 'selected' : '' }}>Banten</option>
                        <option value="DKI Jakarta" {{ $report->provinsi == 'DKI Jakarta' ? 'selected' : '' }}>DKI Jakarta</option>
                    </select>
                </div>

                <!-- LOKASI SPESIFIK -->
                <div>
                    <label class="font-semibold">Lokasi Spesifik*</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $report->lokasi) }}" required
                        class="w-full mt-1 bg-white rounded-lg px-4 py-2 border">
                </div>

                <!-- DESKRIPSI -->
                <div>
                    <label class="font-semibold">Deskripsi Kerusakan*</label>
                    <textarea name="deskripsi" required
                        class="w-full mt-1 bg-white rounded-lg px-4 py-2 border h-20">{{ old('deskripsi', $report->deskripsi) }}</textarea>
                </div>

                <!-- FOTO LAMA -->
                @if($report->foto)
                <div>
                    <label class="font-semibold">Foto Saat Ini</label>
                    <div class="mt-2">
                        <img src="{{ asset($report->foto) }}" class="rounded-lg max-w-full max-h-40 object-cover">
                        <p class="text-xs text-gray-500 mt-1">Foto kerusakan yang sudah diupload</p>
                    </div>
                </div>
                @endif

                <!-- FOTO BARU -->
                <div>
                    <label class="font-semibold">Ganti Foto (Opsional)</label>
                    <label for="fotoUpload"
                        class="mt-2 border-2 border-dashed rounded-lg p-6 text-center text-gray-500 block cursor-pointer hover:bg-gray-100">
                        Klik untuk upload foto baru
                        <p class="text-xs mt-1 text-gray-400">PNG, JPG, JPEG</p>
                    </label>
                    <input id="fotoUpload" type="file" name="foto" class="hidden" accept="image/*">
                    <div id="previewFoto" class="mt-2 hidden">
                        <img id="previewImg" class="rounded-lg w-full max-h-32 object-cover">
                        <p class="text-xs text-green-500 mt-1">Foto baru akan menggantikan yang lama</p>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="flex justify-between mt-4">
                    <a href="{{ route('reports.show', $report) }}" class="px-4 py-2 bg-gray-300 rounded-lg">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Simpan Perubahan</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    // Preview foto baru
    document.getElementById('fotoUpload').addEventListener('change', function(e) {
        let file = e.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('previewImg').src = event.target.result;
                document.getElementById('previewFoto').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>

</body>
</html>
