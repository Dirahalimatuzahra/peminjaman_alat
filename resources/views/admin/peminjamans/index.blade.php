<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between mb-6">
                    <h3 class="font-bold text-gray-800 uppercase tracking-widest">Daftar Peminjaman</h3>
                </div>

                <table class="min-w-full border">
                    <thead class="bg-gray-50 uppercase text-[10px] font-bold text-gray-500">
                        <tr>
                            <th class="px-6 py-3 border-b text-left">Peminjam</th>
                            <th class="px-6 py-3 border-b text-left">Buku</th>
                            <th class="px-6 py-3 border-b text-left">Jumlah</th>
                            <th class="px-6 py-3 border-b text-left">Status</th>
                            <th class="px-6 py-3 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs font-medium">
                        @foreach ($peminjamans as $p)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ $p->user->name }}</td>
                            <td class="px-6 py-4 border-b">{{ $p->buku?->nama_buku ?? 'Buku Tidak Ditemukan' }}</td>
                            <td class="px-6 py-4 border-b">{{ $p->jumlah }}</td>
                            <td class="px-6 py-4 border-b">
                                <span class="{{ $p->status == 'dipinjam' ? 'text-orange-500' : 'text-green-500' }} font-bold uppercase">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 border-b text-center">
                                {{-- Hapus huruf 's' pada admin.peminjamans agar sesuai dengan web.php --}}
                            <form id="delete-form-{{ $p->id }}" action="{{ route('admin.peminjaman.destroy', $p->id) }}" method="POST" style="display:none;">
                                @csrf @method('DELETE')
                            </form>
                                <button onclick="confirmDelete({{ $p->id }})" class="text-red-500 font-bold uppercase hover:underline">Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'HAPUS DATA PINJAM?',
                text: "Menghapus data ini akan mengembalikan stok buku!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'YA, HAPUS'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
</x-app-layout>