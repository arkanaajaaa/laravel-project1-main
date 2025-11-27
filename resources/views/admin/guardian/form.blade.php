<form method="POST" action="{{ route('admin.guardian.store') }}" class="space-y-4">
    @csrf
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Nama -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
            <input type="text" name="nama" placeholder="Masukkan nama wali" required
                class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-500 
                       dark:bg-gray-800 dark:border-gray-700 dark:text-white">
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <input type="email" name="email" placeholder="contoh@email.com" required
                class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-500 
                       dark:bg-gray-800 dark:border-gray-700 dark:text-white">
        </div>

        <!-- Pekerjaan -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pekerjaan</label>
            <input type="text" name="job" placeholder="Masukkan pekerjaan wali"
                class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-500 
                       dark:bg-gray-800 dark:border-gray-700 dark:text-white">
        </div>

        <!-- Telepon -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Telepon</label>
            <input type="text" name="phone" placeholder="08xxxxxxxxxx"
                class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-500 
                       dark:bg-gray-800 dark:border-gray-700 dark:text-white">
        </div>

        <!-- Jenis Kelamin -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Kelamin</label>
            <select name="gender"
                class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-500 
                       dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                <option value="">Pilih jenis kelamin...</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <!-- Alamat -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
            <textarea name="address" rows="2" placeholder="Masukkan alamat wali"
                class="w-full p-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-500 
                       dark:bg-gray-800 dark:border-gray-700 dark:text-white"></textarea>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="flex justify-end gap-2 pt-4 border-t border-gray-200 dark:border-gray-700">
        <button type="button" id="closeModalBtn2"
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
    // Tombol batal juga menutup modal
    document.getElementById('closeModalBtn2')?.addEventListener('click', () => {
        document.getElementById('addGuardianModal').classList.add('hidden');
    });
</script>