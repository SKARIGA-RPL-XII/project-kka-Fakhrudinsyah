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
            {{-- Toggle Sidebar --}}
            <button
                onclick="toggleSidebar()"
                class="mb-4 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-800 hover:scale-105 transition-all duration-300"
            >
                <i class="fas fa-bars"></i> Menu
            </button>

            {{-- Judul Halaman dan Tombol Tambah --}}
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-building text-blue-500 mr-3"></i> Data Tempat PKL
                </h1>
                <a href="{{ route('tempat_pkl.create') }}"
                   class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-6 py-3 rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-800 hover:scale-105 transition-all duration-300 inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Tempat PKL
                </a>
            </div>

            {{-- SEARCH BAR --}}
            <form method="GET" id="searchForm" class="mb-6 relative">
                <input
                    type="text"
                    id="searchInput"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari Nama Tempat / Alamat..."
                    class="w-full md:w-1/3 px-4 py-3 pl-10 border border-gray-300 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-blue-500
                           focus:border-transparent shadow-sm"
                    autocomplete="off"
                >
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </form>

            {{-- Pesan Sukses --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 border-l-4 border-green-500 flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i> {{ session('success') }}
                </div>
            @endif

            {{-- Tabel Data --}}
            <div class="bg-white rounded-xl shadow-xl overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-gray-800 to-gray-700 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">Nama Tempat</th>
                            <th class="px-6 py-4 text-left font-semibold">Alamat</th>
                            <th class="px-6 py-4 text-center font-semibold">Jumlah Siswa</th>
                            <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($tempat as $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 flex items-center">
                                    <i class="fas fa-map-marker-alt text-gray-400 mr-3"></i>
                                    {{ $item->nama_tempat }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->alamat }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($item->jumlah_siswa > 0)
                                        <span class="px-4 py-1 rounded-full bg-blue-100 text-blue-800 font-semibold text-sm">
                                            {{ $item->jumlah_siswa }} siswa
                                        </span>
                                    @else
                                        <span class="px-4 py-1 rounded-full bg-red-100 text-red-700 font-semibold text-sm">
                                            0 siswa
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 flex gap-2 justify-center">
                                    <a href="{{ route('tempat_pkl.edit', $item->tempat_pkl_id) }}"
                                       class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-white px-4 py-2 rounded-lg hover:from-yellow-500 hover:to-yellow-600 transition-all duration-200 shadow flex items-center">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('tempat_pkl.destroy', $item->tempat_pkl_id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-200 shadow flex items-center">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-search text-4xl mb-2 text-gray-300"></i>
                                    <p>Data Tempat PKL tidak ditemukan</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-ml-64');
        }

        // LIVE SEARCH TEMPAT PKL
        let timer = null;
        const input = document.getElementById('searchInput');
        const form = document.getElementById('searchForm');

        input.addEventListener('keyup', function () {
            clearTimeout(timer);
            timer = setTimeout(() => {
                form.submit();
            }, 500); // delay 0.5 detik
        });
    </script>
@endsection