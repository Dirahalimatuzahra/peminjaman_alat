<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Alat Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-xl border border-gray-100">
                <div class="p-8">
                    
                    <div class="mb-8">
                        <h3 class="text-md font-black text-gray-800 uppercase italic tracking-widest">Registrasi Alat Baru</h3>
                        <p class="text-[9px] text-gray-400 mt-1 uppercase tracking-tighter font-bold">Masukkan detail data alat sekolah ke dalam sistem.</p>
                        <div class="mt-3 border-b border-gray-50"></div>
                    </div>

                    <form action="{{ route('admin.alats.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Nama Alat --}}
                            <div class="flex flex-col">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Nama Alat</label>
                                <input type="text" name="nama_alat" value="{{ old('nama_alat') }}" placeholder="CONTOH: PROYEKTOR EPSON" required
                                    class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-xs uppercase p-3 placeholder:opacity-30">
                                @error('nama_alat') <span class="text-red-500 text-[8px] font-bold mt-1 uppercase">{{ $message }}</span> @enderror
                            </div>

                            {{-- Kategori --}}
                            <div class="flex flex-col">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Kategori Alat</label>
                                <select name="kategori_id" required class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-xs uppercase p-3">
                                    <option value="" disabled selected>PILIH KATEGORI</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id') <span class="text-red-500 text-[8px] font-bold mt-1 uppercase">{{ $message }}</span> @enderror
                            </div>

                            {{-- Stok --}}
                            <div class="flex flex-col">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Jumlah Stok</label>
                                <input type="number" name="stok" value="{{ old('stok') }}" placeholder="0" required
                                    class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-xs p-3 placeholder:opacity-30">
                                @error('stok') <span class="text-red-500 text-[8px] font-bold mt-1 uppercase">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mt-6 flex flex-col">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Deskripsi / Spesifikasi (Opsional)</label>
                            <textarea name="deskripsi" rows="3" class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-xs p-3 placeholder:opacity-30" placeholder="MASUKKAN DETAIL ALAT..."></textarea>
                        </div>

                        {{-- Footer Buttons --}}
                        <div class="mt-10 pt-6 border-t border-gray-50 flex justify-end items-center space-x-8">
                            <a href="{{ route('admin.alats.index') }}" 
                                class="text-[9px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">
                                Kembali
                            </a>
                            <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white font-black py-3 px-8 rounded-xl text-[10px] uppercase tracking-[0.15em] shadow-lg shadow-blue-100 transition-all active:scale-95">
                                Simpan Alat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>