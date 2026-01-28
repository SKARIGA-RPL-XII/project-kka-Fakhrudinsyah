@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="flex bg-gradient-to-br from-gray-100 to-blue-50 min-h-screen">
    {{-- SIDEBAR --}}
    <x-sidebar />

    {{-- CONTENT --}}
    <div class="flex-1 p-6 ml-4">
        <!-- Toggle -->
        <button onclick="toggleSidebar()"
            class="mb-4 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg shadow hover:scale-105 transition">
            <i class="fas fa-bars"></i> Menu
        </button>

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-users text-blue-500 mr-3"></i> Manajemen User
            </h1>

            <a href="{{ route('manajemen_user.create') }}"
               class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-6 py-3 rounded-lg shadow hover:scale-105 transition flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah User
            </a>
        </div>

        {{-- SEARCH --}}
        <div class="mb-6 relative">
            <input type="text" id="searchInput"
                placeholder="Cari Nama / NIS / Role..."
                class="w-full md:w-1/3 px-4 py-3 pl-10 border rounded-lg focus:ring-2 focus:ring-blue-500 shadow">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-gray-800 to-gray-700 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left">Nama</th>
                        <th class="px-6 py-4 text-center">NIS</th>
                        <th class="px-6 py-4 text-center">Role</th>
                        <th class="px-6 py-4 text-center">Tempat PKL</th>
                        <th class="px-6 py-4 text-center">Pembimbing</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="userTable" class="divide-y">
                    @include('manajemen_user.partials.table', ['users' => $users])
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('-ml-64');
}

// ===============================
// AJAX LIVE SEARCH
// ===============================
let timer;
const input = document.getElementById('searchInput');
const table = document.getElementById('userTable');

input.addEventListener('keyup', function () {
    clearTimeout(timer);

    timer = setTimeout(() => {
        fetch(`{{ route('manajemen_user.index') }}?search=${this.value}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.text())
        .then(html => {
            table.innerHTML = html;
        });
    }, 300);
});
</script>
@endsection
