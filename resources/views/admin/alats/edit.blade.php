<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Alat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-xl border border-gray-100">
                <div class="p-8">
                    
                    <div class="mb-8">
                        <h3 class="text-md font-black text-gray-800 uppercase italic tracking-widest">Update Informasi Alat</h3>
                        <p class="text-[9px] text-gray-400 mt-1 uppercase tracking-tighter font-bold">Ubah detail alat sekolah di bawah ini.</p>
                        <div class="mt-3 border-b border-gray-50"></div>
                    </div>

                    <form action="{{ route('admin.alats.update', $alat->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Nama Alat --}}
                            <div class="flex flex-col">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Nama Alat</label>
                                <input type="text" name="nama_alat" value="{{ old('nama_alat', $alat->nama_alat) }}" 
                                    class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-xs uppercase p-3">
                            </div>

                            {{-- Kategori --}}
                            <div class="flex flex-col">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Kategori</label>
                                <select name="kategori_id" class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-xs uppercase p-3">
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ $alat->kategori_id == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Stok --}}
                            <div class="flex flex-col">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Stok Tersedia</label>
                                <input type="number" name="stok" value="{{ old('stok', $alat->stok) }}" 
                                    class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-xs p-3">
                            </div>
                        </div>

                        {{-- Footer Buttons --}}
                        <div class="mt-10 pt-6 border-t border-gray-50 flex justify-end items-center space-x-8">
                            <a href="{{ route('admin.alats.index') }}" 
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