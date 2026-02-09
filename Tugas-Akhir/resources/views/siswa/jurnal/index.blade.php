@extends('layouts.siswa')

@section('title', 'Jurnal Harian')

@section('content')

<div class="bg-white min-h-screen px-6 py-10">

    {{-- HEADER --}}
    <div class="max-w-5xl mx-auto mb-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">
            Jurnal Harian PKL
        </h1>
        <p class="text-gray-600">
            Isi jurnal kegiatan PKL Anda setiap hari.
        </p>
    </div>

    {{-- FORM INPUT JURNAL --}}
    <div class="max-w-5xl mx-auto bg-gray-50 border rounded-xl p-6 mb-10">
        <form action="#" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Tanggal
                    </label>
                                        <input
                            type="date"
                            value="{{ now()->format('Y-m-d') }}"
                            readonly
                            class="w-full bg-gray-100 border rounded-lg px-4 py-2 text-gray-700 cursor-not-allowed"
                        >
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Judul Kegiatan
                    </label>
                    <input type="text"
                           name="judul"
                           placeholder="Contoh: Instalasi Jaringan"
                           class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200"
                           required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Deskripsi Kegiatan
                </label>
                <textarea name="kegiatan"
                          rows="4"
                          class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200"
                          placeholder="Jelaskan kegiatan PKL hari ini..."
                          required></textarea>
            </div>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold">
                Simpan Jurnal
            </button>
        </form>
    </div>

</div>

@endsection
