<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight italic uppercase tracking-tighter">
            {{ __('Tambah Buku Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-xl border border-gray-100">
                <div class="p-8">
                    
                    <div class="mb-8">
                        <h3 class="text-md font-black text-gray-800 uppercase italic tracking-widest">Registrasi Buku Baru</h3>
                        <p class="text-[9px] text-gray-400 mt-1 uppercase tracking-tighter font-bold">Masukkan detail data buku sekolah ke dalam sistem.</p>
                        <div class="mt-3 border-b border-gray-50"></div>
                    </div>

                    {{-- TAMPILKAN ERROR JIKA ADA --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg">
                            <p class="font-black uppercase text-[10px] tracking-widest">Gagal Menyimpan:</p>
                            <ul class="mt-2 list-disc list-inside text-[9px] font-bold uppercase">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.bukus.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Nama Buku --}}
                            <div class="flex flex-col">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Nama Buku</label>
                                <input type="text" name="nama_buku" value="{{ old('nama_buku') }}" placeholder="CONTOH: BUKU IPS KELAS 9" required
                                    class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-xs uppercase p-3 placeholder:opacity-30">
                            </div>

                            {{-- Kategori (TAMBAHAN WAJIB) --}}
                            <div class="flex flex-col">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Kategori Alat/Buku</label>
                                <select name="kategori_id" required class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-xs p-3">
                                    <option value="">-- PILIH KATEGORI --</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ strtoupper($kategori->nama_kategori) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            {{-- Stok --}}
                            <div class="flex flex-col">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Jumlah Stok</label>
                                <input type="number" name="stok" value="{{ old('stok') }}" placeholder="0" required
                                    class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-xs p-3 placeholder:opacity-30">
                            </div>

                            {{-- Gambar --}}
                            <div class="flex flex-col">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Cover Buku / Foto Alat</label>
                                <input type="file" name="gambar" accept="image/*"
                                    class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-xs p-2 file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mt-6 flex flex-col">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Deskripsi / Spesifikasi (Opsional)</label>
                            <textarea name="deskripsi" rows="3" class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-xs p-3 placeholder:opacity-30" placeholder="MASUKKAN DETAIL ALAT...">{{ old('deskripsi') }}</textarea>
                        </div>

                        {{-- Footer Buttons --}}
                        <div class="mt-10 pt-6 border-t border-gray-50 flex justify-end items-center space-x-8">
                            <a href="{{ route('admin.bukus.index') }}" 
                                class="text-[9px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">
                                Kembali
                            </a>
                            <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white font-black py-3 px-8 rounded-xl text-[10px] uppercase tracking-[0.15em] shadow-lg shadow-blue-100 transition-all active:scale-95">
                                Simpan Buku
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>