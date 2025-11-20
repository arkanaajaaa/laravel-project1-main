<form class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
            <input type="text" placeholder="Masukkan nama guru"
                class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-500
                dark:bg-gray-800 dark:border-gray-700 dark:text-white">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mata Pelajaran</label>
            <select
                class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-500
                dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                <option>Pilih mata pelajaran...</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <input type="email" placeholder="contoh@email.com"
                class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-500
                dark:bg-gray-800 dark:border-gray-700 dark:text-white">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Telepon</label>
            <input type="text" placeholder="08xxxxxxxxxx"
                class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-500
                dark:bg-gray-800 dark:border-gray-700 dark:text-white">
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
            <textarea rows="2" placeholder="Masukkan alamat guru"
                class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-500
                dark:bg-gray-800 dark:border-gray-700 dark:text-white"></textarea>
        </div>
    </div>

    <div class="flex justify-end gap-2 pt-4 border-t border-gray-200 dark:border-gray-700">
        <button type="button" id="closeModalBtn2"
            class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
            bg-gray-200 text-gray-700 hover:bg-gray-300 hover:text-gray-900
            dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white
            focus:ring-2 focus:ring-gray-400 focus:outline-none">
            Batal
        </button>

        <button type="button"
            class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
            Simpan
        </button>
    </div>
</form>

<script>
    document.getElementById('closeModalBtn2')?.addEventListener('click', () => {
        document.getElementById('addTeacherModal').classList.add('hidden');
    });
</script>
