@extends('layouts.siswa')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        ✏️ Edit Jurnal
    </h2>

    {{-- ALERT ERROR --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('siswa.jurnal.update', $jurnal->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- JUDUL --}}
        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">
                Judul Jurnal
            </label>
            <input
                type="text"
                name="judul"
                value="{{ old('judul', $jurnal->judul) }}"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
        </div>

        {{-- ISI / KEGIATAN --}}
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                Isi / Kegiatan
            </label>
            <textarea
                name="kegiatan"
                rows="6"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >{{ old('kegiatan', $jurnal->kegiatan) }}</textarea>
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('siswa.jurnal.history') }}"
               class="px-5 py-2 rounded-lg bg-gray-300 text-gray-800 hover:bg-gray-400 transition">
                Batal
            </a>

            <button
                type="submit"
                class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                Simpan Perubahan
            </button>
        </div>

    </form>

</div>
@endsection
