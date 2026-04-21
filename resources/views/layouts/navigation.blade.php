<nav x-data="{ open: false }" class="bg-white border-r border-gray-100 min-h-screen flex flex-col w-64 shadow-sm">
    {{-- Logo Section --}}
    <div class="p-6 flex items-center justify-center border-b border-gray-50 mb-4">
        {{-- Menggunakan route('dashboard') agar redirect otomatis sesuai role --}}
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-12 w-auto fill-current text-indigo-600" />
        </a>
    </div>

    {{-- Menu Utama --}}
    <div class="flex-1 px-4 space-y-2">
        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] px-3 mb-4">Menu Utama</p>

        {{-- Dashboard Link (Dinamis untuk semua role) --}}
        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all {{ request()->routeIs('*.dashboard') || request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
            <span class="mr-3 text-lg">📊</span> {{ __('Dashboard') }}
        </a>

        {{-- MENU KHUSUS ADMIN --}}
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.users.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all {{ request()->routeIs('admin.users.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                <span class="mr-3 text-lg">👥</span> {{ __('Data User') }}
            </a>

            <a href="{{ route('admin.alats.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all {{ request()->routeIs('admin.alats.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                <span class="mr-3 text-lg">🔧</span> {{ __('Data Alat') }}
            </a>

            <a href="{{ route('admin.kategoris.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all {{ request()->routeIs('admin.kategoris.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                <span class="mr-3 text-lg">📂</span> {{ __('Kategori') }}
            </a>

            <a href="{{ route('admin.peminjamans.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all {{ request()->routeIs('admin.peminjamans.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                <span class="mr-3 text-lg">📥</span> {{ __('Peminjaman') }}
            </a>

            <a href="{{ route('admin.pengembalians.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all {{ request()->routeIs('admin.pengembalians.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                <span class="mr-3 text-lg">📤</span> {{ __('Pengembalian') }}
            </a>
        @endif

        {{-- MENU KHUSUS PEMINJAM --}}
        @if(Auth::user()->role === 'peminjam')
            <a href="{{ route('peminjam.alats.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all {{ request()->routeIs('peminjam.alats.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                <span class="mr-3 text-lg">🔍</span> {{ __('Cari Alat') }}
            </a>

            <a href="{{ route('peminjam.peminjamans.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all {{ request()->routeIs('peminjam.peminjamans.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                <span class="mr-3 text-lg">📜</span> {{ __('Riwayat Pinjam') }}
            </a>
        @endif
    </div>

    {{-- User Profile & Logout --}}
    <div class="p-4 border-t border-gray-100 bg-gray-50/50">
        <div class="px-4 py-3 bg-white rounded-2xl shadow-sm border border-gray-100">
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Logged in as</p>
            <p class="text-xs font-bold text-indigo-600 truncate uppercase">{{ Auth::user()->name }}</p>
            
            <div class="mt-3 pt-3 border-t border-gray-100 flex flex-col gap-2">
                <a href="{{ route('profile.edit') }}" class="text-[10px] font-bold text-gray-500 hover:text-indigo-600 uppercase tracking-widest transition">Edit Profil</a>
                
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>

                <button type="button" onclick="confirmLogout()" class="text-left text-[10px] font-bold text-red-500 hover:text-red-700 uppercase tracking-widest transition">
                    Log Out
                </button>
            </div>
        </div>
    </div>
</nav>

{{-- Script SweetAlert2 untuk Konfirmasi Logout --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'KELUAR SISTEM?',
            text: "Apakah Anda yakin ingin mengakhiri sesi ini?",
            icon: 'question',
            width: '380px',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'YA, KELUAR',
            cancelButtonText: 'BATAL',
            reverseButtons: true,
            customClass: {
                title: 'text-lg font-black italic tracking-widest',
                htmlContainer: 'text-[11px] font-medium py-2',
                confirmButton: 'text-[10px] py-2 px-6 font-bold uppercase tracking-widest rounded-lg',
                cancelButton: 'text-[10px] py-2 px-6 font-bold uppercase tracking-widest rounded-lg'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        })
    }
</script>