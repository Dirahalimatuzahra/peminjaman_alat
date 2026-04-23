<nav x-data="{ open: false }" class="bg-white h-full flex flex-col shadow-sm">
    {{-- 1. Logo Section --}}
    <div class="p-8 flex items-center justify-center border-b border-gray-50 mb-6">
        <a href="{{ route('dashboard') }}" class="group transition-transform hover:scale-105">
            <x-application-logo class="block h-10 w-auto fill-current text-indigo-600" />
            <p class="text-[10px] font-black text-center mt-2 tracking-[0.3em] text-gray-900 uppercase">Sarpras<span class="text-indigo-600">App</span></p>
        </a>
    </div>

    {{-- 2. Menu Utama --}}
    <div class="flex-1 px-6 space-y-1 overflow-y-auto">
        <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] px-4 mb-4 opacity-50">Main Navigation</p>

        {{-- Dashboard Link --}}
        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-4 py-3.5 text-xs font-black uppercase tracking-widest rounded-2xl transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-gray-500 hover:bg-gray-50 hover:text-indigo-600' }}">
            <span class="mr-3 text-lg group-hover:scale-110 transition-transform">📊</span> 
            {{ __('Dashboard') }}
        </a>

        {{-- MENU KHUSUS ADMIN --}}
        @if(Auth::user()->role === 'admin')
            <div class="pt-4 pb-2">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] px-4 opacity-50">Administrator</p>
            </div>

            {{-- Nama diubah menjadi Kelola Anggota --}}
            <a href="{{ route('admin.users.index') }}" 
               class="flex items-center px-4 py-3.5 text-xs font-black uppercase tracking-widest rounded-2xl transition-all duration-200 group {{ request()->routeIs('admin.users.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-gray-500 hover:bg-gray-50 hover:text-indigo-600' }}">
                <span class="mr-3 text-lg group-hover:scale-110 transition-transform">👥</span> 
                {{ __('Kelola Anggota') }}
            </a>

            <a href="{{ route('admin.bukus.index') }}" 
               class="flex items-center px-4 py-3.5 text-xs font-black uppercase tracking-widest rounded-2xl transition-all duration-200 group {{ request()->routeIs('admin.bukus.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-gray-500 hover:bg-gray-50 hover:text-indigo-600' }}">
                <span class="mr-3 text-lg group-hover:scale-110 transition-transform">📚</span> 
                {{ __('Data Buku') }}
            </a>

            {{-- Menu Transaksi --}}
            <a href="{{ route('admin.peminjaman.index') }}" 
               class="flex items-center px-4 py-3.5 text-xs font-black uppercase tracking-widest rounded-2xl transition-all duration-200 group {{ request()->routeIs('admin.peminjaman.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-gray-500 hover:bg-gray-50 hover:text-indigo-600' }}">
                <span class="mr-3 text-lg group-hover:scale-110 transition-transform">💸</span> 
                {{ __('Transaksi') }}
            </a>

            <a href="{{ route('admin.users.index') }}" 
            class="flex items-center px-4 py-3 text-xs font-black uppercase tracking-widest rounded-2xl transition-all {{ request()->routeIs('admin.users.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-gray-500 hover:bg-gray-50' }}">
                <span class="mr-3 text-lg">🔍</span> {{ __('Cari Pengguna') }}
            </a>
        @endif

        {{-- MENU KHUSUS PEMINJAM (Siswa) --}}
        @if(Auth::user()->role === 'peminjam')
            <div class="pt-4 pb-2">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] px-4 opacity-50">Peminjam</p>
            </div>

            <a href="{{ route('peminjam.bukus.index') }}" 
               class="flex items-center px-4 py-3.5 text-xs font-black uppercase tracking-widest rounded-2xl transition-all duration-200 group {{ request()->routeIs('peminjam.bukus.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-gray-500 hover:bg-gray-50 hover:text-indigo-600' }}">
                <span class="mr-3 text-lg group-hover:scale-110 transition-transform">🔍</span> 
                {{ __('Cari Buku') }}
            </a>

            <a href="{{ route('peminjam.peminjaman.index') }}" 
               class="flex items-center px-4 py-3.5 text-xs font-black uppercase tracking-widest rounded-2xl transition-all duration-200 group {{ request()->routeIs('peminjam.peminjaman.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-gray-500 hover:bg-gray-50 hover:text-indigo-600' }}">
                <span class="mr-3 text-lg group-hover:scale-110 transition-transform">📜</span> 
                {{ __('Riwayat') }}
            </a>
        @endif
    </div>

    {{-- 3. Bagian Bawah: Logout --}}
    <div class="p-6 mt-auto">
        <div class="bg-gray-50 rounded-[2rem] p-2 border border-gray-100">
            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                @csrf
            </form>

            <button type="button" onclick="confirmLogout()" 
                class="w-full flex items-center justify-center px-4 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-red-500 hover:bg-red-500 hover:text-white rounded-3xl transition-all duration-300 group">
                <span class="mr-2 opacity-70 group-hover:rotate-12 transition-transform">🚪</span>
                {{ __('Keluar') }}
            </button>
        </div>
    </div>
</nav>