<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-8">

                    {{-- Header Tabel & Fitur Pencarian --}}
                    <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h3 class="text-md font-black text-gray-800 uppercase italic tracking-widest">Daftar Pengguna Sistem</h3>
                            <p class="text-[9px] text-gray-400 mt-1 uppercase tracking-tighter font-bold">Manajemen akun admin, petugas, dan peminjam.</p>
                        </div>
                        
                        <div class="flex items-center gap-3 w-full md:w-auto">
                            {{-- PERBAIKAN: Input Pencarian Baru --}}
                            <form action="{{ route('admin.users.index') }}" method="GET" class="relative group">
                                <input type="text" name="search" value="{{ request('search') }}" 
                                    placeholder="CARI NAMA / EMAIL..." 
                                    class="w-full md:w-64 border-gray-100 bg-gray-50/50 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-[10px] p-3 uppercase placeholder:text-gray-300 transition-all">
                                <button type="submit" class="absolute right-3 top-2.5 text-gray-300 group-hover:text-blue-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </form>

                            <a href="{{ route('admin.users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-black py-3 px-6 rounded-xl text-[10px] uppercase tracking-widest shadow-lg shadow-blue-100 transition-all active:scale-95 whitespace-nowrap">
                                + Tambah User
                            </a>
                        </div>
                    </div>

                    {{-- Tabel --}}
                    <div class="overflow-x-auto border border-gray-50 rounded-2xl">
                        <table class="min-w-full divide-y divide-gray-100">
                            <thead class="bg-gray-50/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">No</th>
                                    <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Nama</th>
                                    <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Email</th>
                                    <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Role</th>
                                    <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-50">
                                @forelse ($users as $user)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    {{-- Gunakan firstItem() + index jika pakai pagination agar nomor tetap urut --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs font-black text-gray-800 uppercase tracking-tight">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-600 font-medium">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-[9px] leading-5 font-black rounded-lg uppercase tracking-widest
                                            {{ $user->role == 'admin' ? 'bg-red-50 text-red-600' : ($user->role == 'petugas' ? 'bg-emerald-50 text-emerald-600' : 'bg-blue-50 text-blue-600') }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex justify-center items-center space-x-6">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-[10px] font-black text-indigo-600 hover:text-indigo-900 uppercase tracking-widest transition-colors">
                                                Edit
                                            </a>

                                            <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete('{{ $user->id }}')" class="text-[10px] font-black text-red-500 hover:text-red-700 uppercase tracking-widest transition-colors">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">User tidak ditemukan.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- PAGINATION (Tambahkan ini agar halaman bisa ganti-ganti) --}}
                    <div class="mt-6">
                        {{ $users->appends(['search' => request('search')])->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Script JavaScript untuk Konfirmasi Hapus --}}
    @push('scripts')
    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: 'HAPUS USER?',
                text: "Data yang dihapus tidak dapat dikembalikan lagi.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'YA, HAPUS',
                cancelButtonText: 'BATAL',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-3xl shadow-2xl',
                    title: 'font-black uppercase tracking-widest text-sm italic',
                    htmlContainer: 'font-medium text-xs',
                    confirmButton: 'rounded-xl px-6 py-3 font-black text-[10px] tracking-widest uppercase',
                    cancelButton: 'rounded-xl px-6 py-3 font-black text-[10px] tracking-widest uppercase'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId).submit();
                }
            })
        }
    </script>
    @endpush
</x-app-layout>