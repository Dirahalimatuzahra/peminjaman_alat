<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-xl border border-gray-100 p-8">
                
                <div class="mb-8">
                    <h3 class="text-md font-black text-gray-800 uppercase italic tracking-widest">Update Informasi Buku</h3>
                    <p class="text-[9px] text-gray-400 mt-1 uppercase tracking-tighter font-bold">Ubah detail buku sekolah di bawah ini.</p>
                    <div class="mt-3 border-b border-gray-50"></div>
                </div>

                {{-- Pastikan enctype="multipart/form-data" ada agar file bisa terkirim --}}
                <form action="{{ route('admin.bukus.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama Buku --}}
                        <div class="flex flex-col">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Nama Buku</label>
                            <input type="text" name="nama_buku" value="{{ old('nama_buku', $buku->nama_buku) }}" placeholder="CONTOH: PROYEKTOR EPSON" required
                                class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-bold text-xs p-3 uppercase placeholder:opacity-30">
                            @error('nama_buku') <span class="text-red-500 text-[8px] font-bold mt-1 uppercase">{{ $message }}</span> @enderror
                        </div>

                        {{-- Stok --}}
                        <div class="flex flex-col">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Stok Tersedia</label>
                            <input type="number" name="stok" value="{{ old('stok', $buku->stok) }}" placeholder="0" required
                                class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-bold text-xs p-3 placeholder:opacity-30">
                            @error('stok') <span class="text-red-500 text-[8px] font-bold mt-1 uppercase">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Baris Upload & Preview Foto --}}
                    <div class="mt-6 flex flex-col md:flex-row items-start gap-6">
                        <div class="flex-1 w-full flex flex-col">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Cover Buku / Foto Alat (Opsional)</label>
                            
                            {{-- PERBAIKAN: name diubah ke "foto" agar sinkron dengan Controller --}}
                            <input type="file" name="foto" accept="image/*"
                                class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-bold text-xs p-2.5 file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                            
                            <p class="text-[8px] text-gray-400 mt-1.5 uppercase tracking-tighter">* FORMAT: JPG, PNG (MAX: 2MB). Biarkan kosong jika tidak ingin mengubah foto lama.</p>
                            @error('foto') <span class="text-red-500 text-[8px] font-bold mt-1 uppercase">{{ $message }}</span> @enderror
                        </div>
                        
                        {{-- Preview Foto Saat Ini --}}
                        <div class="flex-shrink-0 flex flex-col items-center">
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1 text-center">Foto Saat Ini</p>
                            <div class="w-32 h-32 border rounded-lg flex items-center justify-center overflow-hidden bg-gray-50 shadow-inner">
                                {{-- Menggunakan asset() untuk mengakses folder public/storage/bukus --}}
                                @if($buku->foto)
                                    <img src="{{ asset('storage/bukus/' . $buku->foto) }}" alt="Foto Buku" class="object-cover w-full h-full">
                                @else
                                    <div class="flex flex-col items-center p-2 text-center">
                                        <span class="text-[8px] text-gray-400 font-black uppercase">No Image Found</span>
                                        <span class="text-[7px] text-red-400 break-all">{{ $buku->foto }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mt-6 flex flex-col">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Deskripsi / Spesifikasi (Opsional)</label>
                        <textarea name="deskripsi" rows="3" class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-bold text-xs p-3 placeholder:opacity-30" placeholder="MASUKKAN DETAIL ALAT...">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                        @error('deskripsi') <span class="text-red-500 text-[8px] font-bold mt-1 uppercase">{{ $message }}</span> @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="mt-10 pt-6 border-t border-gray-50 flex justify-end items-center space-x-8">
                        <a href="{{ route('admin.bukus.index') }}" class="text-[9px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">Batal</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-black py-3 px-8 rounded-xl text-[10px] uppercase tracking-[0.15em] shadow-lg shadow-indigo-100 transition-all active:scale-95">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>