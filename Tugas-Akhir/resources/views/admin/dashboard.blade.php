@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="flex bg-gradient-to-br from-gray-100 to-blue-50 min-h-screen">
    {{-- Sidebar --}}
    <x-sidebar />

    {{-- Konten --}}
    <div class="flex-1 p-6">

        {{-- Toggle Sidebar --}}
        <button onclick="toggleSidebar()"
            class="mb-6 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg shadow">
            <i class="fas fa-bars"></i> Menu
        </button>

        {{-- Header --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-8">
            👋 Selamat Datang, Admin
        </h1>

        {{-- Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
                <div class="p-4 bg-blue-100 rounded-full">
                    <i class="fas fa-user-graduate text-blue-600 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500">Jumlah Siswa</p>
                    <h2 class="text-3xl font-bold">{{ $jumlahSiswa }}</h2>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
                <div class="p-4 bg-green-100 rounded-full">
                    <i class="fas fa-user-tie text-green-600 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500">Jumlah Pembimbing</p>
                    <h2 class="text-3xl font-bold">{{ $jumlahPembimbing }}</h2>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
                <div class="p-4 bg-purple-100 rounded-full">
                    <i class="fas fa-building text-purple-600 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500">Tempat PKL</p>
                    <h2 class="text-3xl font-bold">{{ $jumlahTempatPkl }}</h2>
                </div>
            </div>

        </div>

        {{-- GRAFIK --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-10">

            {{-- Grafik Tempat PKL --}}
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-bold mb-4">
                    Distribusi Siswa per Tempat PKL
                </h3>
                <canvas id="chartTempat"></canvas>
            </div>

            {{-- Grafik Pembimbing --}}
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-bold mb-4">
                    Jumlah Siswa per Pembimbing
                </h3>
                <canvas id="chartPembimbing"></canvas>
            </div>

        </div>

        {{-- Info --}}
        <div class="mt-10 bg-white rounded-xl shadow p-6">
            <h3 class="text-xl font-semibold mb-2">📌 Informasi</h3>
            <p class="text-gray-600">
                Gunakan menu di samping untuk mengelola data siswa, pembimbing,
                tempat PKL, dan manajemen user.
            </p>
        </div>

    </div>
</div>

{{-- SCRIPT --}}
<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('-ml-64');
}

// =======================
// DATA DARI CONTROLLER
// =======================
const tempat = @json($siswaPerTempat ?? []);
const pembimbing = @json($siswaPerPembimbing ?? []);

// =======================
// HITUNG TOTAL
// =======================
const totalSiswaTempat = tempat.reduce((sum, item) => sum + parseInt(item.total), 0);
const totalSiswaPembimbing = pembimbing.reduce((sum, item) => sum + parseInt(item.total), 0);

// =======================
// GRAFIK TEMPAT PKL
// =======================
new Chart(document.getElementById('chartTempat'), {
    type: 'pie',
    data: {
        labels: tempat.map(t => t.nama_tempat),
        datasets: [{
            data: tempat.map(t => t.total),
            backgroundColor: [
                '#3B82F6',
                '#10B981',
                '#F59E0B',
                '#EF4444',
                '#8B5CF6',
                '#14B8A6',
                '#F43F5E'
            ]
        }]
    },
    options: {
        plugins: {
            legend: {
                position: 'bottom'
            },
            title: {
                display: true,
                text: 'Total Siswa: ' + totalSiswaTempat
            }
        }
    }
});

// =======================
// GRAFIK PEMBIMBING
// =======================
new Chart(document.getElementById('chartPembimbing'), {
    type: 'bar',
    data: {
        labels: pembimbing.map(p => p.nama_pembimbing),
        datasets: [{
            label: 'Jumlah Siswa',
            data: pembimbing.map(p => p.total),
            backgroundColor: '#10B981'
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    precision: 0,
                    stepSize: 1
                }
            }
        },
        plugins: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: 'Total Siswa: ' + totalSiswaPembimbing
            }
        }
    }
});
</script>

@endsection
