<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Petugas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    {{ __("Selamat datang kembali, ") }} <strong>{{ Auth::user()->name }}</strong>!
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 shadow-sm rounded-lg">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 rounded-full">
                            <span class="text-2xl">⏳</span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600 uppercase font-bold">Menunggu Konfirmasi</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $count_pending }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 border-l-4 border-blue-400 p-6 shadow-sm rounded-lg">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-full">
                            <span class="text-2xl">📦</span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600 uppercase font-bold">Sedang Dipinjam</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $count_dipinjam }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-green-50 border-l-4 border-green-400 p-6 shadow-sm rounded-lg">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-full">
                            <span class="text-2xl">🛠️</span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600 uppercase font-bold">Total Stok Alat</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $count_alat }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 shadow-sm sm:rounded-lg border border-gray-200">
                <h3 class="text-lg font-bold mb-4">Aksi Cepat</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('petugas.peminjamans.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                        Kelola Peminjaman
                    </a>
                    <a href="{{ route('petugas.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Lihat Stok Alat
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>