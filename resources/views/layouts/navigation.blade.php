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
            class="flex items-center px-4 py-3.5 text-xs font-black uppercase tracking-widest rounded-2xl transition-all duration-200 group {{ request()->routeIs('peminjam.bukus.*') || request()->routeIs('peminjam.peminjaman.create') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-gray-500 hover:bg-gray-50 hover:text-indigo-600' }}">
                <span class="mr-3 text-lg group-hover:scale-110 transition-transform">🔍</span> 
                {{ __('Cari Buku') }}
            </a>

            <a href="{{ route('peminjam.peminjaman.index') }}" 
            class="flex items-center px-4 py-3.5 text-xs font-black uppercase tracking-widest rounded-2xl transition-all duration-200 group {{ request()->routeIs('peminjam.peminjaman.index') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-gray-500 hover:bg-gray-50 hover:text-indigo-600' }}">
                <span class="mr-3 text-lg group-hover:scale-110 transition-transform">📜</span> 
                {{ __('Riwayat') }}
            </a>
        @endif
    </div>

    {{-- 3. Bagian Bawah: Logout --}}
    <div class="p-6 mt-auto">
        <div class="bg-gray-50 rounded-[2rem] p-2 border border-gray-100">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <button type="button" 
                    onclick="logoutConfirmation()"
                    class="w-full mt-auto flex items-center justify-center px-4 py-4 text-[10px] font-black uppercase tracking-[0.3em] rounded-[2rem] transition-all duration-300 bg-red-500 text-white shadow-lg shadow-red-100 hover:bg-red-600 hover:-translate-y-1 active:scale-95">
                <span class="mr-2">🚪</span>
                {{ __('Keluar') }}
            </button>

            <script>
            function logoutConfirmation() {
                Swal.fire({
                    title: 'Yakin ingin keluar?',
                    text: "Anda akan diarahkan kembali ke halaman utama.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4f46e5', // Warna Indigo sesuai tema Sidebar kamu
                    cancelButtonColor: '#ef4444', // Warna Merah
                    confirmButtonText: 'Ya, Keluar!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    background: '#ffffff',
                    borderRadius: '2rem',
                    customClass: {
                        title: 'font-black uppercase tracking-tighter text-2xl',
                        popup: 'rounded-[3rem] p-8',
                        confirmButton: 'rounded-2xl px-6 py-3 font-bold uppercase text-[10px] tracking-widest',
                        cancelButton: 'rounded-2xl px-6 py-3 font-bold uppercase text-[10px] tracking-widest'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logout-form').submit();
                    }
                })
            }
            </script>
        </div>
    </div>
</nav>