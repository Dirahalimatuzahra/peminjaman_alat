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
                                {{-- Ganti $peminjaman menjadi $p agar sesuai dengan loop @foreach --}}
                                @if($p->status == 'pending')
                                    <div class="flex gap-2">
                                        {{-- Tombol Setujui --}}
                                        <form action="{{ route('admin.peminjaman.update', $p->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="disetujui">
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-[10px] font-bold px-3 py-1 rounded-lg uppercase tracking-wider transition-all">
                                                Setujui
                                            </button>
                                        </form>

                                        {{-- Tombol Tolak --}}
                                        <form action="{{ route('admin.peminjaman.update', $p->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-[10px] font-bold px-3 py-1 rounded-lg uppercase tracking-wider transition-all">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    {{-- Tampilan Label Status jika sudah diproses --}}
                                    <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest {{ $p->status == 'disetujui' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                        {{ $p->status == 'disetujui' ? 'Dipinjam' : 'Ditolak' }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 border-b text-center">
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
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'YA, HAPUS',
                cancelButtonText: 'BATAL',
                borderRadius: '1rem'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
</x-app-layout>