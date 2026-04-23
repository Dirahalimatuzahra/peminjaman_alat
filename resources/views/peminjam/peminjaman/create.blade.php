<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-gray-50">
                <h3 class="text-3xl font-black text-gray-900 uppercase tracking-tighter mb-2">Detail Peminjaman</h3>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-8 border-b pb-4">Lengkapi data di bawah untuk meminjam buku ini.</p>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-2xl text-[10px] font-bold uppercase tracking-widest border border-red-100">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('peminjam.peminjaman.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="buku_id" value="{{ $buku->id }}">

                    {{-- Info Buku --}}
                    <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-3xl mb-6">
                        <img src="{{ asset('storage/bukus/' . $buku->gambar) }}" class="w-16 h-20 object-cover rounded-xl shadow-sm">
                        <div>
                            <p class="text-[8px] font-black text-indigo-600 uppercase">Buku yang dipilih:</p>
                            <h4 class="font-black text-gray-800 uppercase">{{ $buku->nama_buku }}</h4>
                        </div>
                    </div>

                    {{-- Input Jumlah --}}
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Jumlah Pinjam (Max: {{ $buku->stok }})</label>
                        <input type="number" name="jumlah" value="1" min="1" max="{{ $buku->stok }}" class="w-full border-gray-100 rounded-2xl p-4 font-bold focus:ring-indigo-500">
                    </div>

                    {{-- Input Tanggal --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" value="{{ date('Y-m-d') }}" class="w-full border-gray-100 rounded-2xl p-4 font-bold">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" class="w-full border-gray-100 rounded-2xl p-4 font-bold">
                        </div>
                    </div>

                    {{-- Input Keterangan --}}
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Alasan Meminjam / Keterangan</label>
                        <textarea name="keterangan" rows="3" placeholder="Contoh: Digunakan untuk tugas kelompok di kelas..." class="w-full border-gray-100 rounded-2xl p-4 font-bold"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-gray-900 text-white font-black py-5 rounded-[2rem] uppercase tracking-widest shadow-xl hover:bg-indigo-600 transition-all">
                        Kirim Pengajuan
                    </button>
                    
                    <a href="{{ route('peminjam.bukus.index') }}" class="block text-center text-[10px] font-bold text-gray-400 uppercase tracking-widest">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>