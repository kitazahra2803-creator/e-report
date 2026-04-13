<x-app-layout>

    <!-- HEADER -->
    <x-slot name="header">
        <div class="bg-[#7fc8c6] px-8 py-6 shadow">
            <div class="flex items-center justify-between">

                <!-- KIRI -->
                <div>
                    <h1 class="text-2xl font-bold text-white">
                        Dashboard Masyarakat
                    </h1>
                    <p class="text-white text-sm">
                        {{ Auth::user()->name }} - Sindang
                    </p>
                </div>

                <!-- KANAN -->
                <div class="flex items-center gap-4">

                    <!-- DROPDOWN -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-white text-sm font-medium focus-outline">
                                {{ Auth::user()->name }}
                                <svg class="ms-2 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                    <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="#"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>

                    <!-- LOGO -->
                    <img src="{{ asset('images/logo_e-report.png') }}" 
                         class="h-12 bg-white px-2 py-1 rounded shadow">
                </div>

            </div>
        </div>
    </x-slot>

    <!-- CONTENT -->
    <div class="py-10">
        <div class="w-full px-6">

            <!-- CARD STATISTIK -->
            <div class="flex justify-center mt-4">
                <div class="flex gap-6 flex-wrap justify-center">

                    <!-- Total -->
                    <div class="rounded-xl shadow flex flex-col justify-center items-center"
                        style="width: 240px; height: 140px; background-color: #FFFDE1;">
                        <div class="text-blue-500 text-2xl mb-1">📄</div>
                        <p class="text-xl font-bold">{{ $totalReports ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Total Laporan</p>
                    </div>

                    <!-- Menunggu -->
                    <div class="rounded-xl shadow flex flex-col justify-center items-center"
                        style="width: 240px; height: 140px; background-color: #FFFDE1;">
                        <div class="text-yellow-500 text-2xl mb-1">⏱️</div>
                        <p class="text-xl font-bold">{{ $waitingReports ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Menunggu</p>
                    </div>

                    <!-- Diproses -->
                    <div class="rounded-xl shadow flex flex-col justify-center items-center"
                        style="width: 240px; height: 140px; background-color: #FFFDE1;">
                        <div class="text-red-500 text-2xl mb-1">❗</div>
                        <p class="text-xl font-bold">{{ $processedReports ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Diproses</p>
                    </div>

                    <!-- Selesai -->
                    <div class="rounded-xl shadow flex flex-col justify-center items-center"
                        style="width: 240px; height: 140px; background-color: #FFFDE1;">
                        <div class="text-green-500 text-2xl mb-1">😊</div>
                        <p class="text-xl font-bold">{{ $completedReports ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Selesai</p>
                    </div>

                </div>
            </div>

            <!-- BUTTON -->
            <div class="flex justify-start mt-6 px-2">
                <a href="{{ route('reports.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full shadow flex items-center gap-2">
                    <span class="text-lg">+</span> Buat Laporan Baru
                </a>
            </div>

            <!-- RIWAYAT -->
            <div class="mt-6 px-2">
                <div class="shadow rounded-xl" style="background-color: #FFFDE1;">

                    <!-- Header -->
                    <div class="px-6 py-4 border-b">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Riwayat Laporan Saya
                        </h3>
                        <p class="text-sm text-gray-500">
                            Daftar laporan yang telah Anda buat
                        </p>
                    </div>

                    <!-- Isi -->
                    <div class="p-6">

                        @if(isset($reports) && count($reports) > 0)

                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="text-left text-gray-600 border-b">
                                        <th class="py-2">Tanggal</th>
                                        <th>Judul</th>
                                        <th>Lokasi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reports as $report)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-2">
                                            {{ $report->created_at->format('d/m/Y') }}
                                        </td>
                                        <td>{{ $report->judul }}</td>
                                        <td>{{ $report->lokasi }}</td>
                                        <td>
                                            <span class="px-2 py-1 text-xs rounded-full
                                                @if($report->status == 'selesai') bg-green-100 text-green-700
                                                @elseif($report->status == 'diproses') bg-blue-100 text-blue-700
                                                @else bg-yellow-100 text-yellow-700 @endif">
                                                {{ ucfirst($report->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('reports.show', $report->id) }}" 
                                               class="text-blue-600 hover:underline">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @else

                        <!-- EMPTY -->
                        <div class="text-center py-12">
                            <div class="text-5xl mb-4">📁</div>
                            <p class="text-gray-600 mb-4">
                                Anda belum memiliki laporan
                            </p>
                            <a href="{{ route('reports.create') }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                                Buat Laporan Baru
                            </a>
                        </div>

                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>