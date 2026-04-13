<x-app-layout>
    <x-slot name="header">
        <diV class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard Masyarakat
                </h2>
                <p class="text-sm text-gray-500">{{ Auth::user()->name }} - Sindang</p>
            </div>
            <!-- Right side menu -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <!-- Settings Dropdown (untuk user yang sudah login) -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <!-- Tombol untuk user yang belum login -->
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                            {{ __('Masuk') }}
                        </a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white hover:bg-indigo-700 px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                            {{ __('Daftar') }}
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="w-full px-6">
            
            <!-- STATISTIK CARDS -->
            <div class="flex justify-center mt-6">
                <div class="flex gap-6 flex-wrap justify-center">

                    <!-- Total -->
                    <div class="rounded-lg flex flex-col justify-center items-center shadow"
                        style="width: 290px; height: 180px; background-color: #FFFDE1;">
                        <div class="text-blue-500 text-3xl mb-2">📄</div>
                        <p class="text-2xl font-bold">{{ $totalReports ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Total Laporan</p>
                    </div>

                    <!-- Menunggu -->
                    <div class="rounded-lg flex flex-col justify-center items-center shadow"
                        style="width: 290px; height: 180px; background-color: #FFFDE1;">
                        <div class="text-yellow-500 text-3xl mb-2">⏱️</div>
                        <p class="text-2xl font-bold">{{ $waitingReports ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Menunggu</p>
                    </div>

                    <!-- Diproses -->
                    <div class="rounded-lg flex flex-col justify-center items-center shadow"
                        style="width: 290px; height: 180px; background-color: #FFFDE1;">
                        <div class="text-red-500 text-3xl mb-2">❗</div>
                        <p class="text-2xl font-bold">{{ $processedReports ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Diproses</p>
                    </div>

                    <!-- Selesai -->
                    <div class="rounded-lg flex flex-col justify-center items-center shadow"
                        style="width: 290px; height: 180px; background-color: #FFFDE1;">
                        <div class="text-green-500 text-3xl mb-2">✅</div>
                        <p class="text-2xl font-bold">{{ $completedReports ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Selesai</p>
                    </div>

                </div>
            </div>
            <div class="flex justify-center mt-6 mb-10">
            <div class="w-full px-6 space-y-10">
                
            <!-- RIWAYAT LAPORAN SAYA -->
            <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color: #FFFDE1;">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-800">Riwayat Laporan Saya</h3>
                    <p class="text-sm text-gray-500">Daftar laporan yang telah Anda buat</p>
                </div>
                
                <div class="p-6">
                    @if(isset($reports) && count($reports) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Laporan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($reports as $report)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $report->created_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $report->judul }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $report->lokasi }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                @if($report->status == 'selesai') bg-green-100 text-green-700
                                                @elseif($report->status == 'diproses') bg-blue-100 text-blue-700
                                                @else bg-yellow-100 text-yellow-700 @endif">
                                                {{ ucfirst($report->status ?? 'Menunggu') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <a href="{{ route('reports.show', $report->id) }}" class="text-blue-600 hover:text-blue-800">Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- TAMPILAN KOSONG -->
                        <div class="text-center py-12">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 mb-4">Anda belum memiliki laporan</p>
                            <a href="{{ route('reports.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                                Buat Laporan Baru
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>