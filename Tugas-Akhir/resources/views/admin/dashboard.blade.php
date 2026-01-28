<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | E-Jurnal PKL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-gray-100 to-blue-50 overflow-x-hidden">

<div class="flex">
    {{-- SIDEBAR --}}
    @include('components.sidebar')

    {{-- CONTENT --}}
    <div class="flex-1 p-6">
        <!-- Toggle -->
        <button
            onclick="toggleSidebar()"
            class="mb-4 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-800 hover:scale-105 transition-all duration-300"
        >
            <i class="fas fa-bars"></i> Menu
        </button>

        <h3 class="text-3xl font-bold mb-2 text-gray-800">Dashboard Admin</h3>
        <p class="text-gray-600 mb-8 text-lg">
            Kelola akun siswa, pembimbing, dan data PKL.
        </p>

        <!-- STAT CARD -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition-shadow duration-300 border-l-4 border-blue-500">
                <div class="flex items-center">
                    <i class="fas fa-users text-blue-500 text-2xl mr-3"></i>
                    <div>
                        <p class="text-gray-500 font-medium">Total Siswa</p>
                        <b class="text-3xl text-gray-800">120</b>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition-shadow duration-300 border-l-4 border-green-500">
                <div class="flex items-center">
                    <i class="fas fa-user-tie text-green-500 text-2xl mr-3"></i>
                    <div>
                        <p class="text-gray-500 font-medium">Total Pembimbing</p>
                        <b class="text-3xl text-gray-800">10</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('-ml-64');
    }
</script>

</body>
</html>