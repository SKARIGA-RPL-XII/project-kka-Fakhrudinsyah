<div id="sidebar"
     class="w-64 min-h-screen bg-gradient-to-b from-gray-800 to-gray-900 text-white transition-all duration-300 shadow-xl">

    <div class="text-center py-6 border-b border-gray-700 bg-gradient-to-r from-blue-500 to-blue-700">
        <h5 class="font-bold text-lg">
            ADMIN PANEL
        </h5>
    </div>

    <nav class="mt-4">
                <a href="{{ route('admin.dashboard') }}"
        class="flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-gray-700 hover:to-gray-600 transition-all duration-300 rounded-lg mx-2 mb-1">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>


        <a href="#" class="flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-gray-700 hover:to-gray-600 transition-all duration-300 rounded-lg mx-2 mb-1">
            <i class="fas fa-users mr-3"></i>
            Data Siswa
        </a>

        <a href="#" class="flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-gray-700 hover:to-gray-600 transition-all duration-300 rounded-lg mx-2 mb-1">
            <i class="fas fa-user-tie mr-3"></i>
            Data Pembimbing
        </a>

                <a href="{{ route('tempat_pkl.index') }}"
        class="flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-gray-700 hover:to-gray-600 transition-all duration-300 rounded-lg mx-2 mb-1">
            <i class="fas fa-briefcase mr-3"></i>
            Data Tempat PKL
        </a>


                        <a href="{{ route('manajemen_user.index') }}"
        class="flex items-center px-5 py-3 hover:bg-gray-700 rounded-lg mx-2">
            <i class="fas fa-user-cog mr-3"></i>
            Manajemen User
        </a>

        <!-- LOGOUT -->
        <form action="{{ route('logout') }}" method="POST" class="mx-2 mt-2">
    @csrf
    <button
        type="submit"
        class="flex items-center w-full px-5 py-3
               text-white
               rounded-lg
               hover:bg-red-600
               transition-all duration-300">
        <i class="fas fa-sign-out-alt mr-3"></i>
        Logout
    </button>
</form>

    </nav>
</div>