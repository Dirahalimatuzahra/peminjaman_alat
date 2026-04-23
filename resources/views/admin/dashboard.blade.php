<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl text-gray-900 leading-tight tracking-tighter uppercase">
            {{ __('Panel Utama Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white overflow-hidden shadow-sm rounded-3xl p-6 border-b-8 border-blue-500 transition-transform hover:scale-[1.02]">
                    <div class="text-gray-400 font-black text-xs uppercase tracking-widest mb-1">Total Pengguna</div>
                    <div class="text-4xl font-black text-gray-900">{{ $total_user }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-3xl p-6 border-b-8 border-green-500 transition-transform hover:scale-[1.02]">
                    <div class="text-gray-400 font-black text-xs uppercase tracking-widest mb-1">Total Buku</div>
                    <div class="text-4xl font-black text-gray-900">{{ $total_buku }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-3xl p-6 border-b-8 border-orange-500 transition-transform hover:scale-[1.02]">
                    <div class="text-gray-400 font-black text-xs uppercase tracking-widest mb-1">Peminjaman Aktif</div>
                    <div class="text-4xl font-black text-gray-900">{{ $total_peminjaman }}</div>
                </div>
            </div>

            <h3 class="font-black text-gray-400 uppercase text-xs tracking-[0.2em] mb-6">Menu Navigasi Pengelolaan</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
                <a href="{{ route('admin.bukus.index') }}" class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:bg-indigo-600 group transition-all">
                    <div class="text-indigo-600 group-hover:text-white mb-3">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="block font-black text-gray-900 group-hover:text-white uppercase text-xs tracking-tighter">Data Buku</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:bg-emerald-600 group transition-all">
                    <div class="text-emerald-600 group-hover:text-white mb-3">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <span class="block font-black text-gray-900 group-hover:text-white uppercase text-xs tracking-tighter">Kelola Anggota</span>
                </a>

                <a href="{{ route('admin.peminjaman.index') }}" class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:bg-amber-500 group transition-all">
                    <div class="text-amber-500 group-hover:text-white mb-3">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <span class="block font-black text-gray-900 group-hover:text-white uppercase text-xs tracking-tighter">Transaksi</span>
                </a>

            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-50 bg-gray-50/50">
                    <h3 class="font-black text-gray-800 uppercase text-sm tracking-widest flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-red-500 animate-pulse"></span>
                        Log Aktivitas Terbaru
                    </h3>
                </div>
                <div class="p-8">
                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            <li class="relative pb-8">
                                <div class="relative flex space-x-4">
                                    <span class="h-10 w-10 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-600 text-sm font-bold">U</span>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-2">
                                        <p class="text-sm text-gray-500 font-medium">Admin menambahkan user baru <span class="font-black text-gray-900 italic">Petugas_Sarpras</span></p>
                                        <div class="whitespace-nowrap text-right text-xs text-gray-400 font-bold uppercase">Baru saja</div>
                                    </div>
                                </div>
                            </li>
                            <li class="relative pb-8">
                                <div class="relative flex space-x-4">
                                    <span class="h-10 w-10 rounded-2xl bg-green-100 flex items-center justify-center text-green-600 text-sm font-bold">A</span>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-2">
                                        <p class="text-sm text-gray-500 font-medium">Stok Buku <span class="font-black text-gray-900 italic">Proyektor Epson</span> diperbarui</p>
                                        <div class="whitespace-nowrap text-right text-xs text-gray-400 font-bold uppercase">10 mnt lalu</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>