@extends('layouts.app')

@section('content')

<!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="flex bg-gradient-to-br from-gray-100 to-blue-50 min-h-screen">
    {{-- SIDEBAR --}}
    <x-sidebar />

    {{-- CONTENT --}}
    <div class="flex-1 p-6">
        <!-- Toggle -->
        <button
            onclick="toggleSidebar()"
            class="mb-4 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg shadow-lg hover:scale-105 transition"
        >
            <i class="fas fa-bars"></i> Menu
        </button>

        <h1 class="text-3xl font-bold mb-6 text-gray-800 flex items-center">
            <i class="fas fa-user-edit text-blue-500 mr-3"></i> Edit User
        </h1>

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6 border-l-4 border-red-500">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-xl p-8">
            <form action="{{ route('manajemen_user.update', $user->user_id) }}"
                  method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div>
                    <label class="font-semibold mb-2 block">Nama</label>
                    <input type="text" name="nama"
                           value="{{ $user->nama }}"
                           class="w-full border rounded-lg px-4 py-3" required>
                </div>

                {{-- NIS --}}
                <div>
                    <label class="font-semibold mb-2 block">NIS</label>
                    <input type="text"
                           value="{{ $user->nis }}"
                           class="w-full border rounded-lg px-4 py-3 bg-gray-100"
                           disabled>
                </div>

                {{-- Role --}}
                <div>
                    <label class="font-semibold mb-2 block">Role</label>
                    <select name="role" id="role" onchange="toggleField()"
                        class="w-full border rounded-lg px-4 py-3" required>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="pembimbing" {{ $user->role === 'pembimbing' ? 'selected' : '' }}>Pembimbing</option>
                        <option value="siswa" {{ $user->role === 'siswa' ? 'selected' : '' }}>Siswa</option>
                    </select>
                </div>

                {{-- Tempat PKL --}}
                <div id="pklField" class="{{ $user->role !== 'siswa' ? 'hidden' : '' }}">
                    <label class="font-semibold mb-2 block">Tempat PKL</label>
                    <select name="tempat_pkl_id" class="w-full border rounded-lg px-4 py-3">
                        <option value="">-- Pilih Tempat PKL --</option>
                        @foreach ($tempatPkl as $pkl)
                            <option value="{{ $pkl->tempat_pkl_id }}"
                                {{ $user->tempat_pkl_id == $pkl->tempat_pkl_id ? 'selected' : '' }}>
                                {{ $pkl->nama_tempat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Pembimbing --}}
                <div id="pembimbingField" class="{{ $user->role !== 'siswa' ? 'hidden' : '' }}">
                    <label class="font-semibold mb-2 block">Pembimbing</label>
                    <select name="pembimbing_id" class="w-full border rounded-lg px-4 py-3">
                        <option value="">-- Pilih Pembimbing --</option>
                        @foreach ($pembimbing as $p)
                            <option value="{{ $p->user_id }}"
                                {{ $user->pembimbing_id == $p->user_id ? 'selected' : '' }}>
                                {{ $p->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- BUTTON --}}
                <div class="flex gap-4 pt-4">
                    <button class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700">
                        <i class="fas fa-save mr-2"></i> Update
                    </button>
                    <a href="{{ route('manajemen_user.index') }}"
                       class="bg-gray-500 text-white px-6 py-3 rounded-lg shadow hover:bg-gray-600">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('-ml-64');
    }

    function toggleField() {
        const role = document.getElementById('role').value;
        document.getElementById('pklField').classList.toggle('hidden', role !== 'siswa');
        document.getElementById('pembimbingField').classList.toggle('hidden', role !== 'siswa');
    }
</script>
@endsection
