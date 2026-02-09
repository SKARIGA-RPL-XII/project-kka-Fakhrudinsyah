@extends('layouts.siswa')

@section('title', 'Riwayat Jurnal')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Riwayat
        </h1>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="bg-white shadow rounded-xl overflow-x-auto">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Judul</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jurnals as $jurnal)
                <tr class="border-t">
                    <td class="px-4 py-3">
                        {{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d M Y') }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $jurnal->judul }}
                    </td>

                    <td class="px-4 py-3">
                        @if($jurnal->status === 'menunggu')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                Menunggu
                            </span>
                        @else
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                Diterima
                            </span>
                        @endif
                    </td>

                    <td class="px-4 py-3 text-center">
                        @if($jurnal->status === 'menunggu')
                            <a href="{{ route('siswa.jurnal.edit', $jurnal->id) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                                Edit
                            </a>
                        @else
                            <span class="text-gray-400 text-sm italic">
                                Tidak Dapat Di Edit
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                        Tidak ada jurnal dalam 7 hari terakhir.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
