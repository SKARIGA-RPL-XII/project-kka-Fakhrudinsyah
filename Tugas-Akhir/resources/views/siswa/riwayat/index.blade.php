@extends('layouts.siswa')

@section('title', 'Riwayat Jurnal')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-100 to-purple-100 px-6 py-10">
    <div class="max-w-7xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-gray-800 flex items-center justify-center">
                <i class="fas fa-history text-blue-600 mr-4"></i>
                Riwayat Jurnal
            </h1>
            <p class="text-gray-600 mt-2">Lihat riwayat jurnal PKL Anda dalam 7 hari terakhir</p>
        </div>

        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <div class="mb-6 bg-green-100 text-green-700 px-6 py-4 rounded-lg border-l-4 border-green-500 flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- ALERT ERROR --}}
        @if(session('error'))
            <div class="mb-6 bg-red-100 text-red-700 px-6 py-4 rounded-lg border-l-4 border-red-500 flex items-center">
                <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                {{ session('error') }}
            </div>
        @endif

        {{-- TABLE --}}
        <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="w-full min-w-full">
                    <thead class="bg-gradient-to-r from-gray-800 to-gray-700 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">Tanggal</th>
                            <th class="px-6 py-4 text-left font-semibold">Judul</th>
                            <th class="px-6 py-4 text-left font-semibold">Status</th>
                            <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($jurnals as $jurnal)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 flex items-center">
                                <i class="fas fa-calendar-alt text-gray-400 mr-3"></i>
                                {{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4 font-medium">
                                {{ $jurnal->judul }}
                            </td>

                            <td class="px-6 py-4">
                                @if($jurnal->status === 'menunggu')
                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold border border-yellow-200">
                                        Menunggu
                                    </span>
                                @else
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold border border-green-200">
                                        Diterima
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($jurnal->status === 'menunggu')
                                    <a href="{{ route('siswa.jurnal.edit', $jurnal->id) }}"
                                       class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-4 py-2 rounded-lg hover:from-blue-600 hover:to-blue-800 transition-all duration-200 shadow flex items-center">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                @else
                                    <span class="text-gray-500 text-sm italic flex items-center justify-center">
                                        <i class="fas fa-lock mr-1"></i> Tidak Dapat Di Edit
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-search text-4xl mb-2 text-gray-300"></i>
                                <p>Tidak ada jurnal dalam 7 hari terakhir.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection
