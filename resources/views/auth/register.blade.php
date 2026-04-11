<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - E-Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="min-h-screen">

    <!-- TOP BAR: LAPOR KERUSAKAN FASILITAS UMUM -->
    <div class="bg-[#A8DADC] text-center text-xs py-2 tracking-wide font-semibold">
        LAPOR KERUSAKAN FASILITAS UMUM
    </div>

    <div class="flex min-h-screen">
        
        <!-- SISI KIRI: FORM DAFTAR -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-12 bg-white">
            <div class="w-full max-w-md">
                
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Daftar Sekarang</h2>
                    <p class="text-gray-500 text-sm mb-6">Daftarkan diri Anda sekarang sebagai pelapor masyarakat. Dengan melakukan pendaftaran, Anda dapat mengirimkan laporan secara langsung serta memantau perkembangan penanganan laporan secara online.</p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="space-y-4">
                            <!-- Username -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-1">Username *</label>
                                <input type="text" name="username" value="{{ old('username') }}" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Masukkan username anda">
                                @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-1">Email *</label>
                                <input type="email" name="email" value="{{ old('email') }}" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Contoh@email.com">
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Nama Lengkap -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-1">Nama Lengkap *</label>
                                <input type="text" name="name" value="{{ old('name') }}" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Masukkan nama lengkap anda">
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Nomor Handphone -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-1">Nomor Handphone *</label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Masukkan nomor handphone anda">
                                @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Desa -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-1">Desa *</label>
                                <select name="village" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                    <option value="">Pilih Desa</option>
                                    <option value="Pulau Data" {{ old('village') == 'Desa Sindang' ? 'selected' : '' }}>Desa Sindang</option>
                                </select>
                                @error('village') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Kecamatan -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-1">Kecamatan *</label>
                                <select name="district" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                    <option value="">Pilih Kecamatan</option>
                                    <option value="Pusat Kecamatan" {{ old('district') == 'Kecamatan Sindang' ? 'selected' : '' }}>Kecamatan Sindang</option>
                                </select>
                                @error('district') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Provinsi -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-1">Provinsi *</label>
                                <select name="province" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                    <option value="">Pilih Provinsi</option>
                                    <option value="Pulau Provinsi" {{ old('province') == 'Jawa Barat' ? 'selected' : '' }}>Provinsi Jawabarat</option>
                                </select>
                                @error('province') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-1">Password *</label>
                                <input type="password" name="password" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Masukkan password">
                                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Konfirmasi Password -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-1">Konfirmasi Password *</label>
                                <input type="password" name="password_confirmation" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Konfirmasi password">
                            </div>

                            <!-- Checkbox Terms -->
                            <div>
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="terms" required class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Saya setuju untuk mengikuti syarat dan kondisi kebijakan data privasi</span>
                                </label>
                            </div>

                            <!-- Checkbox Robot -->
                            <div>
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="robot" required class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">I'm not a robot</span>
                                </label>
                            </div>

                            <!-- Tombol Daftar -->
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200 mt-4">
                                Daftar Sekarang
                            </button>

                            <!-- Link ke Login -->
                            <div class="text-center mt-4">
                                <p class="text-sm text-gray-600">
                                    Sudah punya akun? 
                                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                                        Masuk di sini
                                    </a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- SISI KANAN: GAMBAR + LOGO SAJA (TANPA TEKS) -->
        <div class="hidden lg:block lg:w-1/2 relative">
            <!-- Gambar Background -->
            <img src="{{ asset('images/kecamatan_potrait.png') }}" 
                 alt="Background" 
                 class="absolute inset-0 w-full h-full object-cover">
            
            <!-- Overlay tipis -->
            <div class="absolute inset-0 bg-black/30"></div>

            <!-- LOGO DI SEBELAH KANAN ATAS (HANYA LOGO, TANPA TEKS) -->
            <div class="absolute top-8 right-8 z-10">
                <img src="{{ asset('images/logo_e-report.png') }}" 
                     alt="Logo" 
                     class="h-16 w-auto drop-shadow-lg">
            </div>
        </div>
    </div>

</body>
</html>