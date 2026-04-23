<x-app-layout>
    {{-- Header ditiadakan/dikosongkan jika ingin tampilan lebih bersih --}}
    <x-slot name="header">
        <h2 class="font-bold text-sm text-gray-400 uppercase tracking-[0.5em]">
            {{ __('Katalog Digital') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Bagian Judul Utama & Pencarian --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                <div>
                    <h3 class="text-4xl font-black text-gray-900 uppercase tracking-tighter leading-none">Pilih Buku</h3>
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-[0.2em] mt-3">Silakan pilih kategori atau cari buku yang ingin dipinjam.</p>
                </div>

                {{-- Bar Pencarian --}}
                <div class="w-full md:w-72">
                    <form action="{{ route('peminjam.bukus.index') }}" method="GET" class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="CARI JUDUL..." 
                            class="w-full bg-white border-none rounded-2xl p-4 pl-12 font-bold text-[10px] shadow-sm focus:ring-2 focus:ring-indigo-500 placeholder:text-gray-300 uppercase tracking-widest">
                        <div class="absolute left-4 top-3.5 text-gray-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Navbar Kategori (Tepat di bawah judul) --}}
            <div class="mb-12">
                <div class="flex items-center space-x-3 overflow-x-auto pb-4 no-scrollbar border-b border-gray-100">
                    <a href="{{ route('peminjam.bukus.index') }}" 
                       class="whitespace-nowrap px-6 py-2 rounded-xl font-black text-[9px] uppercase tracking-widest transition-all {{ !request('kategori') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-gray-400 hover:text-indigo-600' }}">
                        Semua Koleksi
                    </a>
                    @foreach($kategoris as $kategori)
                        <a href="{{ route('peminjam.bukus.index', ['kategori' => $kategori->id]) }}" 
                           class="whitespace-nowrap px-6 py-2 rounded-xl font-black text-[9px] uppercase tracking-widest transition-all {{ request('kategori') == $kategori->id ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-gray-400 hover:text-indigo-600' }}">
                            {{ $kategori->nama_kategori }}
                        </a>
                    @endforeach
                </div>
            </div>

            @if(session('success'))
                <div class="mb-8 bg-green-500 text-white p-4 rounded-2xl shadow-lg shadow-green-100 flex items-center gap-3">
                    <span class="text-[10px] font-black uppercase tracking-widest">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Grid Katalog --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-8">
                @forelse ($bukus as $buku)
                <div class="bg-white rounded-[3rem] p-5 shadow-sm border border-gray-50 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col group">
                    
                    {{-- Cover --}}
                    <div class="aspect-[3/4] bg-gray-50 rounded-[2.5rem] relative overflow-hidden mb-6 shadow-inner">
                        @if($buku->gambar)
                            <img src="{{ asset('storage/bukus/' . $buku->gambar) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                <span class="text-[9px] font-black text-gray-300 uppercase tracking-widest">No Cover</span>
                            </div>
                        @endif
                        
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1.5 rounded-full text-[8px] font-black uppercase tracking-widest {{ $buku->stok > 0 ? 'bg-white/90 text-indigo-600' : 'bg-red-500 text-white' }} backdrop-blur-sm shadow-sm">
                                STOK: {{ $buku->stok }}
                            </span>
                        </div>
                    </div>

                    {{-- Info Buku --}}
                    <div class="px-2 flex-grow">
                        <h4 class="text-lg font-black text-gray-900 uppercase tracking-tighter leading-tight mb-2 truncate">
                            {{ $buku->nama_buku }}
                        </h4>
                        <p class="text-[9px] text-gray-400 font-bold leading-relaxed mb-6 line-clamp-2 uppercase italic">
                            {{ $buku->deskripsi ?? 'Detail buku ini dapat dilihat saat pengajuan peminjaman.' }}
                        </p>
                    </div>

                    {{-- Tombol --}}
                    <div class="mt-auto">
                        @if($buku->stok > 0)
                            <a href="{{ route('peminjam.peminjaman.create', ['buku_id' => $buku->id]) }}" 
                            class="block w-full bg-gray-900 hover:bg-indigo-600 text-white text-center font-black text-[9px] py-4 rounded-2xl transition-all duration-300 uppercase tracking-[0.2em] shadow-lg">
                                Pinjam Sekarang
                            </a>
                        @else
                            <button disabled class="w-full bg-gray-100 text-gray-300 font-black text-[9px] py-4 rounded-2xl cursor-not-allowed uppercase tracking-[0.2em]">
                                Stok Habis
                            </button>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-400 font-black uppercase text-xs tracking-widest italic opacity-50">Belum ada koleksi untuk kategori ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</x-app-layout>