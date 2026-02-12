@extends('layouts.pembimbing')

@section('title', 'Bimbingan')

@section('content')

<div class="flex h-[80vh] bg-white rounded-xl shadow overflow-hidden">

    {{-- SIDEBAR SISWA --}}
    <div class="w-1/3 border-r overflow-y-auto">
        <div class="p-4 font-bold text-gray-700 border-b">
            Daftar Siswa
        </div>

        @foreach($siswaList as $s)
            <a href="{{ route('pembimbing.bimbingan.index', ['siswa_id' => $s->user_id]) }}"
               class="flex items-center justify-between px-4 py-3 hover:bg-gray-100
               {{ optional($siswaAktif)->user_id == $s->user_id ? 'bg-gray-200' : '' }}">

                <span class="font-medium text-gray-800">
                    {{ $s->nama }}
                </span>

                @if($s->unread_count > 0)
                    <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                @endif
            </a>
        @endforeach
    </div>

    {{-- CHAT AREA --}}
    <div class="flex-1 flex flex-col">

        {{-- HEADER --}}
        <div class="p-4 border-b font-semibold text-gray-700 flex justify-between items-center">
            <span>
                {{ $siswaAktif?->nama ?? 'Pilih siswa untuk mulai bimbingan' }}
            </span>

            @if($siswaAktif)
                <span class="text-xs text-gray-400">
                    💬 Pesan akan terhapus otomatis setelah 7 hari
                </span>
            @endif
        </div>

        {{-- CHAT --}}
        <div id="chatBox" class="flex-1 p-4 overflow-y-auto space-y-4 bg-gray-50">

            @forelse($messages as $msg)

                {{-- PESAN PEMBIMBING (KANAN) --}}
                @if(!is_null($msg->pembimbing_id))
                    <div class="flex justify-end">
                        <div class="max-w-md px-4 py-2 rounded-lg bg-blue-500 text-white">
                            @if($msg->pesan)
                                <p class="text-sm">{{ $msg->pesan }}</p>
                            @endif

                            @if($msg->file)
                                <a href="{{ asset('storage/'.$msg->file) }}"
                                   target="_blank"
                                   class="block mt-2 underline text-sm text-white">
                                    📎 Lihat File
                                </a>
                            @endif

                            <span class="block text-xs mt-1 opacity-70 text-right">
                                {{ $msg->created_at->format('H:i') }}
                            </span>
                        </div>
                    </div>

                {{-- PESAN SISWA (KIRI) --}}
                @else
                    <div class="flex justify-start">
                        <div class="max-w-md px-4 py-2 rounded-lg bg-white border">
                            @if($msg->pesan)
                                <p class="text-sm">{{ $msg->pesan }}</p>
                            @endif

                            @if($msg->file)
                                <a href="{{ asset('storage/'.$msg->file) }}"
                                   target="_blank"
                                   class="block mt-2 underline text-sm">
                                    📎 Lihat File
                                </a>
                            @endif

                            <span class="block text-xs mt-1 opacity-70">
                                {{ $msg->created_at->format('H:i') }}
                            </span>
                        </div>
                    </div>
                @endif

            @empty
                <p class="text-center text-gray-400 mt-10">
                    Belum ada pesan
                </p>
            @endforelse

        </div>

        {{-- FORM BALASAN --}}
        @if($siswaAktif)
            <form action="{{ route('pembimbing.bimbingan.store', $siswaAktif->user_id) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="p-4 border-t flex gap-2 items-center bg-white">
                @csrf

                <input type="text"
                       name="pesan"
                       placeholder="Ketik balasan..."
                       class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring">

                <input type="file" name="file" class="text-sm">

                <button class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                    Kirim
                </button>
            </form>
        @endif

    </div>
</div>

{{-- AUTO SCROLL --}}
<script>
    const chatBox = document.getElementById('chatBox');
    if (chatBox) {
        chatBox.scrollTop = chatBox.scrollHeight;
    }
</script>

@endsection
