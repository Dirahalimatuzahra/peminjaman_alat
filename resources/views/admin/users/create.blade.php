<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah User Baru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-3xl p-8 border border-gray-100">
                
                <div class="mb-8 border-b border-gray-100 pb-6">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="bg-blue-600 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-gray-900 tracking-tight">REGISTRASI PENGGUNA BARU</h3>
                    </div>
                    <p class="text-sm text-gray-500">Masukkan detail informasi pengguna untuk didaftarkan ke dalam sistem.</p>
                </div>

                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                                    class="w-full border-gray-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-3 px-4 text-sm font-semibold transition-all"
                                    placeholder="Nama lengkap user...">
                                @error('name') <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Alamat Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full border-gray-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-3 px-4 text-sm font-semibold transition-all"
                                    placeholder="email@contoh.com">
                                @error('email') <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Password</label>
                                <input type="password" name="password" required
                                    class="w-full border-gray-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-3 px-4 text-sm font-semibold transition-all"
                                    placeholder="Minimal 8 karakter">
                                @error('password') <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" required
                                    class="w-full border-gray-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-3 px-4 text-sm font-semibold transition-all"
                                    placeholder="Ulangi password...">
                            </div>
                        </div>

                        <div class="w-full">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Role / Hak Akses</label>
                            <select name="role" required
                                class="w-full border-gray-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-3 px-4 text-sm font-semibold transition-all cursor-pointer">
                                <option value="" disabled selected>-- Pilih Peran User --</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                                <option value="peminjam" {{ old('role') == 'peminjam' ? 'selected' : '' }}>Siswa (Peminjam)</option>
                            </select>
                            @error('role') <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mt-10 flex items-center justify-end gap-6 border-t border-gray-100 pt-8">
                        <a href="{{ route('admin.users.index') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors uppercase tracking-widest">
                            Batal
                        </a>
                        <button type="submit" 
                            class="inline-flex items-center px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white text-xs font-black uppercase tracking-widest rounded-2xl shadow-xl shadow-blue-200 transition-all active:scale-95">
                            Simpan User Baru
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>