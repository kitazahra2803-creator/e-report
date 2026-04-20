<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan - Admin Kecamatan</title>
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
                <p class="text-white text-sm">Admin Kecamatan Sindang</p>
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
                <div><b>Tanggal Laporan</b><br><p class="bg-white/50 rounded-lg px-3 py-2 mt-1">{{ $report->created_at->format('d M Y H:i') }}</p></div>
                <div><b>Deskripsi Kerusakan</b><br><p class="bg-white/50 rounded-lg px-3 py-2 mt-1">{{ $report->deskripsi }}</p></div>
                
                <div><b>Foto Kerusakan</b><br>
                    @if($report->foto)
                        <img src="{{ asset('storage/' . $report->foto) }}" class="mt-2 rounded-lg max-w-full max-h-64 object-cover">
                    @else
                        <p class="text-gray-500 italic mt-1">Tidak ada foto</p>
                    @endif
                </div>

                @if($report->foto_perbaikan)
                <div>
                    <b>Foto Bukti Perbaikan:</b><br>
                    <img src="{{ asset('storage/' . $report->foto_perbaikan) }}" class="mt-2 rounded-lg max-w-full max-h-64 object-cover">
                    <p class="text-xs text-green-600 mt-1">✅ Fasilitas telah diperbaiki</p>
                </div>
                @endif

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
                    <b>Kewenangan</b><br>
                    @if(($report->kewenangan ?? 'Desa') == 'Kecamatan')
                        <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-700 font-semibold">🏛️ Kewenangan Kecamatan</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">Kewenangan Desa</span>
                    @endif
                </div>

                @if($report->status == 'ditolak')
                <div>
                    <b>Alasan Penolakan:</b><br>
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
                
                <!-- TAMPILKAN CATATAN DARI ADMIN DESA -->
                @if($report->catatan)
                <div>
                    <b>Catatan dari Admin Desa:</b><br>
                    <p class="bg-blue-50 rounded-lg px-3 py-2 mt-1">{{ $report->catatan }}</p>
                </div>
                @endif
                
                <!-- TAMPILKAN CATATAN DARI ADMIN KECAMATAN -->
                @if($report->catatan_kecamatan)
                <div>
                    <b>Catatan dari Admin Kecamatan:</b><br>
                    <p class="bg-purple-50 rounded-lg px-3 py-2 mt-1">{{ $report->catatan_kecamatan }}</p>
                </div>
                @endif
            </div>

            <!-- UPDATE STATUS - HANYA TAMPIL JIKA KEWENANGAN KECAMATAN DAN STATUS BELUM SELESAI/DITOLAK -->
            @if(($report->kewenangan ?? 'Desa') == 'Kecamatan' && $report->status != 'selesai' && $report->status != 'ditolak')
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

                    <!-- Upload Foto Perbaikan (hanya muncul saat status Selesai) -->
                    <div id="uploadFotoPerbaikan" class="hidden">
                        <b>Foto Bukti Perbaikan</b><br>
                        <label for="fotoPerbaikan" class="mt-2 border-2 border-dashed rounded-lg p-4 text-center text-gray-500 block cursor-pointer hover:bg-gray-100">
                            Klik untuk upload foto bukti perbaikan
                            <p class="text-xs mt-1 text-gray-400">PNG, JPG, JPEG (Opsional)</p>
                        </label>
                        <input id="fotoPerbaikan" type="file" name="foto_perbaikan" class="hidden" accept="image/*">
                        <div id="previewFoto" class="mt-2 hidden">
                            <img id="previewImg" class="mt-2 rounded-lg max-w-full max-h-32 object-cover">
                        </div>
                    </div>

                    <div>
                        <b>Keterangan/Catatan</b><br>
                        <textarea id="catatanText" rows="3" class="w-full mt-1 bg-white/70 rounded-lg px-3 py-2 border focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tambahkan catatan/keterangan...">{{ $report->catatan_kecamatan ?? '' }}</textarea>
                    </div>

                    <div class="flex gap-3 pt-3">
                        <button id="btnTolak" class="flex-1 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition">Tolak Laporan</button>
                        <button id="btnUpdate" class="flex-1 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition">Update Status</button>
                    </div>
                </div>
            </div>
            @elseif(($report->kewenangan ?? 'Desa') == 'Desa')
            <div class="mt-6 pt-4 border-t border-gray-300 text-center">
                <p class="text-blue-600 font-semibold">📋 Laporan ini adalah kewenangan Desa</p>
                <p class="text-sm text-gray-500 mt-1">Hanya admin desa yang dapat mengubah status laporan ini</p>
            </div>
            @elseif($report->status == 'selesai')
            <div class="mt-6 pt-4 border-t border-gray-300 text-center">
                <p class="text-green-600 font-semibold">✅ Laporan ini telah selesai</p>
                <p class="text-sm text-gray-500 mt-1">Tidak dapat mengubah status laporan yang sudah selesai</p>
            </div>
            @elseif($report->status == 'ditolak')
            <div class="mt-6 pt-4 border-t border-gray-300 text-center">
                <p class="text-red-600 font-semibold">❌ Laporan ini telah ditolak</p>
                <p class="text-sm text-gray-500 mt-1">Tidak dapat mengubah status laporan yang sudah ditolak</p>
            </div>
            @endif

            <div class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block text-center px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-sm transition">
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
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4 text-center">
                    <div class="flex justify-center mb-2">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-white">E-Report.</h3>
                    <p class="text-blue-100 text-sm">Kec. Sindang</p>
                </div>
                <div class="px-6 py-6">
                    <div class="text-center mb-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800">Perhatian!</h4>
                        <p class="text-sm text-gray-600 mt-2">Status akan berubah dan pelapor akan mendapat notifikasi.</p>
                    </div>
                    <div class="flex gap-3 mt-6">
                        <button onclick="closeModalUpdate()" class="flex-1 px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg transition">Cancel</button>
                        <button id="confirmUpdate" class="flex-1 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition">Yes</button>
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

        // Show/hide upload foto perbaikan saat status berubah
        let statusSelect = document.getElementById('statusSelect');
        let uploadFotoDiv = document.getElementById('uploadFotoPerbaikan');
        
        if (statusSelect) {
            statusSelect.addEventListener('change', function() {
                if (this.value === 'selesai') {
                    uploadFotoDiv.classList.remove('hidden');
                } else {
                    uploadFotoDiv.classList.add('hidden');
                    document.getElementById('fotoPerbaikan').value = '';
                    document.getElementById('previewFoto').classList.add('hidden');
                }
            });
            if (statusSelect.value === 'selesai') {
                uploadFotoDiv.classList.remove('hidden');
            }
        }

        // Preview foto
        let fotoPerbaikan = document.getElementById('fotoPerbaikan');
        if (fotoPerbaikan) {
            fotoPerbaikan.addEventListener('change', function(e) {
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
        }

        function updateStatus(status, catatan = null, alasanTolak = null) {
            let formData = new FormData();
            formData.append('status', status);
            if (catatan) formData.append('catatan', catatan);
            if (alasanTolak) formData.append('alasan_tolak', alasanTolak);
            
            let fotoFile = document.getElementById('fotoPerbaikan');
            if (fotoFile && fotoFile.files[0]) {
                formData.append('foto_perbaikan', fotoFile.files[0]);
            }
            
            fetch(`/admin/reports/{{ $report->id }}/status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-HTTP-Method-Override': 'PATCH'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "{{ route('admin.dashboard') }}";
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
        
        if (btnUpdate) {
            btnUpdate.addEventListener('click', () => openModalUpdate());
        }
        if (confirmUpdate) {
            confirmUpdate.addEventListener('click', () => {
                let status = statusSelect ? statusSelect.value : 'menunggu';
                let catatan = document.getElementById('catatanText').value;
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
                let catatan = document.getElementById('catatanText').value;
                updateStatus('ditolak', catatan, alasan);
            });
        }
    </script>

</body>
</html>