<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aktivitas Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8">
                    <div class="mb-6">
                        <h3 class="text-xl font-black text-gray-900 uppercase tracking-tighter">Status Pinjaman Saya</h3>
                        <p class="text-xs text-gray-500 uppercase font-bold tracking-widest mt-1">Pantau proses pengajuan dan pengembalian buku di bawah ini.</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-separate border-spacing-y-3">
                            <thead class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                <tr>
                                    <th class="px-6 py-4">No</th>
                                    <th class="px-6 py-4">Informasi Buku</th>
                                    <th class="px-6 py-4 text-center">Jumlah</th>
                                    <th class="px-6 py-4">Tgl Pinjam</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs font-bold">
                                @forelse ($peminjamans as $item)
                                <tr class="bg-white border border-gray-100 shadow-sm hover:bg-indigo-50 transition duration-200">
                                    <td class="px-6 py-4 text-gray-400 rounded-l-xl">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-gray-900 uppercase">{{ $item->buku->nama_buku ?? 'Buku Dihapus' }}</span>
                                            <span class="text-[9px] text-gray-400 font-normal">Kategori: {{ $item->buku->kategori->nama_kategori ?? 'Umum' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="bg-gray-100 px-2 py-1 rounded">{{ $item->jumlah }} Eks</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-center rounded-r-xl">
                                        @if($item->status == 'pending')
                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest italic">Menunggu Persetujuan</span>
                                        @elseif($item->status == 'dipinjam')
                                            <span class="bg-indigo-600 text-white px-3 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest shadow-lg shadow-indigo-100">Sedang Dipinjam</span>
                                        @elseif($item->status == 'kembali')
                                            <span class="bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest">Sudah Dikembalikan</span>
                                        @else
                                            <span class="bg-red-100 text-red-700 px-3 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest">Ditolak Petugas</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center bg-gray-50 rounded-2xl border-2 border-dashed border-gray-100 text-gray-400 font-bold uppercase tracking-widest">
                                        Belum ada aktivitas peminjaman.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>