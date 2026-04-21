<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Alat Sekolah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Pilih Alat yang Ingin Dipinjam</h3>
                    <p class="text-sm text-gray-600">Pastikan stok tersedia sebelum menekan tombol pinjam.</p>
                </div>

                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-200 px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                                <th class="border border-gray-200 px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Nama Alat</th>
                                <th class="border border-gray-200 px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Kategori</th>
                                <th class="border border-gray-200 px-4 py-2 text-center text-xs font-semibold text-gray-600 uppercase">Stok</th>
                                <th class="border border-gray-200 px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                                <th class="border border-gray-200 px-4 py-2 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($alats as $alat)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm font-bold text-gray-900 uppercase">{{ $alat->nama_alat }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600 uppercase">
                                    {{ $alat->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 font-bold text-center">{{ $alat->stok }}</td>
                                <td class="px-4 py-3 text-sm">
                                    @if($alat->stok > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Habis
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($alat->stok > 0)
                                        {{-- PERBAIKAN: Menggunakan rute tunggal sesuai web.php --}}
                                        <a href="{{ route('peminjam.alats.create', ['alat_id' => $alat->id]) }}" 
                                           class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-black text-[10px] py-2 px-4 rounded shadow transition duration-150 uppercase tracking-widest">
                                            Pinjam Alat
                                        </a>
                                    @else
                                        <button disabled class="bg-gray-300 text-gray-500 font-black text-[10px] py-2 px-4 rounded cursor-not-allowed uppercase tracking-widest">
                                            Pinjam Alat
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-10 text-center text-gray-500 italic">
                                    Belum ada data alat tersedia.
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