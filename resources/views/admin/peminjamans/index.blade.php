<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Daftar Aktivitas Peminjaman</h3>
                    <a href="{{ route('admin.peminjamans.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                        + Catat Peminjaman Baru
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Peminjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($peminjamans as $p)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-bold">{{ $p->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $p->alat->nama_alat }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $p->jumlah_pinjam }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xs font-bold {{ $p->status == 'dipinjam' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium flex gap-2">
                                    <a href="{{ route('admin.peminjamans.edit', $p->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('admin.peminjamans.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
