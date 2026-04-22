<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah User Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                <div class="mb-6 border-b pb-4">
                    <h3 class="text-lg font-bold text-gray-900 uppercase tracking-widest italic">Formulir Registrasi Pengguna</h3>
                    <p class="text-sm text-gray-500">Silakan isi data di bawah ini untuk menambahkan user baru ke sistem.</p>
                </div>

                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-4">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                            <input type="text" name="name" required autofocus
                                class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm font-bold"
                                placeholder="Masukkan nama lengkap...">
                            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Alamat Email</label>
                            <input type="email" name="email" required
                                class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm font-bold"
                                placeholder="contoh@sekolah.sch.id">
                            @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Password</label>
                            <input type="password" name="password" required
                                class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm font-bold"
                                placeholder="Minimal 8 karakter">
                            @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Role / Peran</label>
                            <select name="role" required
                                class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm font-bold">
                                <option value="" disabled selected>-- Pilih Peran --</option>
                                <option value="admin">Administrator</option>
                                <option value="peminjam">Siswa (Peminjam)</option>
                            </select>
                            @error('role') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-end gap-4 border-t pt-6">
                        <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-gray-400 uppercase tracking-widest hover:text-gray-600 transition">
                            Batal & Kembali
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-blue-700 shadow-lg shadow-blue-200 transition">
                            Simpan User Baru
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
