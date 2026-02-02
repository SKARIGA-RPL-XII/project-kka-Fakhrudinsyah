@extends('layouts.app')

@section('content')
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{-- WRAPPER UNTUK SIDEBAR DAN KONTEN UTAMA --}}
    <div class="flex bg-gradient-to-br from-gray-100 to-blue-50 min-h-screen">
        {{-- Sidebar --}}
        <x-sidebar />
        
        {{-- KONTEN UTAMA --}}
        <div class="flex-1 p-6">
            {{-- Toggle Sidebar --}}
            <button
                onclick="toggleSidebar()"
                class="mb-4 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-800 hover:scale-105 transition-all duration-300"
            >
                <i class="fas fa-bars"></i> Menu
            </button>

            {{-- Judul Halaman --}}
            <h1 class="text-3xl font-bold mb-6 text-gray-800 flex items-center">
                <i class="fas fa-user-edit text-blue-500 mr-3"></i> Edit User
            </h1>

            {{-- Pesan Sukses --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 border-l-4 border-green-500 flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i> {{ session('success') }}
                </div>
            @endif

            {{-- Pesan Error --}}
            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6 border-l-4 border-red-500 flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($user->role === 'admin')
                <div class="bg-yellow-100 text-yellow-700 p-4 rounded-lg mb-6 border-l-4 border-yellow-500 flex items-center">
                    <i class="fas fa-exclamation-triangle text-yellow-500 mr-3"></i> User dengan role Admin tidak dapat diedit.
                </div>
                <a href="{{ route('manajemen_user.index') }}"
                   class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-gray-600 hover:to-gray-700 hover:scale-105 transition-all duration-300 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            @else
                {{-- Form Edit --}}
                <div class="bg-white p-8 rounded-xl shadow-xl">
                    <form action="{{ route('manajemen_user.update', $user) }}" method="POST" class="grid grid-cols-1 gap-6">
                        @csrf
                        @method('PUT')

                        {{-- ROLE (READ ONLY) --}}
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Role</label>
                            <input type="text"
                                   value="{{ ucfirst($user->role) }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   readonly>
                        </div>

                        {{-- NAMA LENGKAP --}}
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                            <input type="text"
                                   name="nama"
                                   value="{{ old('nama', $user->nama) }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   required>
                        </div>

                        {{-- USERNAME / NIS --}}
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                @if($user->role === 'siswa')
                                    Username (NIS)
                                @else
                                    Username
                                @endif
                            </label>
                            @if($user->role === 'pembimbing')
                                <input type="text"
                                       name="username"
                                       value="{{ old('username', $user->username) }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       required>
                            @elseif($user->role === 'siswa')
                                <input type="text"
                                       name="nis"
                                       value="{{ old('nis', $user->nis) }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       required>
                            @endif
                        </div>

                        {{-- PASSWORD --}}
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                Password
                                <span class="text-sm text-gray-500">(kosongkan jika tidak diubah)</span>
                            </label>
                            <div class="relative">
                                <input type="password"
                                       name="password"
                                       id="password"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-3 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <button
                                    type="button"
                                    onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700 transition-colors"
                                >
                                    <i id="togglePasswordIcon" class="fas fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="flex gap-4 justify-end">
                            <button type="submit"
                                    class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-6 py-3 rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-800 hover:scale-105 transition-all duration-300 flex items-center">
                                <i class="fas fa-save mr-2"></i> Update
                            </button>
                            <a href="{{ route('manajemen_user.index') }}"
                               class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-6 py-3 rounded-lg shadow-lg hover:from-gray-600 hover:to-gray-700 hover:scale-105 transition-all duration-300 flex items-center">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-ml-64');
        }

        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('togglePasswordIcon');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    </script>
@endsection
