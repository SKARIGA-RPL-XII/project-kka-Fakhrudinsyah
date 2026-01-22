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

    /* Background */
   .bg-library {
    min-height: 100vh;
    background-image: url("{{ asset('image/library.jpg') }}");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;

    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

<!-- Background -->
<div class="bg-library">

    <!-- Login Container -->
    <div class="flex justify-center" style="width: 800px;">
        <div class="max-w-md w-full mx-4">
            <div class="bg-white rounded-2xl shadow-2xl p-8">

                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">
                        E-JURNAL
                    </h1>
                    <p class="text-gray-600 text-lg">
                        JURNAL TANPA RIBET
                    </p>
                </div>

                <!-- Form -->
                <form id="form-login" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Nama Akun*
                        </label>
                        <input type="text"
                            name="username"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg"
                            placeholder="Masukkan username"
                            required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Password*
                        </label>
                        <input type="password"
                            name="password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg"
                            placeholder="Masukkan password"
                            required>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg">
                        MASUK
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            }
        });
        $('#form-login').on('submit', function(e) {
            e.preventDefault(); // mencegah reload halaman
            let username = $('input[type="text"]').val();
            let password = $('input[type="password"]').val();
            $.ajax({
                url: '/login-check', // URL STATIC DULU
                type: 'POST', // sementara GET
                data: {
                    username: username,
                    password: password
                },
                beforeSend: function() {
                    console.log('Mengirim data...');
                },
                success: function(response) {
                    console.log(response);
                    // contoh respon statis
                    if (response.status === 'success') {
                        alert('Login berhasil');
                        window.location.href = '/dashboard';
                    } else {
                        alert('Username atau password salah');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Terjadi kesalahan pada server');
                }
            });

        });

    });
</script>
@endsection