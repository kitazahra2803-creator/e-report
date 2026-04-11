<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - E-Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="min-h-screen relative">

    <!-- BACKGROUND GAMBAR -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/kecamatan.jpeg') }}" 
             alt="Background" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/40"></div>
    </div>

    <!-- TOP BAR -->
    <div class="relative z-10 bg-[#A8DADC] text-center text-xs py-2 tracking-wide font-semibold">
        LAPOR KERUSAKAN FASILITAS UMUM
    </div>

    <!-- KONTEN LOGIN DI TENGAH -->
    <div class="relative z-10 flex items-center justify-center min-h-[calc(100vh-36px)] py-12">
        <div class="w-full max-w-md mx-4">
            
            <!-- Card Login -->
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden relative">
                
                <!-- Tombol Close/Keluar -->
                <a href="{{ url('/') }}" class="absolute top-4 right-4 z-10 text-white hover:text-gray-200 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </a>

                <!-- Header dengan LOGO SAJA (tanpa teks E-Report) -->
                <div class="bg-gradient-to-r from-blue-400 to-blue-500 px-8 py-6 text-center">
                    <div class="flex justify-center">
                        <img src="{{ asset('images/logo_e-report.png') }}" 
                             alt="Logo E-Report" 
                             class="h-20 w-auto drop-shadow-lg">
                    </div>
                </div>
                
                <!-- Body Form -->
                <div class="px-8 py-8">
                    
                    <!-- Title -->
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">User Login</h2>
                        <p class="text-sm text-gray-500">Masuk/Daftar</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="space-y-5">
                            <!-- Username -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-1">Username</label>
                                <input type="text" name="username" value="{{ old('username') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                                       placeholder="Masukkan username">
                                @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Alamat email/nomor telepon -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-1">Alamat email/nomor telepon</label>
                                <input type="text" name="email_or_phone" value="{{ old('email_or_phone') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                                       placeholder="Masukkan email/nomor telepon">
                                @error('email_or_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-1">Password</label>
                                <input type="password" name="password" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                                       placeholder="Password">
                                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Lupa Password -->
                            <div class="text-right">
                                <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:text-blue-600 hover:underline">
                                    Lupa Password/Reset Password?
                                </a>
                            </div>

                            <!-- Tombol Masuk -->
                            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-lg transition duration-200">
                                Masuk
                            </button>

                            <!-- Belum Punya Akun -->
                            <div class="text-center mt-4">
                                <p class="text-sm text-gray-600">
                                    Belum Punya Akun? 
                                    <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-600 font-semibold">
                                        Daftar Sekarang!
                                    </a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>