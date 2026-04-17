<nav x-data="{ open: false }" class="bg-white border-r border-gray-100 min-h-screen flex flex-col w-64 shadow-sm">
    <div class="p-6 flex items-center justify-center border-b border-gray-50 mb-4">
        <a href="{{ route('admin.dashboard') }}">
            <x-application-logo class="block h-12 w-auto fill-current text-indigo-600" />
        </a>
    </div>

    <div class="flex-1 px-4 space-y-2">
        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] px-3 mb-4">Menu Utama</p>

        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
            <span class="mr-3 text-lg">📊</span> {{ __('Dashboard') }}
        </a>

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
    </div>

    <div class="p-4 border-t border-gray-100 bg-gray-50/50">
        <div class="px-4 py-3 bg-white rounded-2xl shadow-sm border border-gray-100">
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Logged in as</p>
            <p class="text-xs font-bold text-indigo-600 truncate uppercase">{{ Auth::user()->name }}</p>
            
            <div class="mt-3 pt-3 border-t border-gray-100 flex flex-col gap-2">
                <a href="{{ route('profile.edit') }}" class="text-[10px] font-bold text-gray-500 hover:text-indigo-600 uppercase tracking-widest transition">Edit Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-[10px] font-bold text-red-500 hover:text-red-700 uppercase tracking-widest transition">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>