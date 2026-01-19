@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-purple-600">
    <div class="max-w-md w-full mx-4">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    E-JURNAL
                </h1>
                <p class="text-gray-600 text-lg">JURNAL TANPA RIBET</p>
            </div>

            <!-- Form -->
            <form action="/dashboard" method="GET">
                <!-- Nama Akun -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Nama Akun*
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Masukkan username"
                           required>
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Password*
                    </label>
                    <input type="password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Masukkan password"
                           required>
                </div>

                <!-- Tombol Login -->
                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
                    MASUK
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Simple CSS untuk efek -->
<style>
    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    input:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    button:hover {
        transform: translateY(-2px);
    }
    button {
        transition: all 0.3s ease;
    }
</style>
@endsection