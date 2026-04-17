<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-xl border border-gray-100 p-8">
                <div class="mb-8">
                    <h3 class="text-md font-black text-gray-800 uppercase italic tracking-widest">Kategori Baru</h3>
                    <p class="text-[9px] text-gray-400 mt-1 uppercase tracking-tighter font-bold">Tambahkan kategori alat baru ke sistem.</p>
                </div>

                <form action="{{ route('admin.kategoris.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-col">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Nama Kategori</label>
                        <input type="text" name="nama_kategori" required placeholder="CONTOH: ELEKTRONIK"
                            class="w-full border-gray-200 bg-gray-50/30 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-xs uppercase p-3">
                    </div>

                    <div class="mt-10 pt-6 border-t border-gray-50 flex justify-end items-center space-x-8">
                        <a href="{{ route('admin.kategoris.index') }}" class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white font-black py-3 px-8 rounded-xl text-[10px] uppercase tracking-widest shadow-lg shadow-blue-100 transition-all active:scale-95">
                            Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>