@forelse ($users as $user)
<tr class="hover:bg-gray-50">
    <td class="px-6 py-4 flex items-center">
        <i class="fas fa-user-circle text-gray-400 mr-2"></i>
        {{ $user->nama }}
    </td>
    <td class="px-6 py-4 text-center">{{ $user->nis ?? '-' }}</td>
    <td class="px-6 py-4 text-center">
        <span class="px-3 py-1 rounded-full text-xs font-semibold
            @if($user->role === 'admin') bg-purple-100 text-purple-800
            @elseif($user->role === 'pembimbing') bg-green-100 text-green-800
            @else bg-blue-100 text-blue-800 @endif">
            {{ ucfirst($user->role) }}
        </span>
    </td>
    <td class="px-6 py-4 text-center">{{ $user->tempatPkl->nama_tempat ?? '-' }}</td>
    <td class="px-6 py-4 text-center">{{ $user->pembimbing->nama ?? '-' }}</td>
    <td class="px-6 py-4 flex gap-2 justify-center">
        @if($user->role !== 'admin')
            <a href="{{ route('manajemen_user.edit', $user->user_id) }}"
               class="bg-yellow-400 text-white px-4 py-2 rounded-lg hover:bg-yellow-500 shadow flex items-center">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <form action="{{ route('manajemen_user.destroy', $user->user_id) }}"
                  method="POST" onsubmit="return confirm('Yakin hapus user ini?')">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 shadow flex items-center">
                    <i class="fas fa-trash mr-1"></i> Hapus
                </button>
            </form>
        @else
            <span class="text-gray-400 font-semibold">-</span>
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="text-center py-10 text-gray-500">
        <i class="fas fa-search text-4xl mb-2 text-gray-300"></i>
        Data user tidak ditemukan
    </td>
</tr>
@endforelse
