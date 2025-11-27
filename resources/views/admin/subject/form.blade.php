<form method="POST" action="{{ route('admin.subject.store') }}" class="space-y-4">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <!-- Nama Mata Pelajaran -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Nama Mata Pelajaran
            </label>
            <input type="text" name="name" placeholder="Contoh: Matematika" required
                class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-500 
                dark:bg-gray-800 dark:border-gray-700 dark:text-white">
        </div>

        <!-- Deskripsi -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Deskripsi
            </label>
            <textarea name="description" rows="3" placeholder="Contoh: Pelajaran dasar berhitung dan logika..."
                class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-500 
                dark:bg-gray-800 dark:border-gray-700 dark:text-white"></textarea>
        </div>

    </div>

    <!-- Tombol Aksi -->
    <div class="flex justify-end gap-2 pt-4 border-t border-gray-200 dark:border-gray-700">
        <button type="button" id="closeModalBtnSubject"
            class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
            bg-gray-200 text-gray-700 hover:bg-gray-300 hover:text-gray-900
            dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white
            focus:ring-2 focus:ring-gray-400 focus:outline-none">
            Batal
        </button>

        <button type="submit"
            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 
                   focus:ring-2 focus:ring-blue-400 rounded-lg shadow transition-all duration-200">
            Simpan
        </button>
    </div>
</form>

<script>
    // Tombol batal → tutup modal
    document.getElementById('closeModalBtnSubject')?.addEventListener('click', () => {
        document.getElementById('addSubjectModal').classList.add('hidden');
    });
</script>
