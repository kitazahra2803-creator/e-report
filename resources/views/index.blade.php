@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10">

    <h2 class="text-3xl font-bold mb-6 text-center">
        Daftar Laporan
    </h2>

    <a href="/reports/create"
    class="bg-green-500 text-white px-4 py-2 rounded-lg mb-6 inline-block">
    + Buat Laporan
    </a>

    @foreach($reports as $r)
    <div class="bg-white p-6 mb-4 rounded-xl shadow">

        <h3 class="text-xl font-bold text-blue-600">
            {{ $r->judul }}
        </h3>

        <p class="text-gray-700 mt-2">
            {{ $r->deskripsi }}
        </p>

        <p class="text-sm text-gray-500 mt-2">
            📍 {{ $r->lokasi }}
        </p>

    </div>
    @endforeach

</div>
@endsection