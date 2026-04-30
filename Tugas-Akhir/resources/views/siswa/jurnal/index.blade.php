@extends('layouts.siswa')

@section('title', 'Jurnal Harian')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-100 to-purple-100 px-6 py-10">

    {{-- HEADER --}}
    <div class="max-w-5xl mx-auto mb-8 text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4 flex items-center justify-center">
            <i class="fas fa-book text-blue-600 mr-4"></i>
            Jurnal Harian PKL
        </h1>
        <p class="text-gray-600 text-lg">
            Isi jurnal kegiatan PKL Anda setiap hari.
        </p>
    </div>

    {{-- FORM INPUT JURNAL --}}
    <div class="max-w-5xl mx-auto bg-white shadow-2xl rounded-3xl p-8 mb-10 border border-gray-200">
        <form action="{{ route('siswa.jurnal.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                {{-- TANGGAL --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
                        Tanggal
                    </label>
                    <input
                        type="text"
                        value="{{ now()->format('d M Y') }}"
                        readonly
                        class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-gray-700 cursor-not-allowed"
                    >
                </div>

                {{-- JAM --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-clock text-yellow-500 mr-2"></i>
                        Jam
                    </label>
                    <input
                        type="text"
                        id="jam"
                        readonly
                        class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-gray-700 cursor-not-allowed"
                    >
                </div>

                {{-- JUDUL --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-heading text-green-600 mr-2"></i>
                        Judul Kegiatan
                    </label>
                    <input type="text"
                           name="judul"
                           placeholder="Contoh: Instalasi Jaringan"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>
            </div>

            {{-- DESKRIPSI --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                    <i class="fas fa-edit text-purple-600 mr-2"></i>
                    Deskripsi Kegiatan
                </label>
                <textarea name="kegiatan"
                          rows="5"
                          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="Jelaskan kegiatan PKL hari ini..."
                          required></textarea>
            </div>

            {{-- BUTTON --}}
            <div class="text-center">
                <button type="submit"
                        class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white px-8 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center mx-auto">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Jurnal
                </button>
            </div>
        </form>
    </div>

</div>

{{-- SCRIPT JAM REALTIME --}}
<script>
function updateJam() {
    const now = new Date();
    const jam = now.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });
    document.getElementById('jam').value = jam;
}

setInterval(updateJam, 1000);
updateJam();
</script>

@endsection
