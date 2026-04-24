<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase">
            {{ __('Kelola Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('admin.kategori.store') }}" method="POST" class="mb-6">
                    @csrf
                    <div class="flex gap-4">
                        <input type="text" name="nama_kategori" placeholder="Nama Kategori Baru..." class="border-gray-300 rounded-lg w-full" required>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold">SIMPAN</button>
                    </div>
                </form>

                <hr class="mb-6">

                <table class="min-w-full border text-center">
                    <thead>
                        <tr class="bg-gray-100 uppercase text-xs font-bold">
                            <th class="px-6 py-3 border-b">Nama Kategori</th>
                            <th class="px-6 py-3 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach($kategoris as $k)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ $k->nama_kategori }}</td>
                            <td class="px-6 py-4 border-b">
                                <form action="{{ route('admin.kategori.destroy', $k->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 font-bold uppercase hover:underline" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>