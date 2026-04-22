<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight tracking-tighter uppercase">
            {{ __('Manajemen Inventaris Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-black text-gray-900 uppercase tracking-widest">Daftar Buku Sekolah</h3>
                        <p class="text-xs text-gray-500 uppercase font-bold tracking-widest">Kelola data barang, stok, dan deskripsi buku sekolah.</p>
                    </div>
                    <a href="{{ route('admin.bukus.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-black text-[10px] py-3 px-6 rounded-xl transition uppercase tracking-widest shadow-lg shadow-indigo-100">
                        + Tambah Buku Baru
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border border-gray-100 rounded-xl overflow-hidden">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">No</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Buku</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Stok</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Status</th>
                                <th class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($bukus as $buku)
                            <tr class="hover:bg-gray-50/50 transition duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-gray-400">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                                            @if($buku->gambar)
                                                <img src="{{ asset('storage/bukus/' . $buku->gambar) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-[8px] font-black text-gray-300">N/A</div>
                                            @endif
                                        </div>
                                        <span class="text-sm font-black text-gray-900 uppercase tracking-tighter">{{ $buku->nama_buku }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ $buku->stok }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest {{ $buku->stok > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $buku->stok > 0 ? 'Tersedia' : 'Habis' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                                    <a href="{{ route('admin.bukus.edit', $buku->id) }}" class="inline-block bg-gray-100 hover:bg-indigo-600 hover:text-white text-gray-600 text-[10px] font-black px-4 py-2 rounded-lg transition uppercase tracking-widest">Edit</a>
                                    <button onclick="confirmDelete('{{ $buku->id }}', '{{ $buku->nama_buku }}')" class="bg-gray-100 hover:bg-red-600 hover:text-white text-red-600 text-[10px] font-black px-4 py-2 rounded-lg transition uppercase tracking-widest">Hapus</button>
                                    <form id="delete-form-{{ $buku->id }}" action="{{ route('admin.bukus.destroy', $buku->id) }}" method="POST" class="hidden">
                                        @csrf @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400 font-bold uppercase text-xs tracking-widest">Belum ada data buku.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'HAPUS DATA?',
                text: "Yakin ingin menghapus " + name.toUpperCase() + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'YA, HAPUS',
                cancelButtonText: 'BATAL',
                customClass: { title: 'font-black uppercase tracking-tighter', confirmButton: 'font-bold uppercase text-xs', cancelButton: 'font-bold uppercase text-xs' }
            }).then((result) => {
                if (result.isConfirmed) { document.getElementById('delete-form-' + id).submit(); }
            });
        }
    </script>
</x-app-layout>