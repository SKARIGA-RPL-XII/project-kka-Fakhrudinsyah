@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .bg-library {
            min-height: 100vh;
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                url("{{ asset('image/library.jpg') }}");
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-glow {
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.2);
        }
    </style>

    <div class="bg-library">
        <div class="flex justify-center w-full px-4">
            <div class="max-w-md w-full">
                <div class="bg-white rounded-2xl shadow-2xl p-8 card-glow">

                    {{-- HEADER --}}
                    <div class="text-center mb-8">
                        <i class="fas fa-book-open text-4xl text-blue-600 mb-3"></i>
                        <h1 class="text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            E-JURNAL
                        </h1>
                        <p class="text-gray-600 font-medium">JURNAL Online</p>
                    </div>

                    {{-- Pesan Error --}}
                    @if(session('error'))
                        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6 border-l-4 border-red-500 flex items-center">
                            <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i> {{ session('error') }}
                        </div>
                    @endif

                    {{-- FORM --}}
                    <form action="{{ route('handlelogin') }}" method="POST">
                        @csrf

                        {{-- USERNAME / NIS --}}
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Username / NIS
                            </label>
                            <input
                                type="text"
                                name="login"
                                value="{{ old('login') }}"
                                placeholder="Masukkan Username atau NIS"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required
                            >
                            @error('login')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>

                            {{-- PASSWORD --}}
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Password
                                </label>

                                <div class="relative">
                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        placeholder="Masukkan password"
                                        class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg
                                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required
                                    >

                                    <button
                                        type="button"
                                        onclick="togglePassword()"
                                        class="absolute right-3 top-1/2 -translate-y-1/2
                                            text-gray-500 hover:text-gray-700 transition-colors"
                                    >
                                        <i id="togglePasswordIcon" class="fas fa-eye-slash"></i>
                                    </button>
                                </div>

                                @error('password')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>

                        {{-- BUTTON --}}
                        <button
                            type="submit"
                            class="w-full bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white font-bold py-3 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center"
                        >
                            <i class="fas fa-sign-in-alt mr-2"></i> MASUK
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- SHOW / HIDE PASSWORD --}}
    <script>
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