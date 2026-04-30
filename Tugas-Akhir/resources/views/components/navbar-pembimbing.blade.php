<nav class="bg-gradient-to-r from-indigo-600 to-blue-600 shadow-lg">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-16">

            {{-- LOGO --}}
            <div class="flex items-center space-x-3 text-white">
                <i class="fas fa-user-tie text-2xl"></i>
                <span class="font-bold text-lg tracking-wide">
                    Pembimbing PKL
                </span>
            </div>

            {{-- MENU --}}
            <div class="hidden md:flex items-center space-x-6 text-white font-medium">
                <a href="{{ route('pembimbing.dashboard') }}"
                   class="hover:text-yellow-300 transition">
                    <i class="fas fa-home mr-1"></i> Dashboard
                </a>

                <a href="{{ route('pembimbing.bimbingan.index') }}"
                   class="hover:text-yellow-300 transition">
                    <i class="fas fa-comments mr-1"></i> Bimbingan
                </a>

                <a href="{{ route('pembimbing.jurnal.index') }}"
                   class="hover:text-yellow-300 transition">
                    <i class="fas fa-users mr-1"></i> Jurnal Siswa
                </a>
            </div>

            {{-- PROFIL --}}
            <div class="relative">
                <button
                    id="profileBtn"
                    class="flex items-center space-x-2 text-white focus:outline-none">
                    <i class="fas fa-user-circle text-2xl"></i>
                    <span>{{ auth()->user()->nama ?? 'Pembimbing' }}</span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </button>

                {{-- DROPDOWN --}}
                <div
                    id="profileDropdown"
                    class="absolute right-0 mt-2 w-44 bg-white rounded-xl shadow-lg
                           hidden overflow-hidden z-50">

                    <a href="#"
                       class="block px-4 py-3 text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-user mr-2"></i> Profil
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button
                            class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</nav>

{{-- SCRIPT DROPDOWN --}}
<script>
    const btn = document.getElementById('profileBtn');
    const dropdown = document.getElementById('profileDropdown');

    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', function () {
        dropdown.classList.add('hidden');
    });
</script>
