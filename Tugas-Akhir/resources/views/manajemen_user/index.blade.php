@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
.btn-edit {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 6px 13px; border-radius: 7px; font-size: 12px;
    background: #fefce8; color: #a16207;
    border: 1px solid #fde68a;
}
.btn-hapus {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 6px 13px; border-radius: 7px; font-size: 12px;
    background: #fef2f2; color: #b91c1c;
    border: 1px solid #fecaca;
}
.btn-template, .btn-import, .btn-tambah {
    transition: all 0.2s;
}
tbody tr:hover { background: #f8fafc; }
</style>

<div class="flex bg-gradient-to-br from-gray-100 to-blue-50 min-h-screen">
    <x-sidebar />

    <div class="flex-1 p-6">

        <!-- MENU -->

        <button onclick="toggleSidebar()"
            class="btn-tambah mb-4 px-4 py-2 bg-blue-600 text-white rounded-lg shadow">
            <i class="fas fa-bars"></i> Menu
        </button>

        <!-- JUDUL -->
        <div class="mb-4">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-users text-blue-500 mr-3"></i> Manajemen User
            </h1>
        </div>

        <!-- SEARCH + TOMBOL -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

            <!-- SEARCH -->
            <div class="w-full lg:max-w-md">
                <div class="relative">
                    <input type="text" id="search" placeholder="Cari user..."
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-white
                               focus:outline-none focus:ring-2 focus:ring-blue-500/20
                               shadow-sm text-sm">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                </div>
            </div>

            <!-- TOMBOL -->
            <div class="flex flex-wrap items-center gap-4">

                <!-- TEMPLATE -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.user.export') }}"
                        class="btn-template bg-green-500 text-white px-4 py-2 rounded-lg shadow flex items-center gap-2">
                        <i class="fas fa-file-excel"></i> Template
                    </a>

                    <a href="{{ route('admin.manajemen_user.create') }}"
                        class="btn-tambah bg-indigo-600 text-white px-5 py-2 rounded-lg shadow flex items-center gap-2">
                        <i class="fas fa-plus"></i> Tambah User
                    </a>

                </div>

                <!-- IMPORT -->
                <form action="{{ route('admin.user.import') }}" method="POST" enctype="multipart/form-data"
                    class="flex items-center gap-2 bg-white p-2 rounded-lg shadow border">
                    @csrf
                    <input type="file" name="file"
                        class="text-sm border rounded px-2 py-1" required>

                    <button type="submit"
                    
                        class="btn-import bg-blue-500 text-white px-4 py-2 rounded-lg flex items-center gap-2 text-sm">
                        <i class="fas fa-upload"></i> Import
                    </button>
                </form>

            </div>
        </div>

        <!-- ALERT -->
        @if (session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 border">
                {{ session('success') }}
            </div>
        @endif

        <!-- TABLE -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm">Nomor</th>
                            <th class="px-6 py-4 text-left text-sm">Username</th>
                            <th class="px-6 py-4 text-center text-sm">NIS</th>
                            <th class="px-6 py-4 text-center text-sm">Role</th>
                            <th class="px-6 py-4 text-center text-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-data">
                        @include('manajemen_user.partials.table')
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('-ml-64');
}

const searchInput = document.getElementById('search');
let timer = null;

searchInput.addEventListener('input', function() {
    clearTimeout(timer);
    timer = setTimeout(() => {
        fetch(`{{ route('admin.manajemen_user.search') }}?search=${this.value}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => document.getElementById('table-data').innerHTML = html);
    }, 300);
});
</script>
@endsection
