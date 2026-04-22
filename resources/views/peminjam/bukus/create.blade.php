<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulir Peminjaman Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('peminjam.bukus.store') }}" method="POST">
                    @csrf
                    
                    {{-- Detail Buku --}}
                    <div class="mb-6 p-4 bg-indigo-50 rounded-xl border border-indigo-100">
                        <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-1">Buku yang dipilih</label>
                        <p class="text-lg font-bold text-indigo-900 uppercase">{{ $selected_buku->nama_buku }}</p>
                        <input type="hidden" name="buku_id" value="{{ $selected_buku->id }}">
                    </div>

                    {{-- Nama Peminjam (Otomatis) --}}
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nama Peminjam</label>
                        <input type="text" value="{{ Auth::user()->name }}" class="w-full bg-gray-50 border-gray-200 rounded-lg text-sm font-bold text-gray-500" readonly>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        {{-- Jumlah Pinjam --}}
                        <div class="mb-4">
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Jumlah</label>
                            <input type="number" name="jumlah" min="1" max="{{ $selected_buku->stok }}" class="w-full border-gray-200 rounded-lg text-sm" required placeholder="Stok: {{ $selected_buku->stok }}">
                        </div>

                        {{-- Tanggal Pinjam --}}
                        <div class="mb-4">
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Tanggal Pinjam</label>
                            <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ date('Y-m-d') }}" class="w-full border-gray-200 rounded-lg text-sm" required>
                        </div>
                    </div>

                    {{-- Tanggal Kembali --}}
                    <div class="mb-2">
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Rencana Tanggal Kembali</label>
                        <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="w-full border-gray-200 rounded-lg text-sm" required>
                    </div>

                    {{-- Notifikasi Denda (Muncul via JS) --}}
                    <div id="info_denda" class="hidden mb-4 p-3 bg-red-50 border border-red-100 rounded-lg">
                        <p class="text-[11px] text-red-600 font-bold italic uppercase tracking-wider">
                            ⚠️ Perhatian: Durasi pinjam lebih dari 2 hari. Anda akan dikenakan denda Rp 10.000 saat pengembalian.
                        </p>
                    </div>

                    {{-- Keterangan --}}
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Keterangan Peminjam</label>
                        <textarea name="keterangan" rows="3" class="w-full border-gray-200 rounded-lg text-sm" placeholder="Contoh: Digunakan untuk praktik di Lab Komputer" required></textarea>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button type="submit" class="flex-1 bg-indigo-600 text-white py-3 rounded-xl font-bold uppercase text-xs tracking-widest hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                            Konfirmasi Pinjaman
                        </button>
                        <a href="{{ route('peminjam.bukus.index') }}" class="px-6 py-3 border border-gray-200 text-gray-500 rounded-xl font-bold uppercase text-xs tracking-widest hover:bg-gray-50 transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script Hitung Denda Otomatis --}}
    <script>
        const tglPinjam = document.getElementById('tanggal_pinjam');
        const tglKembali = document.getElementById('tanggal_kembali');
        const infoDenda = document.getElementById('info_denda');

        function hitungDurasi() {
            if (tglPinjam.value && tglKembali.value) {
                const start = new Date(tglPinjam.value);
                const end = new Date(tglKembali.value);
                
                // Hitung selisih hari
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                // Jika lebih dari 2 hari, tampilkan notifikasi denda
                if (diffDays > 2) {
                    infoDenda.classList.remove('hidden');
                } else {
                    infoDenda.classList.add('hidden');
                }
            }
        }

        tglPinjam.addEventListener('change', hitungDurasi);
        tglKembali.addEventListener('change', hitungDurasi);
    </script>
</x-app-layout>