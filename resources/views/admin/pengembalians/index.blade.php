<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Pengembalian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- Bagian Header Tabel (Sama seperti Peminjaman) --}}
                    <div class="flex justify-between items-center mb-6 px-4">
                        <h3 class="text-lg font-medium text-gray-800">Daftar Aktivitas Pengembalian</h3>
                    </div>

                    {{-- Pesan Sukses --}}
                    @if(session('success'))
                        <div class="mx-4 mb-4 p-4 bg-green-100 text-green-700 text-xs font-bold uppercase rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tabel (Identik dengan image_ea9aa8.png) --}}
                    <div class="overflow-x-auto border border-gray-100 rounded-lg mx-4">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-100">
                                    <th class="py-3 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">No</th>
                                    <th class="py-3 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Peminjam</th>
                                    <th class="py-3 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Buku</th>
                                    <th class="py-3 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Tgl Pinjam</th>
                                    <th class="py-3 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($pengembalians as $index => $data)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="py-4 px-6 text-sm text-gray-600 text-center">{{ $index + 1 }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-600 uppercase font-medium">{{ $data->user->name }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-600 uppercase font-medium">{{ $data->buku->nama_buku }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-500 font-medium">
                                        {{ \Carbon\Carbon::parse($data->tanggal_pinjam)->format('d/m/Y') }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-center space-x-3">
                                            {{-- Tombol Konfirmasi (Biru) --}}
                                            <form action="{{ route('admin.pengembalians.konfirmasi') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="peminjaman_id" value="{{ $data->id }}">
                                                <button type="submit" onclick="return confirm('Buku sudah kembali?')" 
                                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-[9px] uppercase tracking-wider shadow-sm transition-all active:scale-95">
                                                    Konfirmasi
                                                </button>
                                            </form>

                                            {{-- Link Edit --}}
                                            <a href="{{ route('admin.pengembalians.edit', $data->id) }}" class="text-indigo-600 font-bold hover:underline uppercase text-[10px] tracking-wider">
                                                Edit
                                            </a>

                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('admin.pengembalians.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Hapus riwayat ini?')" class="text-red-600 font-bold hover:underline uppercase text-[10px] tracking-wider">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-16 text-center text-gray-400 text-[11px] font-bold uppercase tracking-[0.2em] italic">
                                        Tidak ada buku yang sedang dipinjam.
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