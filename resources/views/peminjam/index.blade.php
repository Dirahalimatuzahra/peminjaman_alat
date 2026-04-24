<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-sm text-gray-400 uppercase tracking-[0.5em]">
            {{ __('Aktivitas Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[3rem] p-8 md:p-12">
                
                <div class="mb-10 flex justify-between items-end">
                    <div>
                        <h3 class="text-3xl font-black text-gray-900 uppercase tracking-tighter">Status Pinjaman Saya</h3>
                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-[0.2em] mt-2">Pantau proses pengajuan dan pengembalian buku di bawah ini.</p>
                    </div>
                    <a href="{{ route('peminjam.bukus.index') }}" class="text-[10px] font-black text-blue-500 uppercase tracking-widest hover:text-blue-700 transition-colors">
                        + Pinjam Buku Lagi
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead>
                            <tr>
                                <th class="px-6 py-4 text-left text-[9px] font-black text-gray-300 uppercase tracking-[0.2em]">No</th>
                                <th class="px-6 py-4 text-left text-[9px] font-black text-gray-300 uppercase tracking-[0.2em]">Informasi Buku</th>
                                <th class="px-6 py-4 text-center text-[9px] font-black text-gray-300 uppercase tracking-[0.2em]">Jumlah</th>
                                <th class="px-6 py-4 text-left text-[9px] font-black text-gray-300 uppercase tracking-[0.2em]">Periode & Pengembalian</th>
                                <th class="px-6 py-4 text-right text-[9px] font-black text-gray-300 uppercase tracking-[0.2em]">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($peminjamans as $p)
                            <tr class="group hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-8 whitespace-nowrap text-[10px] font-bold text-gray-300">{{ $loop->iteration }}</td>
                                <td class="px-6 py-8">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black text-gray-900 uppercase tracking-tight">{{ $p->buku->judul ?? $p->buku->nama_buku }}</span>
                                        <span class="text-[8px] text-gray-400 uppercase font-bold mt-1">Kategori: {{ $p->buku->kategori->nama_kategori ?? 'Umum' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-8 text-center">
                                    <span class="px-3 py-1 bg-gray-100 rounded-lg text-[10px] font-black text-gray-900">{{ $p->jumlah }} Eks</span>
                                </td>
                                <td class="px-6 py-8 whitespace-nowrap text-[10px] font-bold uppercase">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-gray-400">Pinjam: {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d/m/Y') }}</span>
                                        
                                        @if($p->status == 'dikembalikan')
                                            <span class="text-blue-500 font-black">Dikembalikan: {{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d/m/Y') }}</span>
                                        @else
                                            <span class="text-amber-500 italic font-medium">Batas Kembali: {{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d/m/Y') }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-8 text-right whitespace-nowrap">
                                    @if($p->status == 'pending')
                                        <span class="px-4 py-2 rounded-full text-[8px] font-black uppercase tracking-widest bg-amber-50 text-amber-500 border border-amber-100">
                                            Menunggu
                                        </span>
                                    @elseif($p->status == 'dipinjam')
                                        <span class="px-4 py-2 rounded-full text-[8px] font-black uppercase tracking-widest bg-green-50 text-green-500 border border-green-100 shadow-sm">
                                            Sedang Dipinjam
                                        </span>
                                    @elseif($p->status == 'ditolak')
                                        <span class="px-4 py-2 rounded-full text-[8px] font-black uppercase tracking-widest bg-red-50 text-red-400 border border-red-100">
                                            Ditolak
                                        </span>
                                    @elseif($p->status == 'dikembalikan')
                                        <span class="px-4 py-2 rounded-full text-[8px] font-black uppercase tracking-widest bg-blue-50 text-blue-500 border border-blue-100">
                                            Selesai / Kembali
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center justify-center opacity-30">
                                        <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                        <p class="text-[10px] font-black uppercase tracking-[0.3em] italic">Belum ada riwayat aktivitas peminjaman.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>