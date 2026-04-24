<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] p-8 border border-gray-100">
                <div class="mb-8 border-b border-gray-50 pb-6">
                    <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter italic">Tambah Alat / Buku Baru</h3>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Masukkan detail inventaris sarana prasarana</p>
                </div>

                {{-- PENTING: Tambahkan enctype untuk upload gambar --}}
                <form action="{{ route('admin.bukus.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        {{-- Nama Buku / Alat --}}
                        <div class="mb-4">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Nama Alat / Judul Buku</label>
                            <input type="text" name="judul" value="{{ old('judul') }}" required 
                                   placeholder="Contoh: Kamera DSLR Canon"
                                   class="w-full border-gray-100 rounded-2xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold p-4 bg-gray-50/50">
                            @error('judul') <span class="text-red-500 text-[10px] font-bold mt-1 uppercase">{{ $message }}</span> @enderror
                        </div>

                        {{-- Kategori --}}
                        <div class="mb-4">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Kategori</label>
                            <select name="kategori_id" required 
                                    class="w-full border-gray-100 rounded-2xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold p-4 bg-gray-50/50">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $k)
                                    <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Stok --}}
                        <div class="mb-4">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Jumlah Stok</label>
                            <input type="number" name="stok" value="{{ old('stok') }}" required 
                                   placeholder="0"
                                   class="w-full border-gray-100 rounded-2xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold p-4 bg-gray-50/50">
                        </div>

                        {{-- Upload Gambar --}}
                        <div class="mb-4">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Foto / Cover</label>
                            <input type="file" name="gambar" 
                                   class="w-full border-gray-100 rounded-2xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold p-3 bg-gray-50/50">
                        </div>

                        {{-- Deskripsi --}}
                        <div class="md:col-span-2 mb-4">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Deskripsi Singkat</label>
                            <textarea name="deskripsi" rows="4" required
                                      placeholder="Jelaskan kondisi atau spesifikasi alat..."
                                      class="w-full border-gray-100 rounded-2xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold p-4 bg-gray-50/50">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>

                    <div class="mt-10 flex items-center justify-end gap-4 border-t border-gray-50 pt-8">
                        <a href="{{ route('admin.bukus.index') }}" class="text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition">Batal</a>
                        <button type="submit" class="inline-flex items-center px-10 py-4 bg-indigo-600 border border-transparent rounded-[1.5rem] font-black text-[10px] text-white uppercase tracking-[0.2em] hover:bg-indigo-700 shadow-xl shadow-indigo-100 transition-all active:scale-95">
                            Simpan Inventaris
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>