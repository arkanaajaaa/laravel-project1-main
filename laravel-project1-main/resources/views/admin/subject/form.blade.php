<form id="subjectForm" class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Mata Pelajaran</label>
        <input type="text" name="name" placeholder="Contoh: Matematika"
            class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
        <textarea name="description" rows="3" placeholder="Contoh: Pelajaran dasar berhitung dan logika..."
            class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white"></textarea>
    </div>

    <div class="flex justify-end gap-3 pt-2">
        <button type="button" id="closeModalBtn2"
            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg transition">
            Batal
        </button>
        <button type="submit"
            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 text-white rounded-lg transition">
            Simpan
        </button>
    </div>
</form>

<script>
    // Tombol batal di dalam form juga bisa menutup modal
    document.getElementById('closeModalBtn2').addEventListener('click', () => {
        document.getElementById('addSubjectModal').classList.add('hidden');
    });
</script>
