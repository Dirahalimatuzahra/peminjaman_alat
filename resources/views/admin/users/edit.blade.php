<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- Lebar diperkecil ke max-w-4xl agar lebih ramping --}}
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-xl border border-gray-100">
                <div class="p-8">
                    
                    {{-- Header Form Ramping --}}
                    <div class="mb-8">
                        <h3 class="text-md font-black text-gray-800 uppercase italic tracking-widest">Update Informasi User</h3>
                        <p class="text-[9px] text-gray-400 mt-1 uppercase tracking-tighter font-bold">Pastikan data yang diubah sudah benar sebelum disimpan.</p>
                        <div class="mt-3 border-b border-gray-50"></div>
                    </div>

                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Grid Layout dengan Gap lebih kecil --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            {{-- Nama Lengkap --}}
                            <div class="flex flex-col">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                                    class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-xs uppercase p-3 transition-all">
                                @error('name') <span class="text-red-500 text-[9px] mt-1 font-bold uppercase italic">{{ $message }}</span> @enderror
                            </div>

                            {{-- Alamat Email --}}
                            <div class="flex flex-col">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Alamat Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                    class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-xs p-3 transition-all">
                                @error('email') <span class="text-red-500 text-[9px] mt-1 font-bold uppercase italic">{{ $message }}</span> @enderror
                            </div>

                            {{-- Role Akses --}}
                            <div class="flex flex-col">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Role Akses</label>
                                <select name="role" class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-xs uppercase p-3 transition-all cursor-pointer">
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                    <option value="peminjam" {{ $user->role == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
                                </select>
                            </div>

                            {{-- Password Baru --}}
                            <div class="flex flex-col">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Password Baru (Opsional)</label>
                                <input type="password" name="password" placeholder="••••••••"
                                    class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-xs p-3 transition-all">
                            </div>

                        </div>

                        {{-- Footer Action Buttons (Sudah Diperbaiki Jaraknya agar Tidak Bertumpuk) --}}
                        <div class="mt-10 pt-6 border-t border-gray-50 flex justify-end items-center space-x-8">
                            <a href="{{ route('admin.users.index') }}" 
                                class="text-[9px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">
                                Batal
                            </a>
                            <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white font-black py-3 px-8 rounded-xl text-[10px] uppercase tracking-[0.15em] shadow-lg shadow-blue-100 transition-all active:scale-95">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>