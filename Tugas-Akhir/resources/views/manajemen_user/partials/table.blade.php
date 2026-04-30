@forelse ($users as $user)
<tr class="hover:bg-gray-50 transition-colors duration-150">

    <td class="px-6 py-4 text-center text-gray-600 font-medium">
        {{ $loop->iteration }}
        </td>

    {{-- Username --}}
    <td class="px-6 py-4">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-user text-gray-400 text-xs"></i>
            </div>
            <span class="font-medium text-gray-800">{{ $user->username ?? '-' }}</span>
        </div>
    </td>

    {{-- NIS --}}
    <td class="px-6 py-4 text-center text-gray-600">
        {{ $user->role === 'siswa' ? $user->nis : '-' }}
    </td>

    {{-- Role --}}
    <td class="px-6 py-4 text-center">
        <span class="
            px-3 py-1 rounded-full text-xs font-medium border
            @if($user->role === 'admin')
                bg-purple-50 text-purple-700 border-purple-200
            @elseif($user->role === 'pembimbing')
                bg-emerald-50 text-emerald-700 border-emerald-200
            @else
                bg-blue-50 text-blue-700 border-blue-200
            @endif">
            {{ ucfirst($user->role) }}
        </span>
    </td>

    {{-- Aksi --}}
    <td class="px-6 py-4">
        <div class="flex gap-2 justify-center">
            @if($user->role !== 'admin')
                <a href="{{ route('admin.manajemen_user.edit', $user->user_id) }}"
                   class="btn-edit">
                    <i class="fas fa-pen text-xs"></i> Edit
                </a>

                <form action="{{ route('admin.manajemen_user.destroy', $user->user_id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-hapus">
                        <i class="fas fa-trash text-xs"></i> Hapus
                    </button>
                </form>
            @else
                <span class="text-xs text-gray-400 italic">—</span>
            @endif
        </div>
    </td>

</tr>
@empty
<tr>
    <td colspan="4" class="py-16 text-center">
        <div class="flex flex-col items-center gap-2">
            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-2">
                <i class="fas fa-users text-2xl text-gray-300"></i>
            </div>
            <p class="text-gray-500 font-medium">Tidak ada data user</p>
            <p class="text-gray-400 text-sm">Coba ubah kata kunci pencarian</p>
        </div>
    </td>
</tr>
@endforelse