<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - E-Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen relative">

<!-- HEADER -->
<div class="bg-[#7fc8c6] px-8 py-6 shadow">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white"></h1>
            <p class="text-white text-sm"></p>
        </div>
        <img src="{{ asset('images/logo_e-report.png') }}" class="h-12 bg-white px-2 py-1 rounded shadow">
    </div>
</div>

<!-- BACKGROUND -->
<div class="absolute inset-0 -z-10">
    <img src="{{ asset('images/kecamatan.jpeg') }}" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/30"></div>
</div>

<!-- FORM -->
<div class="flex justify-center mt-10">
    <div class="w-[600px] bg-white/70 backdrop-blur-md rounded-2xl p-6 shadow-xl">
        <h3 class="font-semibold text-base mb-1">Forgot Password</h3>
        <p class="text-sm text-gray-600 mb-4">Masukkan email Anda untuk menerima link reset password</p>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="space-y-3 text-sm">

                <!-- EMAIL -->
                <div>
                    <label class="font-semibold">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full mt-1 bg-white rounded-lg px-4 py-2 border">
                </div>

                <!-- BUTTON -->
                <div class="flex justify-between mt-4">
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-gray-300 rounded-lg">← Kembali ke Login</a>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Kirim Link Reset Password</button>
                </div>

            </div>
        </form>
    </div>
</div>

</body>
</html>
