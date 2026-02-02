@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="flex bg-gradient-to-br from-gray-100 to-blue-50 min-h-screen">
    <x-sidebar />

    <div class="flex-1 p-6">

        {{-- Toggle Sidebar --}}
        <button onclick="toggleSidebar()"
            class="mb-4 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg shadow">
            <i class="fas fa-bars"></i> Menu
        </button>

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-building text-blue-500 mr-3"></i>
                Data Tempat PKL
            </h1>

            <a href="{{ route('tempat_pkl.create') }}"
               class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-6 py-3 rounded-lg shadow">
                <i class="fas fa-plus mr-2"></i> Tambah Tempat PKL
            </a>
        </div>

        {{-- Search AJAX --}}
        <div class="mb-6 relative">
            <input type="text"
                   id="searchInput"
                   placeholder="Cari Nama Tempat / Alamat..."
                   class="w-full md:w-1/3 px-4 py-3 pl-10 border rounded-lg focus:ring-2 focus:ring-blue-500">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
        </div>

        {{-- Alert --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table AJAX --}}
        <div id="tableTempatPkl" class="bg-white rounded-xl shadow overflow-hidden">
            @include('admin.tempat_pkl.partials.table')
        </div>
    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('-ml-64');
}

let timer = null;
document.getElementById('searchInput').addEventListener('input', function () {
    clearTimeout(timer);
    const keyword = this.value;

    timer = setTimeout(() => {
        fetch(`{{ route('tempat_pkl.index') }}?search=${keyword}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById('tableTempatPkl').innerHTML = html;
        });
    }, 300);
});
</script>
@endsection
