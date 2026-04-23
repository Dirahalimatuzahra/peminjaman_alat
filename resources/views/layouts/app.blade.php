<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Peminjaman Alat') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900">
        
        <div class="flex min-h-screen overflow-hidden">
            
            <aside class="w-72 bg-white border-r border-gray-100 hidden md:flex flex-col flex-shrink-0 h-screen sticky top-0">
                <div class="flex-1 overflow-y-auto">
                    @include('layouts.navigation')
                </div>
            </aside>

            <div class="flex-1 flex flex-col min-w-0 h-screen overflow-y-auto">
                
                <header class="bg-white/80 backdrop-blur-md sticky top-0 z-10 border-b border-gray-100">
                    <div class="max-w-7xl mx-auto py-4 px-6 sm:px-8 flex justify-between items-center">
                        <div class="flex items-center gap-4">
                            <div class="md:hidden">
                                <button class="p-2 rounded-lg bg-gray-100 text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                                </button>
                            </div>
                            
                            @if (isset($header))
                                <div class="font-black text-gray-900 uppercase tracking-tighter italic">
                                    {{ $header }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-4 py-2 border-2 border-gray-50 rounded-2xl text-xs font-black uppercase tracking-widest text-gray-600 bg-white hover:bg-gray-50 hover:border-indigo-100 transition-all duration-200">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-[10px]">
                                                {{ substr(Auth::user()->name, 0, 1) }}
                                            </div>
                                            {{ Auth::user()->name }}
                                        </div>
                                        <div class="ms-2">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="px-4 py-2 border-b border-gray-50">
                                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Role Kamu</p>
                                        <p class="text-xs font-bold text-indigo-600 uppercase">{{ Auth::user()->role }}</p>
                                    </div>

                                    <x-dropdown-link :href="route('profile.edit')" class="font-bold text-xs uppercase tracking-widest py-3">
                                        {{ __('Edit Profile') }}
                                    </x-dropdown-link>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                class="font-bold text-xs uppercase tracking-widest py-3 text-red-500 hover:text-red-600 hover:bg-red-50"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Keluar Sistem') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </header>

                <main class="flex-1 p-6 sm:p-8 bg-gray-50/50">
                    {{ $slot }}
                </main>

                <footer class="py-4 px-8 bg-white border-t border-gray-100">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] text-center">
                        &copy; {{ date('Y') }} {{ config('app.name') }} - Sistem Peminjaman Alat Sekolah
                    </p>
                </footer>
            </div>
        </div>

        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'BERHASIL!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000,
                    customClass: {
                        popup: 'rounded-[2rem] shadow-2xl border-none',
                        title: 'font-black uppercase tracking-widest text-sm italic',
                    }
                });
            </script>
        @endif

        @stack('scripts')
    </body>
</html>