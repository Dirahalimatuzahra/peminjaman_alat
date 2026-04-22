<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 uppercase tracking-widest text-[10px] font-bold mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ $user->name }}" required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 uppercase tracking-widest text-[10px] font-bold mb-2">Alamat Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 uppercase tracking-widest text-[10px] font-bold mb-2">Password (Kosongkan jika tidak ingin ganti)</label>
                            <input type="password" name="password"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="********">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 uppercase tracking-widest text-[10px] font-bold mb-2">Role / Peran</label>
                            <select name="role" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="peminjam" {{ $user->role == 'peminjam' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center gap-4">
                        <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 shadow-md transition">
                            Perbarui Data
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-600 hover:underline">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout> 
