@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="flex bg-gradient-to-br from-gray-100 to-blue-50 min-h-screen">
    {{-- Sidebar --}}
    <x-sidebar />

    {{-- Konten --}}
    <div class="flex-1 p-6">

        {{-- Toggle Sidebar --}}
        <button onclick="toggleSidebar()"
            class="mb-6 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg shadow">
            <i class="fas fa-bars"></i> Menu
        </button>

        {{-- Header --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-8">
            👋 Selamat Datang, Admin
        </h1>

        {{-- Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Siswa --}}
            <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
                <div class="p-4 bg-blue-100 rounded-full">
                    <i class="fas fa-user-graduate text-blue-600 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500">Jumlah Siswa</p>
                    <h2 class="text-3xl font-bold">{{ $jumlahSiswa }}</h2>
                </div>
            </div>

            {{-- Pembimbing --}}
            <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
                <div class="p-4 bg-green-100 rounded-full">
                    <i class="fas fa-user-tie text-green-600 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500">Jumlah Pembimbing</p>
                    <h2 class="text-3xl font-bold">{{ $jumlahPembimbing }}</h2>
                </div>
            </div>

            {{-- Tempat PKL --}}
            <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
                <div class="p-4 bg-purple-100 rounded-full">
                    <i class="fas fa-building text-purple-600 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500">Tempat PKL</p>
                    <h2 class="text-3xl font-bold">{{ $jumlahTempatPkl }}</h2>
                </div>
            </div>

        </div>

        {{-- Info --}}
        <div class="mt-10 bg-white rounded-xl shadow p-6">
            <h3 class="text-xl font-semibold mb-2">📌 Informasi</h3>
            <p class="text-gray-600">
                Gunakan menu di samping untuk mengelola data siswa, pembimbing,
                tempat PKL, dan manajemen user.
            </p>
        </div>

    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('-ml-64');
}
</script>
@endsection
