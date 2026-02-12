@extends('layouts.siswa')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-100 to-purple-100 py-16">
    <div class="max-w-3xl mx-auto px-6">
        <div class="bg-white shadow-2xl rounded-3xl p-10 border border-gray-200">

            <h2 class="text-4xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center">
                <i class="fas fa-edit text-blue-600 mr-4"></i>
                Edit Jurnal
            </h2>

            {{-- ALERT ERROR --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg border-l-4 border-red-500 flex items-start">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-3 mt-1"></i>
                    <div>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('siswa.jurnal.update', $jurnal->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- JUDUL --}}
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-3 flex items-center">
                        <i class="fas fa-heading text-blue-600 mr-2"></i>
                        Judul Jurnal
                    </label>
                    <input
                        type="text"
                        name="judul"
                        value="{{ old('judul', $jurnal->judul) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 shadow-sm"
                        required
                    >
                </div>

                {{-- ISI / KEGIATAN --}}
                <div class="mb-8">
                    <label class="block text-gray-700 font-semibold mb-3 flex items-center">
                        <i class="fas fa-edit text-green-600 mr-2"></i>
                        Isi / Kegiatan
                    </label>
                    <textarea
                        name="kegiatan"
                        rows="8"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 shadow-sm resize-none"
                        required
                    >{{ old('kegiatan', $jurnal->kegiatan) }}</textarea>
                </div>

                {{-- BUTTON --}}
                <div class="flex justify-end gap-4">
                    <a href="{{ route('siswa.jurnal.history') }}"
                       class="px-6 py-3 rounded-lg bg-gradient-to-r from-gray-400 to-gray-500 text-white hover:from-gray-500 hover:to-gray-600 transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="px-6 py-3 rounded-lg bg-gradient-to-r from-blue-500 to-blue-700 text-white hover:from-blue-600 hover:to-blue-800 transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
