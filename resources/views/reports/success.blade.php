<!DOCTYPE html>  <html lang="id">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Laporan Terkirim</title>  
    <script src="https://cdn.tailwindcss.com"></script>  
</head>  <body class="min-h-screen relative">  <!-- HEADER -->  <div class="bg-[#7fc8c6] px-8 py-6 shadow">  
    <div class="flex items-center justify-between">  <div>  
        <h1 class="text-2xl font-bold text-white">  
            E-Report  
        </h1>  
        <p class="text-white text-sm">  
            Laporan Masyarakat  
        </p>  
    </div>  

    <img src="{{ asset('images/logo_e-report.png') }}"   
         class="h-12 bg-white px-2 py-1 rounded shadow">  
</div>

</div>  <!-- BACKGROUND -->  <div class="absolute inset-0 -z-10">  
    <img src="{{ asset('images/kecamatan.jpeg') }}"  
         class="w-full h-full object-cover">  
    <div class="absolute inset-0 bg-black/30"></div>  
</div>  <!-- CONTENT -->  <div class="flex justify-center items-center mt-20">  <!-- CARD -->  
<div class="w-[420px] bg-white/70 backdrop-blur-md rounded-2xl p-6 shadow-xl text-center">  

    <!-- ICON -->  
    <svg class="w-12 h-12 text-green-500 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="2"  
         viewBox="0 0 24 24">  
        <path stroke-linecap="round" stroke-linejoin="round"  
              d="M5 13l4 4L19 7"/>  
    </svg>  

    <!-- TITLE -->  
    <h2 class="text-lg font-semibold mb-2">  
        Laporan Terkirim!  
    </h2>  

    <!-- DESC -->  
    <p class="text-sm text-gray-600 mb-5">  
        Terima kasih sudah melapor. Tim kami akan segera memverifikasi laporan Anda.  
    </p>  

    <!-- BUTTON -->  
    <div class="flex justify-center gap-3">  

        <!-- KEMBALI -->  
        <a href="{{ route('dashboard') }}"  
           class="px-4 py-2 bg-gray-300 rounded-lg text-sm">  
            Kembali  
        </a>  

        <!-- DETAIL -->  
        <a href="{{ route('reports.show', $report->id) }}"  
           class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm">  
            Cek Detail Laporan  
        </a>  

    </div>  

</div>

</div>  </body>  
</html>  