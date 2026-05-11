<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan - Admin Provinsi</title>
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
                <p class="text-white text-sm">Admin Provinsi</p>
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
                <div><b>Kabupaten</b><br><p class="bg-white/50 rounded-lg px-3 py-2 mt-1">{{ $report->kabupaten ?? '-' }}</p></div>
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
                    <span class="inline-block px-3 py-1 text-xs rounded-full font-semibold bg-purple-100 text-purple-700">
                        {{ ucfirst($report->kewenangan ?? 'Desa') }}
                    </span>
                </div>

                <!-- Catatan dari Kabupaten -->
                @if($report->catatan_kabupaten)
                <div class="mt-2 p-3 bg-orange-50 rounded-lg border border-orange-200">
                    <b class="text-orange-700">📝 Catatan dari Admin Kabupaten</b>
                    <p class="text-gray-700 mt-1">{{ $report->catatan_kabupaten }}</p>
                </div>
                @endif
            </div>

            <!-- FORM UPDATE - UNTUK ADMIN PROVINSI -->
            @if($report->status != 'ditolak' && $report->kewenangan == 'Provinsi')
            <div class="mt-6 pt-4 border-t border-gray-300">
                <h3 class="font-semibold text-md mb-3">Update Status Laporan</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <b>Status</b><br>
                        <select id="statusSelect" class="w-full mt-1 bg-white/70 rounded-lg px-3 py-2 border focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="menunggu" {{ $report->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diproses" {{ $report->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <!-- Catatan -->
                    <div>
                        <b>Keterangan/Catatan</b><br>
                        <textarea id="catatanProvinsi" rows="3" class="w-full mt-1 bg-white/70 rounded-lg px-3 py-2 border focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Tambahkan catatan/keterangan...">{{ $report->catatan_provinsi ?? '' }}</textarea>
                    </div>

                    <div class="flex gap-3 pt-3">
                        <button id="btnUpdate" class="flex-1 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition">Update Status</button>
                        <button id="btnTolak" class="flex-1 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition">Tolak Laporan</button>
                    </div>
                </div>
            </div>
            @elseif($report->status == 'ditolak')
            <div class="mt-6 pt-4 border-t border-gray-300 text-center">
                <p class="text-red-600 font-semibold">❌ Laporan ini telah ditolak</p>
                <p class="text-sm text-gray-500 mt-1">Tidak dapat mengubah status laporan yang sudah ditolak</p>
            </div>
            @elseif($report->kewenangan != 'Provinsi')
            <div class="mt-6 pt-4 border-t border-gray-300 text-center">
                <p class="text-purple-600 font-semibold">📌 Laporan ini belum menjadi kewenangan Provinsi</p>
                <p class="text-sm text-gray-500 mt-1">Laporan akan muncul di sini setelah admin kabupaten mengirim ke provinsi</p>
            </div>
            @endif

            <!-- Tombol Kembali ke Dashboard Provinsi -->
            <div class="mt-6">
                <a href="{{ route('admin-provinsi.dashboard') }}" class="block text-center px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-sm transition">
                    Kembali ke Dashboard
                </a>
            </div>

        </div>
    </div>

    <!-- MODAL KONFIRMASI UPDATE -->
    <div id="modalUpdate" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-black/50" onclick="closeModalUpdate()"></div>
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4 text-center">
                    <div class="flex justify-center mb-2">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-white">E-Report.</h3>
                    <p class="text-purple-100 text-sm">Provinsi</p>
                </div>
                <div class="px-6 py-6">
                    <div class="text-center mb-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800">Perhatian!</h4>
                        <p class="text-sm text-gray-600 mt-2">Status laporan akan berubah.</p>
                    </div>
                    <div class="flex gap-3 mt-6">
                        <button onclick="closeModalUpdate()" class="flex-1 px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg transition">Cancel</button>
                        <button id="confirmUpdate" class="flex-1 px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-lg transition">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL KONFIRMASI TOLAK -->
    <div id="modalTolak" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-black/50" onclick="closeModalTolak()"></div>
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden">
                <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4 text-center">
                    <div class="flex justify-center mb-2">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-white">Tolak Laporan?</h3>
                </div>
                <div class="px-6 py-6">
                    <p class="text-center text-gray-700 mb-4">Apakah Anda yakin ingin menolak laporan ini?</p>
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alasan Penolakan</label>
                        <textarea id="alasanTolak" rows="3" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Masukkan alasan penolakan..."></textarea>
                        <p class="text-xs text-gray-500 mt-1">Alasan akan dikirimkan ke pelapor</p>
                    </div>
                    <div class="flex gap-3">
                        <button onclick="closeModalTolak()" class="flex-1 px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg transition">Batal</button>
                        <button id="confirmTolak" class="flex-1 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition">Tolak</button>
                    </div>
                </div>
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
        
        function updateStatus(status, catatan = null, alasanTolak = null) {
            let formData = new FormData();
            formData.append('status', status);
            formData.append('_method', 'PATCH');
            
            if (catatan) formData.append('catatan_provinsi', catatan);
            if (alasanTolak) formData.append('alasan_tolak_provinsi', alasanTolak);
            
            fetch(`/admin-provinsi/reports/{{ $report->id }}/status`, {
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
        let catatanProvinsi = document.getElementById('catatanProvinsi');
        
        if (btnUpdate) {
            btnUpdate.addEventListener('click', () => openModalUpdate());
        }
        if (confirmUpdate) {
            confirmUpdate.addEventListener('click', () => {
                let status = statusSelect ? statusSelect.value : 'menunggu';
                let catatan = catatanProvinsi ? catatanProvinsi.value : null;
                closeModalUpdate();
                updateStatus(status, catatan);
            });
        }
        if (btnTolak) {
            btnTolak.addEventListener('click', () => openModalTolak());
        }
        if (confirmTolak) {
            confirmTolak.addEventListener('click', () => {
                let alasan = document.getElementById('alasanTolak').value;
                if (!alasan) { alert('Harap masukkan alasan penolakan!'); return; }
                updateStatus('ditolak', null, alasan);
            });
        }
    </script>

</body>
</html>