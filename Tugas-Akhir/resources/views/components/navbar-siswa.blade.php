<nav class="fixed top-0 left-0 w-full z-50 bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-16">

            {{-- KIRI --}}
            <div class="flex items-center space-x-6">
                <span class="font-bold text-lg">
                    E - Jurnal
                </span>

                <a href="{{ route('siswa.dashboard') }}"
                   class="hover:text-yellow-300 transition">
                    Home
                </a>

                <a href="{{ route('siswa.jurnal.index') }}"
                   class="hover:text-yellow-300 transition">
                    Jurnal
                </a>

                <a href="{{ route('siswa.laporan.index') }}"
                   class="hover:text-yellow-300 transition">
                    Laporan
                </a>

                <a href="#bimbingan"
                   class="hover:text-yellow-300 transition">
                    Bimbingan
                </a>

                                <a href="{{ route('siswa.jurnal.history') }}"
                class="hover:text-yellow-300 transition">
                    Riwayat
                </a>

            </div>

            {{-- KANAN (AKUN) --}}
            <div class="relative" x-data="{ open: false }">
                <button
                    @click="open = !open"
                    class="flex items-center space-x-2 bg-blue-800 px-4 py-2 rounded-full hover:bg-blue-900 transition">
                    <i class="fas fa-user-circle text-xl"></i>
                    <span class="hidden md:inline">
                        {{ auth()->user()->nama }}
                    </span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </button>

                {{-- DROPDOWN --}}
                <div
                    x-show="open"
                    @click.outside="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white text-gray-700 rounded-lg shadow-lg overflow-hidden z-50">

                    <a href="{{ route('siswa.dashboard') }}"
                       class="block px-4 py-3 hover:bg-gray-100">
                        <i class="fas fa-id-card mr-2 text-blue-500"></i>
                        Data Akun
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button
                            type="submit"
                            class="w-full text-left px-4 py-3 hover:bg-red-100 text-red-600">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</nav>

{{-- Alpine JS --}}
<script src="//unpkg.com/alpinejs" defer></script>
