<nav x-data="{ open: false }" class="bg-[#A8DADC]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="container mx-auto px-6 py-4">
            <!-- LOGO DI TENGAH -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo_e-report.png') }}" 
                     alt="Logo E-Report" 
                     class="h-16 w-auto">
            </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                    @else
                        <!-- Saat belum login, tampilkan BERANDA, LAYANAN, TENTANG -->
                        <x-nav-link :href="url('/#beranda')" :active="request()->is('/')">
                            {{ __('BERANDA') }}
                        </x-nav-link>
                        
                        <x-nav-link :href="url('/#layanan')" :active="request()->is('/')">
                            {{ __('LAYANAN') }}
                        </x-nav-link>
                        
                        <x-nav-link :href="url('/#tentang')" :active="request()->is('/')">
                            {{ __('TENTANG') }}
                        </x-nav-link>
                    @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                <x-responsive-nav-link :href="url('/')" :active="request()->is('/')">
                    {{ __('BERANDA') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="url('/#beranda')" :active="request()->is('/')">
                    {{ __('BERANDA') }}
                </x-responsive-nav-link>
                
                <x-responsive-nav-link :href="url('/#layanan')" :active="request()->is('/')">
                    {{ __('LAYANAN') }}
                </x-responsive-nav-link>
                
                <x-responsive-nav-link :href="url('/#tentang')" :active="request()->is('/')">
                    {{ __('TENTANG') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="space-y-2 px-4">
                <a href="{{ route('login') }}" class="block text-gray-600 hover:text-gray-900 py-2">
                    {{ __('Masuk') }}
                </a>
                <a href="{{ route('register') }}" class="block bg-indigo-600 text-white hover:bg-indigo-700 text-center px-4 py-2 rounded-md">
                    {{ __('Daftar') }}
                </a>
            </div>
        </div>
        @endauth
    </div>
</nav>