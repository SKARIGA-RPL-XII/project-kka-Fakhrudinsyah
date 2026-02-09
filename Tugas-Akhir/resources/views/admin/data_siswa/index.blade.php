@extends('layouts.app')

@section('content')
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <div class="flex bg-gradient-to-br from-gray-100 to-blue-50 min-h-screen">

        {{-- SIDEBAR --}}
        <x-sidebar />

        {{-- KONTEN --}}
        <div class="flex-1 p-6">

            {{-- TOGGLE SIDEBAR --}}
            <button id="toggleSidebar"
                class="mb-4 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-800 hover:scale-105 transition-all duration-300">
                <i class="fas fa-bars"></i> Menu
            </button>

            <h1 class="text-3xl font-bold mb-6 text-gray-800 flex items-center">
                <i class="fas fa-users text-blue-500 mr-3"></i> Data Siswa
            </h1>

            {{-- SEARCH --}}
            <div class="mb-6 relative">
                <input type="text"
                       id="search"
                       placeholder="Cari Nama / NIS..."
                       class="w-full md:w-1/3 pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>

            {{-- TABLE --}}
            <div id="table-container" class="bg-white rounded-xl shadow-xl overflow-hidden">
                @include('admin.data_siswa.partials.table')
            </div>
        </div>
    </div>

    {{-- AJAX SEARCH --}}
    <script>
        document.getElementById('search').addEventListener('keyup', function () {
            fetch(`{{ route('admin.data_siswa.search') }}?keyword=${this.value}`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('table-container').innerHTML = html;
                });
        });

        // toggle sidebar
        document.getElementById('toggleSidebar').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('-ml-64');
        });
    </script>
@endsection