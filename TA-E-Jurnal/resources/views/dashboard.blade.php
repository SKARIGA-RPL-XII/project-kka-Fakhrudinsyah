<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navbar -->
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-blue-600">E-Jurnal Dashboard</h1>
                    </div>
                    <div class="flex items-center">
                        <a href="/" class="text-gray-600 hover:text-gray-900">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="py-10">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Selamat Datang!</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <a href="/jurnal" 
                       class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                        <h3 class="text-xl font-semibold text-gray-800">📝 Isi Jurnal</h3>
                        <p class="text-gray-600 mt-2">Catat kegiatan prakerin Anda</p>
                    </a>
                    
                    <a href="/laporan" 
                       class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                        <h3 class="text-xl font-semibold text-gray-800">📄 Kumpulkan Laporan</h3>
                        <p class="text-gray-600 mt-2">Upload laporan akhir prakerin</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>