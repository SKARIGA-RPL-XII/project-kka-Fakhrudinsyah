@extends('layouts.siswa')

@section('title', 'Data Akun')

@section('content')

<div class="min-h-screen bg-gray-100 py-16">
    <div class="max-w-4xl mx-auto px-6">

        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center">
            <i class="fas fa-user-circle text-gray-700 mr-3"></i>
            Data Akun Siswa
        </h1>

        <div class="bg-white shadow-md rounded-lg p-8 space-y-6 border border-gray-300">

            {{-- NAMA --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border-l-4 border-gray-500">
                <div class="flex items-center">
                    <i class="fas fa-user text-gray-600 mr-3"></i>
                    <span class="text-gray-700 font-medium">Nama Lengkap</span>
                </div>
                <span class="font-semibold text-gray-800">
                    {{ $siswa->nama }}
                </span>
            </div>

            {{-- NIS --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border-l-4 border-gray-500">
                <div class="flex items-center">
                    <i class="fas fa-id-card text-gray-600 mr-3"></i>
                    <span class="text-gray-700 font-medium">NIS</span>
                </div>
                <span class="font-semibold text-gray-800">
                    {{ $siswa->nis ?? '-' }}
                </span>
            </div>

            {{-- TEMPAT PKL --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border-l-4 border-gray-500">
                <div class="flex items-center">
                    <i class="fas fa-building text-gray-600 mr-3"></i>
                    <span class="text-gray-700 font-medium">Tempat PKL</span>
                </div>
                <span class="font-semibold text-gray-800">
                    {{ $siswa->tempatPkl->nama_tempat ?? '-' }}
                </span>
            </div>

            {{-- PEMBIMBING --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border-l-4 border-gray-500">
                <div class="flex items-center">
                    <i class="fas fa-chalkboard-teacher text-gray-600 mr-3"></i>
                    <span class="text-gray-700 font-medium">Nama Pembimbing</span>
                </div>
                <span class="font-semibold text-gray-800">
                    {{ $siswa->pembimbing->nama ?? '-' }}
                </span>
            </div>

            {{-- JURNAL TERAKHIR --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border-l-4 border-gray-500">
                <div class="flex items-center">
                    <i class="fas fa-calendar-alt text-gray-600 mr-3"></i>
                    <span class="text-gray-700 font-medium">Terakhir Mengisi Jurnal</span>
                </div>
                <span class="font-semibold text-gray-800">
                    @if($jurnalTerakhir)
                        {{ \Carbon\Carbon::parse($jurnalTerakhir->tanggal)->format('d M Y') }}
                    @else
                        Belum Pernah
                    @endif
                </span>
            </div>

            {{-- STATUS LAPORAN --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border-l-4 border-gray-500">
                <div class="flex items-center">
                    <i class="fas fa-file-alt text-gray-600 mr-3"></i>
                    <span class="text-gray-700 font-medium">Status Laporan</span>
                </div>
                <span>
                    @if($laporan)
                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded text-sm font-medium border border-gray-300">
                            {{ ucfirst($laporan->status ?? 'Dikumpulkan') }}
                        </span>
                    @else
                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded text-sm font-medium border border-gray-300">
                            Belum Dikumpulkan
                        </span>
                    @endif
                </span>
            </div>

        </div>
    </div>
</div>

@endsection
