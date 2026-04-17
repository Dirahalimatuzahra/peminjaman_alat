<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Inventaris Alat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Daftar Alat Sekolah</h3>
                        <p class="text-sm text-gray-500">Kelola data barang, stok, dan kategori alat.</p>
                    </div>
                    <a href="{{ route('admin.alats.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 transition ease-in-out duration-150">
                        + Tambah Alat Baru
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Alat</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Stok</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($alats as $alat)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $alat->nama_alat }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $alat->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">
                                    {{ $alat->stok }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($alat->stok > 0)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Habis
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-3">
                                    <a href="{{ route('admin.alats.edit', $alat->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold">Edit</a>

                                    <form action="{{ route('admin.alats.destroy', $alat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">
                                    Belum ada data alat yang tersimpan.
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
