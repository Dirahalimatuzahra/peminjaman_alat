<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Stok Alat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-gray-100">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-800 italic uppercase tracking-widest">Daftar Inventaris</h3>
                    {{-- Tombol tambah jika petugas diizinkan menambah alat --}}
                    <a href="{{ route('petugas.alats.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-sm shadow-indigo-200">
                        + TAMBAH ALAT
                    </a>
                </div>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-[10px] text-gray-400 uppercase tracking-[0.2em] bg-gray-50/50">
                            <tr>
                                <th class="px-6 py-4">Nama Alat</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4 text-center">Stok</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($alats as $alat)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-800">{{ $alat->nama_alat }}</div>
                                        <div class="text-[10px] text-gray-400 uppercase">{{ $alat->kode_alat ?? 'KODE-NON' }}</div>
                                    </td>
                                    <td class="px-6 py-4 font-medium">{{ $alat->kategori->nama_kategori ?? 'Umum' }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 rounded-lg font-black {{ $alat->stok <= 5 ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600' }}">
                                            {{ $alat->stok }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('petugas.alats.edit', $alat->id) }}" class="text-indigo-600 hover:bg-indigo-50 p-2 rounded-lg transition">
                                                📝
                                            </a>
                                            <form action="{{ route('petugas.alats.destroy', $alat->id) }}" method="POST" onsubmit="return confirm('Hapus alat ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition">
                                                    🗑️
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-400 font-medium italic">Belum ada data alat yang terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>