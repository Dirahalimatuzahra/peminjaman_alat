<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi Peminjaman Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500">
                    <h3 class="text-lg font-bold text-blue-800 mb-2">Buku yang Dipilih:</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <p class="text-gray-700"><strong>Judul:</strong> {{ $buku->judul }}</p>
                        <p class="text-gray-700"><strong>Penulis:</strong> {{ $buku->penulis }}</p>
                        <p class="text-gray-700"><strong>Kategori:</strong> {{ $buku->kategori->nama_kategori ?? 'Umum' }}</p>
                        <p class="text-gray-700"><strong>Stok Tersedia:</strong> 
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">
                                {{ $buku->stok }} unit
                            </span>
                        </p>
                    </div>
                </div>

                <form action="{{ route('peminjam.peminjaman.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <input type="hidden" name="buku_id" value="{{ $buku->id }}">

                    <div class="max-w-xs">
                        <x-input-label for="jumlah" :value="__('Jumlah Buku yang Dipinjam')" />
                        <x-text-input id="jumlah" name="jumlah" type="number" class="mt-1 block w-full" 
                            min="1" max="{{ $buku->stok }}" value="1" required />
                        <x-input-error class="mt-2" :messages="$errors->get('jumlah')" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="tgl_pinjam" :value="__('Tanggal Pinjam')" />
                            <x-text-input id="tgl_pinjam" name="tgl_pinjam" type="date" class="mt-1 block w-full bg-gray-100" 
                                value="{{ date('Y-m-d') }}" readonly required />
                            <x-input-error class="mt-2" :messages="$errors->get('tgl_pinjam')" />
                        </div>

                        <div>
                            <x-input-label for="tgl_kembali" :value="__('Rencana Tanggal Kembali')" />
                            <x-text-input id="tgl_kembali" name="tgl_kembali" type="date" class="mt-1 block w-full" 
                                value="{{ date('Y-m-d', strtotime('+7 days')) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tgl_kembali')" />
                            <p class="text-xs text-gray-500 mt-1">*Batas waktu peminjaman adalah 7 hari.</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                            {{ __('Ajukan Peminjaman Sekarang') }}
                        </x-primary-button>
                        
                        <a href="{{ route('peminjam.bukus.index') }}" 
                           class="text-sm text-gray-600 hover:text-red-500 transition-colors">
                            Batal & Kembali ke Katalog
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>