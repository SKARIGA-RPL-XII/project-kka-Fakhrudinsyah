@extends('layouts.pembimbing')

@section('title', 'Dashboard Pembimbing')

@section('content')

<div class="max-w-7xl mx-auto">

    <h1 class="text-3xl font-bold text-gray-800 mb-8 flex items-center">
        <i class="fas fa-chart-line text-indigo-600 mr-3"></i>
        Dashboard Pembimbing
    </h1>

    {{-- STAT BOX --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm">Total Siswa Bimbingan</p>
                    <h2 class="text-3xl font-bold text-gray-800">
                        {{ $totalSiswa ?? 0 }}
                    </h2>
                </div>
                <i class="fas fa-users text-4xl text-blue-500"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm">Chat Belum Dibaca</p>
                    <h2 class="text-3xl font-bold text-gray-800">
                        {{ $chatBaru ?? 0 }}
                    </h2>
                </div>
                <i class="fas fa-comments text-4xl text-green-500"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-purple-500">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm">File Laporan Masuk</p>
                    <h2 class="text-3xl font-bold text-gray-800">
                        {{ $fileMasuk ?? 0 }}
                    </h2>
                </div>
                <i class="fas fa-file-upload text-4xl text-purple-500"></i>
            </div>
        </div>

    </div>

    {{-- LIST SISWA --}}
    <div class="bg-white rounded-2xl shadow-xl p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-user-graduate text-indigo-600 mr-2"></i>
            Siswa Bimbingan Terbaru
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Tempat PKL</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswa as $s)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $s->nama }}</td>
                            <td class="px-4 py-3">{{ $s->tempatPkl->nama_tempat ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                    Aktif
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="x"
                                   class="text-blue-600 hover:underline">
                                    Bimbingan
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">
                                Belum ada siswa
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection
