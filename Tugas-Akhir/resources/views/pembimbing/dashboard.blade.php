@extends('layouts.pembimbing')

@section('title', 'Dashboard Pembimbing')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="max-w-7xl mx-auto">

    <h1 class="text-3xl font-bold text-gray-800 mb-8 flex items-center">
        <i class="fas fa-chart-line text-indigo-600 mr-3"></i>
        Dashboard Pembimbing
    </h1>

    {{-- STAT BOX --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500">
            <p class="text-gray-500 text-sm">Total Siswa Bimbingan</p>
            <h2 class="text-3xl font-bold text-gray-800">
                {{ $totalSiswa ?? 0 }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500">
            <p class="text-gray-500 text-sm">Chat Belum Dibaca</p>
            <h2 class="text-3xl font-bold text-gray-800">
                {{ $chatBaru ?? 0 }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-purple-500">
            <p class="text-gray-500 text-sm">File Laporan Masuk</p>
            <h2 class="text-3xl font-bold text-gray-800">
                {{ $fileMasuk ?? 0 }}
            </h2>
        </div>

    </div>

    {{-- LIST SISWA --}}
    <div class="bg-white rounded-2xl shadow-xl p-6 mb-10">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            Siswa Bimbingan Terbaru
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Tempat PKL</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswa as $s)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $s->nama }}</td>
                            <td class="px-4 py-3">{{ $s->tempatPkl->nama_tempat ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                    Aktif
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="#" class="text-blue-600 hover:underline">
                                    Bimbingan
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">
                                Belum ada siswa
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- RINGKASAN --}}
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="bg-blue-100 p-4 rounded-lg text-center">
            <p class="text-sm text-gray-600">Total Jurnal</p>
            <h3 class="text-xl font-bold text-blue-700">
                {{ collect($jurnalPerBulan)->sum('total') }}
            </h3>
        </div>
        <div class="bg-purple-100 p-4 rounded-lg text-center">
            <p class="text-sm text-gray-600">Total Laporan</p>
            <h3 class="text-xl font-bold text-purple-700">
                {{ collect($laporanPerBulan)->sum('total') }}
            </h3>
        </div>
    </div>

    {{-- GRAFIK --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Grafik Aktivitas --}}
        <div class="bg-white p-6 rounded-2xl shadow-lg">
            <h2 class="text-lg font-bold text-gray-700 mb-4">
                Grafik Aktivitas (Per Bulan)
            </h2>
            <canvas id="chartGabungan"></canvas>
        </div>

        {{-- Grafik Tempat PKL --}}
        <div class="bg-white p-6 rounded-2xl shadow-lg">
            <h2 class="text-lg font-bold text-gray-700 mb-4">
                Distribusi Siswa per Tempat PKL
            </h2>
            <canvas id="chartTempatPkl"></canvas>
        </div>

    </div>

</div>

{{-- SCRIPT --}}
<script>
    // =======================
    // GRAFIK JURNAL & LAPORAN
    // =======================
    const jurnal = @json($jurnalPerBulan ?? []);
    const laporan = @json($laporanPerBulan ?? []);

    const semuaBulan = [...new Set([
        ...jurnal.map(j => j.bulan),
        ...laporan.map(l => l.bulan)
    ])].sort();

    const dataJurnal = semuaBulan.map(bulan => {
        const found = jurnal.find(j => j.bulan === bulan);
        return found ? found.total : 0;
    });

    const dataLaporan = semuaBulan.map(bulan => {
        const found = laporan.find(l => l.bulan === bulan);
        return found ? found.total : 0;
    });

    new Chart(document.getElementById('chartGabungan'), {
        type: 'bar',
        data: {
            labels: semuaBulan,
            datasets: [
                {
                    label: 'Jurnal',
                    data: dataJurnal,
                    backgroundColor: 'rgba(59, 130, 246, 0.7)'
                },
                {
                    label: 'Laporan',
                    data: dataLaporan,
                    backgroundColor: 'rgba(168, 85, 247, 0.7)'
                }
            ]
        }
    });

    // =======================
    // GRAFIK TEMPAT PKL
    // =======================
    const tempatData = @json($tempatPklChart ?? []);

    const tempatLabels = tempatData.map(item => item.nama_tempat);
    const tempatTotal = tempatData.map(item => item.total);

    new Chart(document.getElementById('chartTempatPkl'), {
        type: 'pie',
        data: {
            labels: tempatLabels,
            datasets: [{
                data: tempatTotal,
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
        }
    });
</script>

@endsection
