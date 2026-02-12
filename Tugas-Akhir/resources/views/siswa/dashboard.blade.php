@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-100 to-purple-100 px-6 py-10">

    {{-- HEADER --}}
    <div class="max-w-7xl mx-auto mb-12 text-center">
        <h1 class="text-5xl font-extrabold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
            E - Jurnal
        </h1>
        <p class="text-xl text-gray-700">Platform terintegrasi untuk mengelola kegiatan PKL Anda</p>
    </div>

    {{-- KONTEN DASHBOARD --}}
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

        {{-- JURNAL --}}
        <div class="bg-white/95 backdrop-blur rounded-3xl p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-4 border border-gray-200">
            <div class="flex items-center gap-4 mb-6">
                <div class="bg-gradient-to-r from-blue-100 to-blue-200 text-blue-600 p-4 rounded-full shadow-lg">
                    <i class="fas fa-book text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">
                    Jurnal Harian
                </h3>
            </div>

            <p class="text-gray-600 mb-8 leading-relaxed">
                Catat kegiatan PKL harian Anda secara rapi dan terstruktur.
            </p>

            <a href="{{ route('siswa.jurnal.index') }}"
               class="inline-block bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white px-6 py-3 rounded-full font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-arrow-right mr-2"></i> Akses Jurnal
            </a>
        </div>

        {{-- LAPORAN --}}
        <div class="bg-white/95 backdrop-blur rounded-3xl p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-4 border border-gray-200">
            <div class="flex items-center gap-4 mb-6">
                <div class="bg-gradient-to-r from-orange-100 to-orange-200 text-orange-600 p-4 rounded-full shadow-lg">
                    <i class="fas fa-file-powerpoint text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">
                    Upload Laporan
                </h3>
            </div>

            <p class="text-gray-600 mb-8 leading-relaxed">
                Upload file PPT laporan PKL untuk dikumpulkan ke pembimbing.
            </p>

            <a href="{{ route('siswa.laporan.index') }}"
               class="inline-block bg-gradient-to-r from-orange-500 to-orange-700 hover:from-orange-600 hover:to-orange-800 text-white px-6 py-3 rounded-full font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-upload mr-2"></i> Upload Laporan
            </a>
        </div>

        {{-- BIMBINGAN --}}
        <div class="bg-white/95 backdrop-blur rounded-3xl p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-4 border border-gray-200">
            <div class="flex items-center gap-4 mb-6">
                <div class="bg-gradient-to-r from-green-100 to-green-200 text-green-600 p-4 rounded-full shadow-lg">
                    <i class="fas fa-comments text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">
                    Bimbingan
                </h3>
            </div>

            <p class="text-gray-600 mb-8 leading-relaxed">
                Konsultasi dan diskusi langsung dengan pembimbing PKL.
            </p>

            <a href="{{ route('siswa.bimbingan.index') }}"
               class="inline-block bg-gradient-to-r from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 text-white px-6 py-3 rounded-full font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-comments mr-2"></i> Mulai Bimbingan
            </a>
        </div>

        {{-- HISTORY JURNAL --}}
        <div class="bg-white/95 backdrop-blur rounded-3xl p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-4 border border-gray-200">
            <div class="flex items-center gap-4 mb-6">
                <div class="bg-gradient-to-r from-purple-100 to-purple-200 text-purple-600 p-4 rounded-full shadow-lg">
                    <i class="fas fa-history text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">
                    History Jurnal
                </h3>
            </div>

            <p class="text-gray-600 mb-8 leading-relaxed">
                Lihat riwayat pengiriman jurnal dan status persetujuan pembimbing.
            </p>

            <a href="{{ route('siswa.jurnal.history') }}"
               class="inline-block bg-gradient-to-r from-purple-500 to-purple-700 hover:from-purple-600 hover:to-purple-800 text-white px-6 py-3 rounded-full font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-clock mr-2"></i> Lihat History
            </a>
        </div>

    </div>

</div>

@endsection
