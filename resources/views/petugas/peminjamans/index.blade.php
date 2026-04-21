<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Tunggu Konfirmasi Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">
                            <tr>
                                <th class="px-6 py-3">Peminjam</th>
                                <th class="px-6 py-3">Nama Alat</th>
                                <th class="px-6 py-3">Jumlah</th>
                                <th class="px-6 py-3">Tanggal Pinjam</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($peminjamans as $item)
                                <tr class="bg-white border-b hover:bg-gray-50 text-center">
                                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $item->user->name }}</td>
                                    <td class="px-6 py-4">{{ $item->alat->nama_alat }}</td>
                                    <td class="px-6 py-4">{{ $item->jumlah }}</td>
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold">
                                            {{ strtoupper($item->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 flex justify-center gap-2">
                                        <form action="{{ route('petugas.peminjamans.konfirmasi', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Setujui peminjaman ini? Stok akan berkurang.')" 
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-bold">
                                                Setujui
                                            </button>
                                        </form>

                                        <form action="{{ route('petugas.peminjamans.tolak', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Tolak peminjaman ini?')" 
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-bold">
                                                Tolak
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500 italic">
                                        Tidak ada pengajuan peminjaman saat ini.
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