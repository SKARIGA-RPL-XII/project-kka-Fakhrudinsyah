@extends('layouts.siswa')

@section('title', 'Laporan Akhir')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-10">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">
        Laporan Akhir
    </h1>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    {{-- JIKA BELUM UPLOAD --}}
    @if(!$laporan)
        <div class="bg-white shadow rounded-xl p-6">
            <form action="{{ route('siswa.laporan.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block font-semibold text-gray-700 mb-2">
                        Judul Laporan
                    </label>
                    <input type="text"
                           name="judul"
                           class="w-full border rounded-lg px-4 py-2"
                           required>
                </div>

                <div class="mb-6">
                    <label class="block font-semibold text-gray-700 mb-2">
                        File Laporan (PPT / PPTX)
                    </label>
                    <input type="file"
                           name="file"
                           accept=".ppt,.pptx"
                           class="w-full"
                           required>
                </div>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                    Kumpulkan Laporan
                </button>
            </form>
        </div>

    {{-- JIKA SUDAH UPLOAD --}}
    @else
        <div class="bg-white shadow rounded-xl p-6">
            <p class="mb-2">
                <strong>Judul:</strong> {{ $laporan->judul }}
            </p>

            <p class="mb-2">
                <strong>Status:</strong>
                @if($laporan->status === 'menunggu')
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                        Menunggu
                    </span>
                @else
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                        Diterima
                    </span>
                @endif
            </p>

            <a href="{{ asset('storage/'.$laporan->file) }}"
               target="_blank"
               class="inline-block mt-4 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                Download Laporan
            </a>

            <p class="mt-4 text-sm text-gray-500 italic">
                Laporan hanya dapat dikumpulkan satu kali dan tidak dapat diubah.
            </p>
        </div>
    @endif

</div>
@endsection
