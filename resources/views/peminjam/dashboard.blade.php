    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Peminjam') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Ucapan Selamat Datang --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8 mb-6 border border-gray-100">
                <h3 class="text-2xl font-black text-indigo-600 uppercase tracking-tighter">
                    Selamat Datang, {{ Auth::user()->name }}!
                </h3>
                <p class="text-sm text-gray-500 mt-1 uppercase font-bold tracking-widest">
                    Pantau peminjaman alat sekolah kamu di sini.
                </p>
            </div>

            {{-- Kartu Statistik Ramping --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-50 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Total Pinjam</p>
                        <h4 class="text-3xl font-black text-gray-900 mt-1">{{ $totalPinjam }}</h4>
                    </div>
                    <div class="bg-blue-50 text-blue-500 p-4 rounded-xl text-2xl">📚</div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-50 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Sedang Dibawa</p>
                        <h4 class="text-3xl font-black text-indigo-600 mt-1">{{ $sedangDipinjam }}</h4>
                    </div>
                    <div class="bg-indigo-50 text-indigo-500 p-4 rounded-xl text-2xl">📥</div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-50 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Alat Tersedia</p>
                        <h4 class="text-3xl font-black text-green-600 mt-1">{{ $alatTersedia }}</h4>
                    </div>
                    <div class="bg-green-50 text-green-500 p-4 rounded-xl text-2xl">🔧</div>
                </div>
            </div>

            {{-- Informasi Cepat --}}
            <div class="mt-8 bg-indigo-600 rounded-2xl p-8 text-white flex flex-col md:flex-row items-center justify-between shadow-lg shadow-indigo-100">
                <div class="mb-4 md:mb-0">
                    <h4 class="text-lg font-black uppercase tracking-widest">Butuh alat praktik?</h4>
                    <p class="text-indigo-100 text-sm mt-1">Lihat stok alat yang tersedia sekarang dan hubungi petugas di laboratorium.</p>
                </div>
                <a href="{{ route('peminjam.alats.index') }}" class="bg-white text-indigo-600 px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-indigo-50 transition-all">
                    Cari Alat Sekarang
                </a>
            </div>
        </div>
    </div>
</x-app-layout>