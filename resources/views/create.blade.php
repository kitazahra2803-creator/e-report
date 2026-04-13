<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Laporan</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">

<form action="/reports" method="POST" enctype="multipart/form-data"
      class="bg-white p-8 rounded shadow w-[400px]">

    @csrf

    <h2 class="text-2xl font-bold mb-4">Buat Laporan</h2>

    <input type="text" name="judul" placeholder="Judul"
           class="w-full mb-3 p-2 border rounded">

    <textarea name="deskripsi" placeholder="Deskripsi"
              class="w-full mb-3 p-2 border rounded"></textarea>

    <input type="text" name="lokasi" placeholder="Lokasi"
           class="w-full mb-3 p-2 border rounded">

    <input type="file" name="foto" class="mb-3">

    <button class="bg-blue-500 text-white px-4 py-2 rounded w-full">
        Kirim Laporan
    </button>

</form>

</body>
</html>