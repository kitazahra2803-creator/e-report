<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - E-Report</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen relative overflow-hidden">

    <!-- Background -->
    <div class="absolute inset-0 -z-10">
        <img src="{{ asset('images/login.jpeg') }}"
             class="w-full h-full object-cover">

        <div class="absolute inset-0 bg-black/40"></div>
    </div>

    <!-- Container -->
    <div class="min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-md bg-white/20 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/30 p-8">

            <!-- Logo -->
            <div class="flex justify-center mb-5">
                <img src="{{ asset('images/logo_e-report.png') }}"
                     class="h-20 bg-white rounded-2xl p-2 shadow-lg">
            </div>

            <!-- Title -->
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-white">
                    Forgot Password
                </h1>

                <p class="text-sm text-white/80 mt-2">
                    Masukkan email Anda untuk menerima link reset password
                </p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-xl text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-5">
                    <label class="block text-white text-sm mb-2 font-medium">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        required
                        autofocus
                        value="{{ old('email') }}"
                        placeholder="Masukkan email..."
                        class="w-full px-4 py-3 rounded-xl bg-white/80 border border-white/50 focus:outline-none focus:ring-2 focus:ring-cyan-400"
                    >
                </div>

                <!-- Button -->
                <button
                    type="submit"
                    class="w-full bg-cyan-500 hover:bg-cyan-600 transition text-white font-semibold py-3 rounded-xl shadow-lg"
                >
                    Kirim Link Reset Password
                </button>

                <!-- Back -->
                <div class="text-center mt-5">
                    <a href="{{ route('login') }}"
                       class="text-white/90 hover:text-white text-sm">
                        ← Kembali ke Login
                    </a>
                </div>

            </form>

        </div>

    </div>

</body>
</html>