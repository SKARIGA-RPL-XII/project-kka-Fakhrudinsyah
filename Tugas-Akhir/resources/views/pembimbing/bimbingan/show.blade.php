<form action="{{ route('pembimbing.bimbingan.store', $siswa->user_id) }}"
      method="POST"
      enctype="multipart/form-data"
      class="border-t pt-4 flex gap-3">
    @csrf

    <input type="text"
           name="pesan"
           placeholder="Tulis balasan..."
           class="flex-1 border rounded-lg px-4 py-2 focus:ring focus:ring-indigo-300">

    <input type="file" name="file" class="text-sm">

    <button class="bg-indigo-600 text-white px-6 rounded-lg hover:bg-indigo-700">
        Kirim
    </button>
</form>
