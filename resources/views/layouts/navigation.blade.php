<nav x-data="{ open: false }" class="bg-white border-r border-gray-100 h-screen flex flex-col w-64 shadow-sm fixed left-0 top-0">
    {{-- 1. Logo Section --}}
    <div class="p-6 flex items-center justify-center border-b border-gray-50 mb-4">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-12 w-auto fill-current text-indigo-600" />
        </a>
    </div>

    {{-- 2. Menu Utama (Diberikan flex-1 agar mengambil ruang tengah) --}}
    <div class="flex-1 px-4 space-y-2 overflow-y-auto">
        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] px-3 mb-4">Menu Utama</p>

        {{-- Dashboard Link --}}
        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
            <span class="mr-3 text-lg">📊</span> {{ __('Dashboard') }}
        </a>

        {{-- MENU KHUSUS ADMIN --}}
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.users.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all {{ request()->routeIs('admin.users.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                <span class="mr-3 text-lg">👥</span> {{ __('Data User') }}
            </a>

            <a href="{{ route('admin.bukus.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all {{ request()->routeIs('admin.bukus.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                <span class="mr-3 text-lg">📚</span> {{ __('Data Buku') }}
            </a>

            <a href="{{ route('admin.peminjaman.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all {{ request()->routeIs('admin.peminjaman.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                <span class="mr-3 text-lg">📥</span> {{ __('Peminjaman') }}
            </a>
        @endif

        {{-- MENU KHUSUS PEMINJAM --}}
        @if(Auth::user()->role === 'peminjam')
            <a href="{{ route('peminjam.bukus.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all {{ request()->routeIs('peminjam.bukus.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                <span class="mr-3 text-lg">🔍</span> {{ __('Cari Buku') }}
            </a>

            <a href="{{ route('peminjam.peminjaman.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all {{ request()->routeIs('peminjam.peminjaman.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                <span class="mr-3 text-lg">📜</span> {{ __('Riwayat Pinjam') }}
            </a>
        @endif
    </div>

    {{-- 3. Bagian Bawah: User Profile & Logout (Gunakan mt-auto) --}}
    <div class="mt-auto p-4 border-t border-gray-100 bg-gray-50/50">
        <div class="px-4 py-3 bg-white rounded-2xl shadow-sm border border-gray-100">
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Logged in as</p>
            <p class="text-xs font-bold text-indigo-600 truncate uppercase">{{ Auth::user()->name }} ({{ Auth::user()->role }})</p>
            
            <div class="mt-3 pt-3 border-t border-gray-100 flex flex-col gap-2">
                <a href="{{ route('profile.edit') }}" class="text-[10px] font-bold text-gray-500 hover:text-indigo-600 uppercase tracking-widest transition">Edit Profil</a>
                
                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                    @csrf
                </form>

                <button type="button" onclick="confirmLogout()" class="text-left text-[10px] font-bold text-red-500 hover:text-red-700 uppercase tracking-widest transition">
                    Log Out
                </button>
            </div>
        </div>
    </div>
</nav>

{{-- SweetAlert Script --}}
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
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        })
    }
</script>