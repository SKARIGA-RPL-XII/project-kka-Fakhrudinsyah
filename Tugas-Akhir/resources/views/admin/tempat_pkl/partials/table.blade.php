<table class="w-full">
    <thead class="bg-gradient-to-r from-gray-800 to-gray-700 text-white">
        <tr>
            <th class="px-6 py-4 text-left">Nama Tempat</th>
            <th class="px-6 py-4 text-left">Alamat</th>
            <th class="px-6 py-4 text-center">Jumlah Siswa</th>
            <th class="px-6 py-4 text-center">Aksi</th>
        </tr>
    </thead>

    <tbody class="divide-y">
        @forelse ($tempat as $item)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">{{ $item->nama_tempat }}</td>
                <td class="px-6 py-4">{{ $item->alamat }}</td>
                <td class="px-6 py-4 text-center">
                    {{ $item->siswa->count() }} siswa
                </td>
                <td class="px-6 py-4 text-center flex gap-2 justify-center">
                    <a href="{{ route('tempat_pkl.edit', $item->tempat_pkl_id) }}"
                       class="bg-yellow-400 text-white px-4 py-2 rounded">
                        Edit
                    </a>

                    <form action="{{ route('tempat_pkl.destroy', $item->tempat_pkl_id) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-4 py-2 rounded">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                    Data tidak ditemukan
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
