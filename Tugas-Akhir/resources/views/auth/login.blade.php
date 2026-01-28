@extends('layouts.app')

@section('title', 'Login')

@section('content')

<style>
    /* Card & Button */
    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    input:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    button {
        transition: all 0.3s ease;
    }

    button:hover {
        transform: translateY(-2px);
    }

    /* Background with overlay for better text readability */
    .bg-library {
        min-height: 100vh;
        background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url("{{ asset('image/library.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Additional styles for enhanced appeal */
    .input-icon {
        position: relative;
    }

    .input-icon i {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9CA3AF;
    }

    .card-glow {
        box-shadow: 0 0 30px rgba(59, 130, 246, 0.2);
    }
</style>

<!-- Font Awesome CDN for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Background -->
<div class="bg-library">

    <!-- Login Container -->
    <div class="flex justify-center" style="width: 800px;">
        <div class="max-w-md w-full mx-4">
            <div class="bg-white rounded-2xl shadow-2xl p-8 card-glow hover:shadow-3xl transition-shadow duration-500">

                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="mb-4">
                        <i class="fas fa-book-open text-4xl text-blue-600"></i>
                    </div>
                    <h1 class="text-4xl font-extrabold text-gray-800 mb-2 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        E-JURNAL
                    </h1>
                    <p class="text-gray-600 text-lg font-medium">
                        JURNAL Online
                    </p>
                </div>

                <!-- Form -->
                <form action="{{ route('handlelogin') }}" method="POST">
                    @csrf

                    <div class="mb-6 input-icon">
                        <label class="block text-gray-700 text-sm font-bold mb-2"> NIS*
                        </label>
                        <input type="text"
                            name="nis"
                            value="{{ old('nis') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-0"
                            placeholder="Masukkan NIS"
                            required>

                        @error('nis')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-6 input-icon">
                        <label class="block text-gray-700 text-sm font-bold mb-2"> Password*
                        </label>
                        <input type="password"
                            name="password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-0"
                            placeholder="Masukkan password"
                            required>

                        @error('password')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white font-bold py-3 rounded-lg shadow-lg hover:shadow-xl">
                        <i class="fas fa-sign-in-alt mr-2"></i> MASUK
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection