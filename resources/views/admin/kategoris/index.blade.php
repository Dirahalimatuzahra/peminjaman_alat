<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Daftar Kategori Alat</h3>

                    <a href="{{ route('admin.kategoris.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        + Tambah Kategori Baru
                    </a>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($kategoris as $kategori)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold uppercase">{{ $kategori->nama_kategori }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex justify-center gap-4">
                                    <a href="{{ route('admin.kategoris.edit', $kategori->id) }}" class="text-indigo-600 hover:text-indigo-900 font-black text-[10px] uppercase tracking-widest">Edit</a>

                                    {{-- Form Hapus (Tersembunyi) --}}
                                    <form id="delete-form-{{ $kategori->id }}" action="{{ route('admin.kategoris.destroy', $kategori->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    {{-- Tombol Hapus dengan SweetAlert --}}
                                    <button type="button" onclick="confirmDelete({{ $kategori->id }})" class="text-red-600 hover:text-red-900 font-black text-[10px] uppercase tracking-widest">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @endforeach

                            @if($kategoris->isEmpty())
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 italic">Belum ada data kategori.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'HAPUS KATEGORI?',
                text: "Data ini akan dihapus secara permanen dari sistem!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6', // Warna biru untuk Ya
                cancelButtonColor: '#d33',    // Warna merah untuk Batal
                confirmButtonText: 'YA, HAPUS!',
                cancelButtonText: 'BATAL',
                reverseButtons: true,
                customClass: {
                    title: 'font-black italic tracking-widest',
                    confirmButton: 'font-bold uppercase tracking-widest text-xs px-6 py-3 rounded-lg',
                    cancelButton: 'font-bold uppercase tracking-widest text-xs px-6 py-3 rounded-lg'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jalankan form submit jika user menekan tombol YA
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
</x-app-layout>