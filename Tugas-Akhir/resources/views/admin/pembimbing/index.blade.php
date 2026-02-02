@extends('layouts.app')

@section('title', 'Data Pembimbing')

@section('content')

<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="flex bg-gradient-to-br from-gray-100 to-blue-50 min-h-screen">
    {{-- Sidebar --}}
    <x-sidebar />

    {{-- Konten --}}
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
                <i class="fas fa-chalkboard-teacher text-blue-500 mr-3"></i> Data Pembimbing
            </h1>

            {{-- Search --}}
            <div class="relative">
                <input
                    type="text"
                    id="search"
                    placeholder="Cari nama pembimbing..."
                    class="w-64 pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm"
                >
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>

        {{-- Tabel --}}
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-full">
                    <thead class="bg-gradient-to-r from-gray-800 to-gray-700 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">No</th>
                            <th class="px-6 py-4 text-left font-semibold">Nama Pembimbing</th>
                            <th class="px-6 py-4 text-center font-semibold">Jumlah Siswa</th>
                        </tr>
                    </thead>

                    <tbody id="pembimbing-table" class="divide-y divide-gray-200">
                        @foreach ($pembimbings as $index => $pembimbing)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>

                                <td class="px-6 py-4 font-medium flex items-center">
                                    {{ $pembimbing->nama }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 text-sm rounded-full bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 font-semibold">
                                        {{ $pembimbing->siswa_bimbingan_count }} siswa
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Tidak Ditemukan --}}
                <div id="empty-data" class="hidden px-6 py-8 text-center text-gray-500">
                    <i class="fas fa-search text-4xl mb-2 text-gray-300"></i>
                    <p>Data pembimbing tidak ditemukan.</p>
                </div>
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

{{-- AJAX Search --}}
<script>
    const searchInput = document.getElementById('search');
    const tableBody = document.getElementById('pembimbing-table');
    const emptyData = document.getElementById('empty-data');

    searchInput.addEventListener('keyup', function () {
        fetch(`{{ route('pembimbing.search') }}?search=${this.value}`)
            .then(res => res.json())
            .then(data => {
                tableBody.innerHTML = '';

                if (data.length === 0) {
                    emptyData.classList.remove('hidden');
                    return;
                }

                emptyData.classList.add('hidden');

                data.forEach((item, index) => {
                    tableBody.innerHTML += `
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4">${index + 1}</td>
                            <td class="px-6 py-4 font-medium flex items-center">
                                ${item.nama}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 text-sm rounded-full bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 font-semibold">
                                    ${item.siswa_bimbingan_count} siswa
                                </span>
                            </td>
                        </tr>
                    `;
                });
            });
    });
</script>
@endsection