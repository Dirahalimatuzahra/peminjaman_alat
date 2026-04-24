<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xs text-gray-400 uppercase tracking-[0.5em]">
            {{ __('Manajemen Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] p-8 border border-gray-100">
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
                    <div>
                        <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter italic">Daftar Peminjaman</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Pantau & validasi peminjaman alat sekolah</p>
                    </div>
                </div>

                <div class="overflow-x-auto border border-gray-50 rounded-3xl">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50/50">
                            <tr class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">
                                <th class="px-6 py-5 text-left">Peminjam</th>
                                <th class="px-6 py-5 text-left">Item / Alat</th>
                                <th class="px-6 py-5 text-center">Jumlah</th>
                                <th class="px-6 py-5 text-center">Status</th>
                                <th class="px-6 py-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 bg-white">
                            @forelse ($peminjaman as $p) 
                            <tr class="group hover:bg-gray-50/30 transition-all">
                                <td class="px-6 py-6 whitespace-nowrap">
                                    <div class="text-xs font-black text-gray-800 uppercase italic">{{ $p->user->name }}</div>
                                    <div class="text-[9px] text-gray-400 font-bold">{{ $p->user->email }}</div>
                                </td>
                                <td class="px-6 py-6 whitespace-nowrap text-xs font-bold text-gray-900 uppercase tracking-tight">
                                    {{ $p->buku->judul ?? $p->buku->nama_buku }}
                                </td>
                                <td class="px-6 py-6 text-center whitespace-nowrap">
                                    <span class="px-3 py-1 bg-gray-100 rounded-lg text-[10px] font-black text-gray-600 uppercase">{{ $p->jumlah }} Unit</span>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    @if($p->status == 'pending')
                                        <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase bg-amber-50 text-amber-500 border border-amber-100">Menunggu</span>
                                    @elseif($p->status == 'dipinjam')
                                        <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase bg-green-50 text-green-500 border border-green-100">Aktif</span>
                                    @elseif($p->status == 'dikembalikan')
                                        <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase bg-blue-50 text-blue-500 border border-blue-100">Selesai</span>
                                    @else
                                        <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase bg-red-50 text-red-500 border border-red-100">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center justify-center gap-3">
                                        
                                        {{-- SETUJUI PENDING --}}
                                        @if($p->status == 'pending')
                                            <form action="{{ route('admin.peminjaman.update', $p->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="dipinjam">
                                                <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-xl text-[9px] font-black uppercase transition-all shadow-lg shadow-emerald-100">Setujui</button>
                                            </form>

                                            <form action="{{ route('admin.peminjaman.update', $p->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="ditolak">
                                                <button type="submit" class="text-red-400 hover:text-red-600 text-[9px] font-black uppercase transition-all ml-2">Tolak</button>
                                            </form>
                                        @endif

                                        {{-- PROSES PENGEMBALIAN --}}
                                        @if($p->status == 'dipinjam')
                                            <form action="{{ route('admin.pengembalian.store', $p->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl text-[9px] font-black uppercase shadow-lg shadow-blue-100 transition-all">
                                                    Terima Kembali
                                                </button>
                                            </form>
                                        @endif

                                        {{-- HAPUS RIWAYAT --}}
                                        <form id="delete-form-{{ $p->id }}" action="{{ route('admin.peminjaman.destroy', $p->id) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="button" onclick="confirmDelete('{{ $p->id }}')" class="p-2 bg-gray-50 rounded-lg text-gray-300 hover:text-red-500 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                        
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-32 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="bg-gray-50 p-4 rounded-full mb-4">
                                            <svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                        </div>
                                        <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.3em]">Belum ada riwayat transaksi</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(method_exists($peminjaman, 'links'))
                <div class="mt-8">
                    {{ $peminjaman->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'HAPUS DATA?',
                text: "Riwayat transaksi ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'YA, HAPUS',
                cancelButtonText: 'BATAL',
                customClass: {
                    popup: 'rounded-[2rem]',
                    confirmButton: 'rounded-xl font-black text-[10px] px-6 py-3',
                    cancelButton: 'rounded-xl font-black text-[10px] px-6 py-3'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
</x-app-layout>