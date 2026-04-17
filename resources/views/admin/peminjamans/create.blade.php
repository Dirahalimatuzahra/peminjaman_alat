<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-xl shadow-md border border-gray-100">
                <h3 class="font-black text-gray-800 uppercase italic tracking-widest mb-6">Form Peminjaman Baru</h3>
                
                <form action="{{ route('admin.peminjamans.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Pilih Siswa --}}
                        <div>
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Pilih Siswa</label>
                            <select name="user_id" required class="w-full border-gray-200 rounded-lg text-xs font-bold p-3 bg-gray-50/30">
                                <option value="" selected disabled>-- PILIH SISWA --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Pilih Alat --}}
                        <div>
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Pilih Alat</label>
                            <select name="alat_id" required class="w-full border-gray-200 rounded-lg text-xs font-bold p-3 bg-gray-50/30">
                                <option value="" selected disabled>-- PILIH ALAT --</option>
                                @foreach($alats as $alat)
                                    <option value="{{ $alat->id }}">{{ $alat->nama_alat }} (Stok: {{ $alat->stok }})</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Jumlah Pinjam --}}
                        <div>
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Jumlah Pinjam</label>
                            <input type="number" name="jumlah" value="1" min="1" required
                                class="w-full border-gray-200 rounded-lg text-xs font-bold p-3 bg-gray-50/30 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        {{-- Tanggal Pinjam --}}
                        <div>
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" value="{{ date('Y-m-d') }}" required
                                class="w-full border-gray-200 rounded-lg text-xs font-bold p-3 bg-gray-50/30 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end items-center space-x-6">
                        <a href="{{ route('admin.peminjamans.index') }}" 
                            class="text-gray-400 font-bold uppercase text-[10px] tracking-widest hover:text-gray-600 transition-colors">
                            Batal
                        </a>
                        <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold uppercase text-[10px] tracking-[0.15em] shadow-lg shadow-blue-100 transition-all active:scale-95">
                            Simpan Pinjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>