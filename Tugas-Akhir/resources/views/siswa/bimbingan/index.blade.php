@extends('layouts.siswa')

@section('title', 'Bimbingan')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-100 to-purple-100 px-6 py-10">
        <div class="max-w-5xl mx-auto">

            <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center">
                <i class="fas fa-comments text-blue-600 mr-4"></i>
                Bimbingan dengan Pembimbing
            </h1>

            {{-- CHAT BOX --}}
            <div id="chat-box" class="bg-white shadow-2xl rounded-3xl p-6 h-[500px] overflow-y-auto mb-6 space-y-4 border border-gray-200">

                @forelse($messages as $msg)
                    <div class="flex {{ $msg->siswa_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-md px-4 py-3 rounded-2xl shadow-sm
                            {{ $msg->siswa_id == auth()->id()
                                ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white'
                                : 'bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800' }}">
                            
                            @if($msg->pesan)
                                <p class="text-sm leading-relaxed">{{ $msg->pesan }}</p>
                            @endif

                            @if($msg->file)
                                <a href="{{ asset('storage/'.$msg->file) }}"
                                   class="block mt-2 underline text-sm hover:text-blue-300 transition duration-200"
                                   target="_blank">
                                    <i class="fas fa-paperclip mr-1"></i> Lihat File
                                </a>
                            @endif

                            <span class="block text-xs opacity-70 mt-2">
                                {{ $msg->created_at->format('d M Y H:i') }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 py-10">
                        <i class="fas fa-comments text-4xl mb-4 text-gray-300"></i>
                        <p>Belum ada percakapan. Mulai bimbingan dengan mengirim pesan!</p>
                    </div>
                @endforelse
            </div>

            {{-- FORM --}}
            <form action="{{ route('siswa.bimbingan.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="bg-white shadow-2xl rounded-3xl p-6 border border-gray-200">
                @csrf

                <div class="flex gap-4 items-end">
                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-comment text-blue-600 mr-2"></i>
                            Pesan
                        </label>
                        <input type="text"
                               name="pesan"
                               placeholder="Ketik pesan Anda..."
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                    </div>

                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-paperclip text-green-600 mr-2"></i>
                            File (Opsional)
                        </label>
                        <div class="relative">
                            <input type="file"
                                   name="file"
                                   id="file-input"
                                   class="hidden">
                            <label for="file-input"
                                   id="drop-zone"
                                   class="flex items-center justify-center w-full h-12 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition duration-200">
                                <div class="text-center">
                                    <i class="fas fa-cloud-upload-alt text-gray-400 mr-2"></i>
                                    <span class="text-gray-600 text-sm">Pilih file atau drag & drop</span>
                                </div>
                            </label>
                            <div id="file-preview" class="mt-2 hidden">
                                <div class="flex items-center p-2 bg-gradient-to-r from-green-50 to-green-100 border border-green-200 rounded-lg shadow-sm">
                                    <i class="fas fa-file text-green-600 mr-2"></i>
                                    <div class="flex-1">
                                        <p class="text-gray-800 font-semibold text-sm" id="file-name-text"></p>
                                        <p class="text-xs text-gray-600" id="file-size-text"></p>
                                    </div>
                                    <button type="button" id="remove-file" class="text-red-500 hover:text-red-700 transition duration-200">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white px-6 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        // Auto scroll to bottom of chat
        const chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;

        // Drag and drop functionality
        const fileInput = document.getElementById('file-input');
        const dropZone = document.getElementById('drop-zone');
        const filePreview = document.getElementById('file-preview');
        const fileNameText = document.getElementById('file-name-text');
        const fileSizeText = document.getElementById('file-size-text');
        const removeFileBtn = document.getElementById('remove-file');

        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        // Highlight drop zone when item is dragged over it
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        // Handle dropped files
        dropZone.addEventListener('drop', handleDrop, false);

        // Handle file input change
        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
        });

        // Handle remove file
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

                // Set file to input
                const dt = new DataTransfer();
                dt.items.add(file);
                fileInput.files = dt.files;

                // Display file preview
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
