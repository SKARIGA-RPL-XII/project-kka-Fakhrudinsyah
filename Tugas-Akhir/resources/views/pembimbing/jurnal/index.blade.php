@extends('layouts.pembimbing')

@section('title', 'Review Jurnal')

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

    <h2 class="text-xl font-bold mb-6 text-gray-700">
        Review Jurnal Siswa
    </h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @forelse($jurnals as $jurnal)
        <div class="border rounded-lg p-5 mb-6 bg-gray-50">

            <div class="flex justify-between items-start mb-3">
                <div>
                    <h3 class="font-semibold text-lg text-gray-800">
                        {{ $jurnal->judul }}
                    </h3>
                    <p class="text-sm text-gray-500">
                        Siswa: {{ $jurnal->siswa->nama }}
                    </p>
                    <p class="text-sm text-gray-500">
                        Tanggal: {{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d M Y') }}
                    </p>
                </div>

                <span class="px-3 py-1 text-xs rounded-full
                    {{ $jurnal->status == 'diterima'
                        ? 'bg-green-100 text-green-700'
                        : 'bg-yellow-100 text-yellow-700' }}">
                    {{ ucfirst($jurnal->status) }}
                </span>
            </div>

            <div class="mb-4 text-gray-700">
                {!! nl2br(e($jurnal->kegiatan)) !!}
            </div>

            <form action="{{ route('pembimbing.jurnal.update', $jurnal->id) }}"
                  method="POST"
                  class="space-y-3">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Catatan Pembimbing
                    </label>
                    <textarea name="catatan_pembimbing"
                              rows="3"
                              class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring"
                              placeholder="Berikan catatan...">{{ $jurnal->catatan_pembimbing }}</textarea>
                </div>

                <div class="flex justify-between items-center">
                    <select name="status"
                            class="border rounded-lg px-3 py-2">
                        <option value="menunggu"
                            {{ $jurnal->status == 'menunggu' ? 'selected' : '' }}>
                            Menunggu
                        </option>
                        <option value="diterima"
                            {{ $jurnal->status == 'diterima' ? 'selected' : '' }}>
                            Diterima
                        </option>
                    </select>

                    <button class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    @empty
        <p class="text-center text-gray-400">
            Belum ada jurnal dari siswa.
        </p>
    @endforelse

</div>

@endsection
