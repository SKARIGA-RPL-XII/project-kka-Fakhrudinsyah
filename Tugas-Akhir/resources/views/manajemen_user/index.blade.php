@extends('layouts.app')

@section('content')
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <div class="flex bg-gradient-to-br from-gray-100 to-blue-50 min-h-screen">
        {{-- Sidebar --}}
        <x-sidebar />

        {{-- Konten Utama --}}
        <div class="flex-1 p-6">

            {{-- Toggle Sidebar --}}
            <button
                onclick="toggleSidebar()"
                class="mb-4 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-800 hover:scale-105 transition-all duration-300"
            >
                <i class="fas fa-bars"></i> Menu
            </button>

            {{-- Header --}}
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-users text-blue-500 mr-3"></i> Manajemen User
                </h1>

                <a href="{{ route('manajemen_user.create') }}"
                   class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-6 py-3 rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-800 hover:scale-105 transition-all duration-300 inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah User
                </a>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 border-l-4 border-green-500 flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- SEARCH BAR --}}
            <div class="mb-6 max-w-md">
                <div class="relative">
                    <input
                        type="text"
                        id="search"
                        placeholder="Cari user..."
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm"
                    >
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-xl shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-full">
                                        <thead class="bg-gradient-to-r from-gray-800 to-gray-700 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left">Username</th>
                        <th class="px-6 py-4 text-center">NIS</th>
                        <th class="px-6 py-4 text-center">Role</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>


                        
                        <tbody id="table-data" class="divide-y divide-gray-200">
                            @include('manajemen_user.partials.table')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Sidebar Toggle --}}
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-ml-64');
        }
    </script>

    {{-- AJAX SEARCH --}}
    <script>
const searchInput = document.getElementById('search');
const tableData  = document.getElementById('table-data');
let timer = null;

searchInput.addEventListener('input', function () {
    clearTimeout(timer);

    timer = setTimeout(() => {
        fetch(`{{ route('manajemen_user.index') }}?search=${this.value}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.text())
        .then(html => {
            tableData.innerHTML = html;
        });
    }, 300);
});
</script>

@endsection