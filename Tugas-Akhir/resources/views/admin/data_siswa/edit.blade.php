@extends('layouts.app')

@section('content')

 <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
<div class="flex bg-gradient-to-br from-gray-100 to-blue-50 min-h-screen">

    {{-- SIDEBAR --}}
    <x-sidebar />

    {{-- CONTENT --}}
    <div class="flex-1 p-6">

        {{-- TOGGLE SIDEBAR --}}
        <button id="toggleSidebar"
            class="mb-4 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-800 transition duration-300 transform hover:scale-105">
            <i class="fas fa-bars"></i> Menu
        </button>

        <h1 class="text-3xl font-bold mb-6 text-gray-800 flex items-center">
            <i class="fas fa-user-edit text-blue-500 mr-3"></i> Edit Data Siswa
        </h1>

        {{-- Pesan Sukses --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 border-l-4 border-green-500 flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Pesan Error --}}
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6 border-l-4 border-red-500 flex items-center">
                <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white p-8 rounded-xl shadow-xl">
            <form action="{{ route('admin.data_siswa.update', $siswa->user_id) }}" method="POST" class="grid grid-cols-1 gap-6">
                @csrf
                @method('PUT')

                {{-- NAMA --}}
                <div>
                    <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                        <i class="fas fa-user mr-2 text-blue-500"></i>
                        Nama Siswa
                    </label>
                    <input type="text"
                        value="{{ $siswa->nama }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        readonly>
                </div>

                {{-- NIS --}}
                <div>
                    <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                        <i class="fas fa-id-card mr-2 text-blue-500"></i>
                        NIS
                    </label>
                    <input type="text"
                        value="{{ $siswa->nis }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        readonly>
                </div>

                {{-- PEMBIMBING --}}
                <div>
                    <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                        <i class="fas fa-chalkboard-teacher mr-2 text-blue-500"></i>
                        Pembimbing
                    </label>
                    <select name="pembimbing_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">-- Pilih Pembimbing --</option>
                        @foreach ($pembimbing as $item)
                            <option value="{{ $item->user_id }}"
                                {{ $siswa->pembimbing_id == $item->user_id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- TEMPAT PKL --}}
                <div>
                    <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                        <i class="fas fa-building mr-2 text-blue-500"></i>
                        Tempat PKL
                    </label>
                    <select name="tempat_pkl_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">-- Pilih Tempat PKL --</option>
                        @foreach ($tempatPkl as $item)
                            <option value="{{ $item->tempat_pkl_id }}"
                                {{ $siswa->tempat_pkl_id == $item->tempat_pkl_id ? 'selected' : '' }}>
                                {{ $item->nama_tempat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- BUTTON --}}
                <div class="flex gap-4 justify-end">
                    <a href="{{ route('admin.data_siswa.index') }}"
                        class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-gray-600 hover:to-gray-700 transition duration-300 transform hover:scale-105 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                    <button
                        class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-6 py-3 rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-800 transition duration-300 transform hover:scale-105 flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('toggleSidebar').addEventListener('click', () => {
    document.getElementById('sidebar').classList.toggle('-ml-64');
});
</script>
@endsection