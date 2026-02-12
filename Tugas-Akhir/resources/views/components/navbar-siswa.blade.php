<nav class="fixed top-0 left-0 w-full z-50 bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 text-white shadow-2xl backdrop-blur-md bg-opacity-95">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-16">

            {{-- KIRI --}}
            <div class="flex items-center space-x-8">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-book text-yellow-300 text-2xl"></i>
                    <span class="font-bold text-xl text-white">
                        E - Jurnal
                    </span>
                </div>

                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('siswa.dashboard') }}"
                       class="flex items-center space-x-2 hover:text-yellow-300 hover:scale-105 transition-all duration-300 px-3 py-2 rounded-lg hover:bg-white/10">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>

                    <a href="{{ route('siswa.jurnal.index') }}"
                       class="flex items-center space-x-2 hover:text-yellow-300 hover:scale-105 transition-all duration-300 px-3 py-2 rounded-lg hover:bg-white/10">
                        <i class="fas fa-edit"></i>
                        <span>Jurnal</span>
                    </a>

                    <a href="{{ route('siswa.laporan.index') }}"
                       class="flex items-center space-x-2 hover:text-yellow-300 hover:scale-105 transition-all duration-300 px-3 py-2 rounded-lg hover:bg-white/10">
                        <i class="fas fa-file-powerpoint"></i>
                        <span>Laporan</span>
                    </a>

                    <a href="{{ route('siswa.bimbingan.index') }}"
                       class="flex items-center space-x-2 hover:text-yellow-300 hover:scale-105 transition-all duration-300 px-3 py-2 rounded-lg hover:bg-white/10">
                        <i class="fas fa-comments"></i>
                        <span>Bimbingan</span>
                    </a>

                    <a href="{{ route('siswa.jurnal.history') }}"
                       class="flex items-center space-x-2 hover:text-yellow-300 hover:scale-105 transition-all duration-300 px-3 py-2 rounded-lg hover:bg-white/10">
                        <i class="fas fa-history"></i>
                        <span>Riwayat</span>
                    </a>
                </div>
            </div>

            {{-- KANAN (AKUN) --}}
            <div class="relative" x-data="{ open: false }">
                <button
                    @click="open = !open"
                    class="flex items-center space-x-3 bg-gradient-to-r from-blue-800 to-blue-900 px-4 py-2 rounded-full hover:from-blue-900 hover:to-black transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <i class="fas fa-user-circle text-2xl text-yellow-300"></i>
                    <span class="hidden md:inline font-medium">
                        {{ auth()->user()->nama }}
                    </span>
                    <i class="fas fa-chevron-down text-sm transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
                </button>

                {{-- DROPDOWN --}}
                <div
                    x-show="open"
                    @click.outside="open = false"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95"
                    class="absolute right-0 mt-3 w-56 bg-white text-gray-700 rounded-xl shadow-2xl overflow-hidden z-50 border border-gray-200">

                    <a href="{{ route('siswa.akun.index') }}"
                       class="flex items-center space-x-3 px-4 py-3 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                        <i class="fas fa-id-card text-blue-500"></i>
                        <span>Data Akun</span>
                    </a>

                    <div class="border-t border-gray-200"></div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button
                            type="submit"
                            class="w-full text-left flex items-center space-x-3 px-4 py-3 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                            <i class="fas fa-sign-out-alt text-red-500"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div class="md:hidden" x-data="{ open: false }">
        <div x-show="open" @click="open = false" class="fixed inset-0 bg-black bg-opacity-50 z-40"></div>
        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="transform -translate-y-full" x-transition:enter-end="transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform translate-y-0" x-transition:leave-end="transform -translate-y-full" class="absolute top-16 left-0 w-full bg-gradient-to-r from-blue-700 to-blue-800 text-white shadow-lg z-50">
            <div class="px-6 py-4 space-y-4">
                <a href="{{ route('siswa.dashboard') }}" class="block flex items-center space-x-3 hover:text-yellow-300 transition">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a href="{{ route('siswa.jurnal.index') }}" class="block flex items-center space-x-3 hover:text-yellow-300 transition">
                    <i class="fas fa-edit"></i>
                    <span>Jurnal</span>
                </a>
                <a href="{{ route('siswa.laporan.index') }}" class="block flex items-center space-x-3 hover:text-yellow-300 transition">
                    <i class="fas fa-file-powerpoint"></i>
                    <span>Laporan</span>
                </a>
                <a href="#bimbingan" class="block flex items-center space-x-3 hover:text-yellow-300 transition">
                    <i class="fas fa-comments"></i>
                    <span>Bimbingan</span>
                </a>
                <a href="{{ route('siswa.jurnal.history') }}" class="block flex items-center space-x-3 hover:text-yellow-300 transition">
                    <i class="fas fa-history"></i>
                    <span>Riwayat</span>
                </a>
            </div>
        </div>
    </div>
</nav>

{{-- Alpine JS --}}
<script src="//unpkg.com/alpinejs" defer></script>