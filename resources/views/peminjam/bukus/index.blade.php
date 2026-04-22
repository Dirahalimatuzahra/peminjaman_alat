<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight tracking-tighter uppercase">
            {{ __('Katalog Buku Sekolah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <h3 class="text-3xl font-black text-indigo-600 uppercase tracking-tighter leading-none">Pilih Buku Praktik</h3>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-[0.3em] mt-2 text-wrap">Temukan buku yang kamu butuhkan dan ajukan peminjaman sekarang.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-500 text-white p-4 rounded-2xl shadow-lg shadow-green-100 flex items-center gap-3">
                    <span class="text-xs font-black uppercase tracking-widest">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse ($bukus as $buku)
                <div class="bg-white rounded-[2.5rem] p-4 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition duration-500 flex flex-col">
                    {{-- Image Container --}}
                    <div class="h-56 bg-gray-50 rounded-[2rem] relative overflow-hidden mb-6">
                        @if($buku->gambar)
                            <img src="{{ asset('storage/bukus/' . $buku->gambar) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest">No Image</span>
                            </div>
                        @endif
                        
                        <div class="absolute top-4 right-4">
                            <span class="px-4 py-2 rounded-full text-[9px] font-black uppercase tracking-widest {{ $buku->stok > 0 ? 'bg-white/90 text-green-600' : 'bg-white/90 text-red-600' }} backdrop-blur-sm shadow-sm">
                                Stok: {{ $buku->stok }}
                            </span>
                        </div>
                    </div>

                    <div class="px-2 flex-grow">
                        <p class="text-indigo-500 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Umum</p>
                        <h4 class="text-xl font-black text-gray-900 uppercase tracking-tighter leading-tight mb-3">
                            {{ $buku->nama_buku }}
                        </h4>
                        <p class="text-xs text-gray-400 font-medium leading-relaxed mb-6 italic">
                            {{ $buku->deskripsi ?? 'Gunakan buku ini untuk menunjang kegiatan praktik di sekolah.' }}
                        </p>
                    </div>

                    <div class="mt-auto">
                        @if($buku->stok > 0)
                            <form action="{{ route('peminjam.peminjaman.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                <input type="hidden" name="jumlah" value="1">
                                <button type="submit" class="w-full bg-gray-900 hover:bg-indigo-600 text-white font-black text-[10px] py-4 rounded-2xl transition-all duration-300 uppercase tracking-[0.2em] shadow-xl shadow-gray-200">
                                    Pinjam Sekarang
                                </button>
                            </form>
                        @else
                            <button disabled class="w-full bg-gray-100 text-gray-300 font-black text-[10px] py-4 rounded-2xl cursor-not-allowed uppercase tracking-[0.2em]">
                                Stok Habis
                            </button>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-full py-24 text-center bg-gray-50 rounded-[3rem] border-2 border-dashed border-gray-200">
                    <p class="text-gray-400 font-black uppercase text-xs tracking-widest">Katalog masih kosong.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>