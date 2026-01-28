@extends('layouts.app')

@section('content')

<!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

{{-- WRAPPER UNTUK SIDEBAR DAN KONTEN UTAMA --}}
<div class="flex bg-gradient-to-br from-gray-100 to-blue-50 min-h-screen">
    {{-- Sidebar --}}
    <x-sidebar />
    
    {{-- KONTEN UTAMA --}}
    <div class="flex-1 p-6">
        <!-- Toggle -->
        <button
            onclick="toggleSidebar()"
            class="mb-4 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-800 hover:scale-105 transition-all duration-300"
        >
            <i class="fas fa-bars"></i> Menu
        </button>

        <h1 class="text-3xl font-bold mb-6 text-gray-800 flex items-center">
            <i class="fas fa-edit text-blue-500 mr-3"></i> Edit Tempat PKL
        </h1>

        @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6 border-l-4 border-red-500 flex items-center">
            <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white rounded-xl shadow-xl p-8">
            <form action="{{ route('tempat_pkl.update', $tempat_pkl->tempat_pkl_id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-semibold mb-2 text-gray-700 flex items-center">
                        <i class="fas fa-building mr-2 text-blue-500"></i> Nama Tempat
                    </label>
                    <input type="text" name="nama_tempat" value="{{ $tempat_pkl->nama_tempat }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm" required>
                </div>

                <div>
                    <label class="block font-semibold mb-2 text-gray-700 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i> Alamat
                    </label>
                    <input type="text" name="alamat" value="{{ $tempat_pkl->alamat }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm" required>
                </div>

                <div class="flex gap-4 pt-4">
                    <button class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-6 py-3 rounded-lg hover:from-blue-600 hover:to-blue-800 transition-all duration-300 shadow-lg hover:scale-105 flex items-center">
                        <i class="fas fa-save mr-2"></i> Update
                    </button>
                    <a href="{{ route('tempat_pkl.index') }}"
                       class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-6 py-3 rounded-lg hover:from-gray-600 hover:to-gray-700 transition-all duration-300 shadow-lg hover:scale-105 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('-ml-64');
    }
</script>

@endsection