<!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<table class="w-full bg-white rounded-lg shadow-lg overflow-hidden">
    <thead class="bg-gradient-to-r from-gray-800 to-gray-700 text-white">
        <tr>
            <th class="p-4 text-left font-semibold uppercase tracking-wide">Nama</th>
            <th class="p-4 text-left font-semibold uppercase tracking-wide">NIS</th>
            <th class="p-4 text-left font-semibold uppercase tracking-wide">Pembimbing</th>
            <th class="p-4 text-left font-semibold uppercase tracking-wide">Tempat PKL</th>
            <th class="p-4 text-center font-semibold uppercase tracking-wide">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($siswa as $item)
            <tr class="border-b border-gray-200 hover:bg-indigo-50 transition duration-300 even:bg-gray-50">
                <td class="p-4 text-gray-800">{{ $item->nama }}</td>
                <td class="p-4 text-gray-800">{{ $item->nis }}</td>
                <td class="p-4 text-gray-800">
                    {{ $item->pembimbingUser->nama ?? '-' }}
                </td>
                <td class="p-4 text-gray-800">
                    {{ $item->tempatPkl->nama_tempat ?? '-' }}
                </td>
                <td class="p-4 text-center space-x-2">
                    <a href="{{ route('admin.data_siswa.edit', $item->user_id) }}"
                       class="inline-block px-4 py-2 bg-yellow-500 text-white rounded-lg text-sm font-medium hover:bg-yellow-600 hover:shadow-lg transform hover:scale-105 transition duration-200">
                        Edit
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="p-8 text-center text-gray-500 bg-gray-100 italic">
                    Data siswa tidak ditemukan
                </td>
            </tr>
        @endforelse
    </tbody>
</table>