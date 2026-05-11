<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan - Admin Kabupaten</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="min-h-screen relative">

    <div class="absolute inset-0 -z-10">
        <img src="{{ asset('images/kecamatan.jpeg') }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/30"></div>
    </div>

    <div class="bg-[#7fc8c6] px-8 py-6 shadow relative z-10">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white">Detail Laporan</h1>
                <p class="text-white text-sm">Admin Kabupaten</p>
            </div>
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/logo_e-report.png') }}" class="h-10 bg-white px-2 py-1 rounded shadow">
            </div>
        </div>
    </div>

    <div class="relative z-10 flex justify-center py-10">
        <div class="w-[600px] bg-white/70 backdrop-blur-md rounded-2xl p-6 shadow-xl">

            <h3 class="font-semibold text-lg mb-4">Detail Laporan</h3>

            <div class="space-y-3 text-sm">
                <div><b>Judul Laporan</b><br><p class="bg-white/50 rounded-lg px-3 py-2 mt-1">{{ $report->judul }}</p></div>
                <div><b>Lokasi</b><br><p class="bg-white/50 rounded-lg px-3 py-2 mt-1">{{ $report->lokasi }}</p></div>
                <div><b>Desa</b><br><p class="bg-white/50 rounded-lg px-3 py-2 mt-1">{{ $report->desa }}</p></div>
                <div><b>Tanggal Laporan</b><br><p class="bg-white/50 rounded-lg px-3 py-2 mt-1">{{ $report->created_at->format('d M Y H:i') }}</p></div>
                <div><b>Deskripsi Kerusakan</b><br><p class="bg-white/50 rounded-lg px-3 py-2 mt-1">{{ $report->deskripsi }}</p></div>
                
                <div><b>Foto Kerusakan</b><br>
                    @if($report->foto)
                        <img src="{{ asset('storage/' . $report->foto) }}" class="mt-2 rounded-lg max-w-full max-h-64 object-cover">
                    @else
                        <p class="text-gray-500 italic mt-1">Tidak ada foto</p>
                    @endif
                </div>
                
                <div>
                    <b>Status Saat Ini</b><br>
                    <span class="inline-block px-3 py-1 text-xs rounded-full font-semibold
                        @if($report->status == 'selesai') bg-green-100 text-green-700
                        @elseif($report->status == 'diproses') bg-blue-100 text-blue-700
                        @elseif($report->status == 'ditolak') bg-red-100 text-red-700
                        @else bg-yellow-100 text-yellow-700 @endif">
                        {{ ucfirst($report->status) }}
                    </span>
                </div>

                <div>
                    <b>Kewenangan Saat Ini</b><br>
                    <span class="inline-block px-3 py-1 text-xs rounded-full font-semibold
                        @if($report->kewenangan == 'Provinsi') bg-purple-100 text-purple-700
                        @elseif($report->kewenangan == 'Kabupaten') bg-orange-100 text-orange-700
                        @else bg-gray-100 text-gray-600 @endif">
                        {{ ucfirst($report->kewenangan ?? 'Desa') }}
                    </span>
                </div>
            </div>

            <!-- FORM UPDATE - UNTUK ADMIN KABUPATEN -->
            @if($report->status != 'ditolak' && $report->kewenangan == 'Kabupaten')
            <div class="mt-6 pt-4 border-t border-gray-300">
                <h3 class="font-semibold text-md mb-3">Update Status Laporan</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <b>Status</b><br>
                        <select id="statusSelect" class="w-full mt-1 bg-white/70 rounded-lg px-3 py-2 border focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="menunggu" {{ $report->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diproses" {{ $report->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <!-- TINGKAT KEWENANGAN (KABUPATEN ATAU PROVINSI) -->
                    <div>
                        <b>Tingkat Kewenangan</b><br>
                        <select id="kewenanganSelect" class="w-full mt-1 bg-white/70 rounded-lg px-3 py-2 border focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="Kabupaten" {{ ($report->kewenangan ?? 'Kabupaten') == 'Kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                            <option value="Provinsi" {{ ($report->kewenangan ?? 'Kabupaten') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                        </select>
                    </div>

                    <!-- Catatan -->
                    <div>
                        <b>Keterangan/Catatan</b><br>
                        <textarea id="catatanKabupaten" rows="3" class="w-full mt-1 bg-white/70 rounded-lg px-3 py-2 border focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tambahkan catatan/keterangan...">{{ $report->catatan_kabupaten ?? '' }}</textarea>
                    </div>

                    <div class="flex gap-3 pt-3">
                        <button id="btnUpdate" class="flex-1 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition">Update Status</button>
                        <button id="btnTolak" class="flex-1 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition">Tolak Laporan</button>
                    </div>
                </div>
            </div>
            @elseif($report->kewenangan == 'Provinsi')
            <div class="mt-6 pt-4 border-t border-gray-300 text-center">
                <p class="text-purple-600 font-semibold">📌 Laporan ini sudah menjadi kewenangan Provinsi</p>
                <p class="text-sm text-gray-500 mt-1">Anda hanya bisa melihat detail laporan, tidak dapat mengubah status</p>
            </div>
            @elseif($report->status == 'ditolak')
            <div class="mt-6 pt-4 border-t border-gray-300 text-center">
                <p class="text-red-600 font-semibold">❌ Laporan ini telah ditolak</p>
            </div>
            @endif

            <!-- Tombol Kembali ke Dashboard Kabupaten -->
            <div class="mt-6">
                <a href="{{ route('admin-kabupaten.dashboard') }}" class="block text-center px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-sm transition">
                    Kembali ke Dashboard
                </a>
            </div>

        </div>
    </div>

    <script>
        function openModalUpdate() {
            document.getElementById('modalUpdate').classList.remove('hidden');
        }
        function closeModalUpdate() {
            document.getElementById('modalUpdate').classList.add('hidden');
        }
        function openModalTolak() {
            document.getElementById('modalTolak').classList.remove('hidden');
            document.getElementById('alasanTolak').value = '';
        }
        function closeModalTolak() {
            document.getElementById('modalTolak').classList.add('hidden');
        }
        
        function updateStatus(status, kewenangan = null, catatan = null, alasanTolak = null) {
            let formData = new FormData();
            formData.append('status', status);
            formData.append('_method', 'PATCH');
            
            if (kewenangan) formData.append('kewenangan', kewenangan);
            if (catatan) formData.append('catatan_kabupaten', catatan);
            if (alasanTolak) formData.append('alasan_tolak_kabupaten', alasanTolak);
            
            fetch(`/admin-kabupaten/reports/{{ $report->id }}/status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Gagal: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan: ' + error);
            });
        }
        
        let btnUpdate = document.getElementById('btnUpdate');
        let confirmUpdate = document.getElementById('confirmUpdate');
        let btnTolak = document.getElementById('btnTolak');
        let confirmTolak = document.getElementById('confirmTolak');
        let statusSelect = document.getElementById('statusSelect');
        let kewenanganSelect = document.getElementById('kewenanganSelect');
        let catatanKabupaten = document.getElementById('catatanKabupaten');
        
        if (btnUpdate) {
            btnUpdate.addEventListener('click', () => openModalUpdate());
        }
        if (confirmUpdate) {
            confirmUpdate.addEventListener('click', () => {
                let status = statusSelect ? statusSelect.value : 'menunggu';
                let kewenangan = kewenanganSelect ? kewenanganSelect.value : 'Kabupaten';
                let catatan = catatanKabupaten ? catatanKabupaten.value : null;
                closeModalUpdate();
                updateStatus(status, kewenangan, catatan);
            });
        }
        if (btnTolak) {
            btnTolak.addEventListener('click', () => openModalTolak());
        }
        if (confirmTolak) {
            confirmTolak.addEventListener('click', () => {
                let alasan = document.getElementById('alasanTolak').value;
                if (!alasan) { alert('Harap masukkan alasan penolakan!'); return; }
                let kewenangan = kewenanganSelect ? kewenanganSelect.value : 'Kabupaten';
                updateStatus('ditolak', kewenangan, null, alasan);
            });
        }
    </script>

</body>
</html>