@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="flex bg-gray-100 min-h-screen">
    <x-sidebar />

    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold mb-6">Tambah User</h1>

        <div class="bg-white p-6 rounded shadow">
            <form action="{{ route('manajemen_user.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- ROLE --}}
                <div>
                    <label class="font-semibold">Role</label>
                    <select name="role" id="role" onchange="toggleField()"
                        class="w-full border rounded px-4 py-2" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="pembimbing" {{ old('role') == 'pembimbing' ? 'selected' : '' }}>Pembimbing</option>
                        <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                    </select>
                </div>

                {{-- NAMA --}}
                <div id="namaField" class="hidden">
                    <label class="font-semibold">Nama Lengkap</label>
                    <input type="text" name="nama"
                        class="w-full border rounded px-4 py-2" value="{{ old('nama') }}">
                </div>

                {{-- USERNAME (Admin & Pembimbing) --}}
                <div id="usernameField" class="hidden">
                    <label class="font-semibold">Username</label>
                    <input type="text" name="username"
                        class="w-full border rounded px-4 py-2" value="{{ old('username') }}">
                </div>

                {{-- NIS (Siswa) --}}
                <div id="nisField" class="hidden">
                    <label class="font-semibold">NIS</label>
                    <input type="text" name="nis"
                        class="w-full border rounded px-4 py-2" value="{{ old('nis') }}">
                </div>

                {{-- PASSWORD --}}
                <div>
                    <label class="font-semibold">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password"
                            class="w-full border rounded px-4 py-2 pr-10" required>
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3 top-2.5 text-gray-500">
                            <i id="togglePasswordIcon" class="fas fa-eye-slash"></i>
                        </button>
                    </div>
                </div>

                {{-- BUTTON --}}
                <div class="flex justify-end gap-3">
                    <button class="bg-blue-600 text-white px-6 py-2 rounded">
                        Simpan
                    </button>
                    <a href="{{ route('manajemen_user.index') }}"
                        class="bg-gray-500 text-white px-6 py-2 rounded">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleField() {
    const role = document.getElementById('role').value;

    const nama = document.getElementById('namaField');
    const username = document.getElementById('usernameField');
    const nis = document.getElementById('nisField');

    // reset
    [nama, username, nis].forEach(el => el.classList.add('hidden'));

    if (role === 'admin' || role === 'pembimbing') {
        nama.classList.remove('hidden');
        username.classList.remove('hidden');
    }

    if (role === 'siswa') {
        nama.classList.remove('hidden');
        nis.classList.remove('hidden');
    }
}

function togglePassword() {
    const password = document.getElementById('password');
    const icon = document.getElementById('togglePasswordIcon');

    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    } else {
        password.type = 'password';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    }
}

// handle old input
document.addEventListener('DOMContentLoaded', () => {
    const oldRole = "{{ old('role') }}";
    if (oldRole) {
        document.getElementById('role').value = oldRole;
        toggleField();
    }
});
</script>
@endsection
