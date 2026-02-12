@extends('layouts.siswa')

@section('title', 'Laporan Akhir')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-100 to-purple-100 px-6 py-10">
    <div class="max-w-3xl mx-auto">

        <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center">
            <i class="fas fa-file-powerpoint text-blue-600 mr-4"></i>
            Laporan Akhir
        </h1>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="mb-6 bg-green-100 text-green-700 px-6 py-4 rounded-lg border-l-4 border-green-500 flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-100 text-red-700 px-6 py-4 rounded-lg border-l-4 border-red-500 flex items-center">
                <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                {{ session('error') }}
            </div>
        @endif

        {{-- JIKA BELUM UPLOAD --}}
        @if(!$laporan)
            <div class="bg-white shadow-2xl rounded-3xl p-8 border border-gray-200">
                <form action="{{ route('siswa.laporan.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="mb-6">
                        <label class="block font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-heading text-blue-600 mr-2"></i>
                            Judul Laporan
                        </label>
                        <input type="text"
                               name="judul"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                               required>
                    </div>

                    <div class="mb-8">
                        <label class="block font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-upload text-green-600 mr-2"></i>
                            File Laporan (PPT / PPTX)
                        </label>
                        <div class="relative">
                            <input type="file"
                                   name="file"
                                   accept=".ppt,.pptx"
                                   id="file-input"
                                   class="hidden"
                                   required>
                            <label for="file-input"
                                   id="drop-zone"
                                   class="flex items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition duration-200">
                                <div class="text-center">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                    <p class="text-gray-600 font-medium">Klik untuk memilih file atau drag & drop</p>
                                    <p class="text-sm text-gray-500">Format: PPT atau PPTX</p>
                                </div>
                            </label>
                            <div id="file-preview" class="mt-4 hidden">
                                <div class="flex items-center p-4 bg-gradient-to-r from-green-50 to-green-100 border border-green-200 rounded-lg shadow-sm">
                                    <i class="fas fa-file-powerpoint text-3xl text-green-600 mr-4"></i>
                                    <div class="flex-1">
                                        <p class="text-gray-800 font-semibold" id="file-name-text"></p>
                                        <p class="text-sm text-gray-600" id="file-size-text"></p>
                                    </div>
                                    <button type="button" id="remove-file" class="text-red-500 hover:text-red-700 transition duration-200">
                                        <i class="fas fa-times text-xl"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit"
                                class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white px-8 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Kumpulkan Laporan
                        </button>
                    </div>
                </form>
            </div>

        {{-- JIKA SUDAH UPLOAD --}}
        @else
            <div class="bg-white shadow-2xl rounded-3xl p-8 border border-gray-200">
                <div class="mb-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-file-alt text-gray-600 mr-3 text-2xl"></i>
                        <span class="text-gray-700 font-medium">Judul:</span>
                    </div>
                    <p class="text-gray-800 font-semibold text-lg ml-9">{{ $laporan->judul }}</p>
                </div>

                <div class="mb-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-info-circle text-gray-600 mr-3 text-2xl"></i>
                        <span class="text-gray-700 font-medium">Status:</span>
                    </div>
                    <div class="ml-9">
                        @if($laporan->status === 'menunggu')
                            <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-semibold border border-yellow-200">
                                Menunggu
                            </span>
                        @else
                            <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold border border-green-200">
                                Diterima
                            </span>
                        @endif
                    </div>
                </div>

                <div class="text-center mb-6">
                    <a href="{{ asset('storage/'.$laporan->file) }}"
                       target="_blank"
                       class="bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white px-6 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 inline-flex items-center">
                        <i class="fas fa-download mr-2"></i>
                        Download Laporan
                    </a>
                </div>

                <p class="text-center text-sm text-gray-500 italic border-t pt-4">
                    Laporan hanya dapat dikumpulkan satu kali dan tidak dapat diubah.
                </p>
            </div>
        @endif

    </div>
</div>

<script>
    const fileInput = document.getElementById('file-input');
    const dropZone = document.getElementById('drop-zone');
    const filePreview = document.getElementById('file-preview');
    const fileNameText = document.getElementById('file-name-text');
    const fileSizeText = document.getElementById('file-size-text');
    const removeFileBtn = document.getElementById('remove-file');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    dropZone.addEventListener('drop', handleDrop, false);

    fileInput.addEventListener('change', function() {
        handleFiles(this.files);
    });

    removeFileBtn.addEventListener('click', function() {
        fileInput.value = '';
        filePreview.classList.add('hidden');
        dropZone.style.display = 'flex';
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight(e) {
        dropZone.classList.add('border-blue-500', 'bg-blue-50');
    }

    function unhighlight(e) {
        dropZone.classList.remove('border-blue-500', 'bg-blue-50');
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        handleFiles(files);
    }

    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];
            const allowedTypes = ['application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'];
            if (!allowedTypes.includes(file.type)) {
                alert('Hanya file PPT atau PPTX yang diperbolehkan.');
                return;
            }

            const dt = new DataTransfer();
            dt.items.add(file);
            fileInput.files = dt.files;

            fileNameText.textContent = file.name;
            fileSizeText.textContent = formatFileSize(file.size);
            filePreview.classList.remove('hidden');
            dropZone.style.display = 'none';
        }
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
</script>

@endsection