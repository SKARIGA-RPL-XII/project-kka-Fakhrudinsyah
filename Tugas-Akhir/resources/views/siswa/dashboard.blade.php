@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')

<div class="bg-white min-h-screen px-6 py-10">

    {{-- HEADER --}}
    <div class="max-w-7xl mx-auto mb-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            E - Jurnal
        </h1>
    </div>

    {{-- KONTEN DASHBOARD --}}
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

        {{-- JURNAL --}}
        <div class="border rounded-xl p-6 hover:shadow-lg transition">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                    <i class="fas fa-book text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">
                    Jurnal Harian
                </h3>
            </div>

            <p class="text-gray-600 mb-6">
                Catat kegiatan PKL harian Anda secara rapi dan terstruktur.
            </p>

                            <a href="{{ route('siswa.jurnal.index') }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-semibold">
                    Akses Jurnal
                </a>
        </div>

        {{-- LAPORAN --}}
        <div class="border rounded-xl p-6 hover:shadow-lg transition">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-orange-100 text-orange-600 p-3 rounded-full">
                    <i class="fas fa-file-powerpoint text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">
                    Upload Laporan
                </h3>
            </div>

            <p class="text-gray-600 mb-6">
                Upload file PPT laporan PKL untuk dikumpulkan ke pembimbing.
            </p>

            <a href="{{ route('siswa.laporan.index') }}"
               class="inline-block bg-orange-600 hover:bg-orange-700 text-white px-5 py-2 rounded-lg text-sm font-semibold">
                Upload Laporan
            </a>
        </div>

        {{-- BIMBINGAN --}}
        <div class="border rounded-xl p-6 hover:shadow-lg transition">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-green-100 text-green-600 p-3 rounded-full">
                    <i class="fas fa-comments text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">
                    Bimbingan
                </h3>
            </div>

            <p class="text-gray-600 mb-6">
                Konsultasi dan diskusi langsung dengan pembimbing PKL.
            </p>

            <a href="#"
               class="inline-block bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg text-sm font-semibold">
                Mulai Bimbingan
            </a>
        </div>

        {{-- HISTORY JURNAL --}}
        <div class="border rounded-xl p-6 hover:shadow-lg transition">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                    <i class="fas fa-history text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">
                    History Jurnal
                </h3>
            </div>

            <p class="text-gray-600 mb-6">
                Lihat riwayat pengiriman jurnal dan status persetujuan pembimbing.
            </p>

            <a href="{{ route('siswa.jurnal.history') }}"
               class="inline-block bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg text-sm font-semibold">
                Lihat History
            </a>
        </div>

    </div>

</div>

@endsection
