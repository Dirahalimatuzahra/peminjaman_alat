<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Ringkasan Sistem') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 border-b-4 border-blue-500">
                    <div class="text-gray-500 font-bold text-xs uppercase">Total Pengguna</div>
                    <div class="text-3xl font-black">{{ $total_user }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 border-b-4 border-green-500">
                    <div class="text-gray-500 font-bold text-xs uppercase">Total Buku</div>
                    <div class="text-3xl font-black">{{ $total_buku }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 border-b-4 border-orange-500">
                    <div class="text-gray-500 font-bold text-xs uppercase">Peminjaman Aktif</div>
                    <div class="text-3xl font-black">{{ $total_peminjaman }}</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100 bg-gray-50 rounded-t-2xl">
                    <h3 class="font-bold text-gray-800 italic uppercase text-sm tracking-widest">Log Aktivitas Terbaru</h3>
                </div>
                <div class="p-6">
                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            <li class="relative pb-8">
                                <div class="relative flex space-x-3">
                                    <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-xs">U</span>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                        <p class="text-sm text-gray-500">Admin menambahkan user baru <span class="font-medium text-gray-900">Petugas_Sarpras</span></p>
                                        <div class="whitespace-nowrap text-right text-xs text-gray-400">Baru saja</div>
                                    </div>
                                </div>
                            </li>
                            <li class="relative pb-8">
                                <div class="relative flex space-x-3">
                                    <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center text-white text-xs">A</span>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                        <p class="text-sm text-gray-500">Stok Buku <span class="font-medium text-gray-900">Proyektor Epson</span> diperbarui</p>
                                        <div class="whitespace-nowrap text-right text-xs text-gray-400">10 mnt lalu</div>
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
