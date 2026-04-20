<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LEFT SIDE -->
            <div class="flex">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo.jfif') }}" style="height:45px;">
                    </a>
                </div>

                <!-- MENU -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    {{-- DASHBOARD --}}
                    <x-nav-link :href="route('dashboard')" 
                        :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    {{-- ================= ADMIN ================= --}}
                    @if(Auth::user()->role == 'admin')
                        <x-nav-link :href="route('kategori.index')">Kategori</x-nav-link>
                        <x-nav-link :href="route('obat.index')">Obat</x-nav-link>
                        <x-nav-link :href="route('analisis.rop')">Analisis Safety Stok & ROP</x-nav-link>
                        <x-nav-link :href="route('laporan.index')">Laporan</x-nav-link>
                    @endif

                    {{-- ================= KASIR ================= --}}
                    @if(Auth::user()->role == 'kasir')
                        <x-nav-link :href="route('transaksi-keluar.index')">Transaksi Keluar</x-nav-link>
                        <x-nav-link :href="route('laporan.index')">Laporan</x-nav-link>
                    @endif

                    {{-- ================= GUDANG ================= --}}
                    @if(str_contains(Auth::user()->role, 'gudang'))
                        <x-nav-link :href="route('supplier.index')">Supplier</x-nav-link>
                        <x-nav-link :href="route('pemesanan.index')">Pemesanan Obat</x-nav-link>
                        <x-nav-link :href="route('laporan.index')">Laporan</x-nav-link>
                    @endif

                    {{-- ================= OWNER ================= --}}
                    @if(Auth::user()->role == 'owner')
                        <x-nav-link :href="route('laporan.index')">Laporan</x-nav-link>
                    @endif

                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">

                    <!-- 🔥 TRIGGER (AVATAR STYLE GOOGLE) -->
                    <x-slot name="trigger">

                        @php
                            $foto = Auth::user()->foto 
                                ? asset('storage/foto/' . Auth::user()->foto) 
                                : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name);
                        @endphp

                        <button class="inline-flex items-center gap-2 px-3 py-2 text-sm bg-white hover:text-gray-700">

                            <img src="{{ $foto }}" 
                                width="35" height="35" 
                                class="rounded-full border shadow">

                            <div class="text-left">
                                <div class="font-medium text-gray-800">
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ Auth::user()->role }}
                                </div>
                            </div>

                        </button>

                    </x-slot>

                    <!-- 🔥 DROPDOWN CONTENT -->
                    <x-slot name="content">

                        <div class="px-4 py-3 border-b text-center">
                            <img src="{{ $foto }}" 
                                width="60" height="60" 
                                class="rounded-full mx-auto mb-2 shadow">

                            <div class="font-semibold">{{ Auth::user()->name }}</div>
                            <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                             Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                 Logout
                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>
            </div>

        </div>
    </div>

</nav>