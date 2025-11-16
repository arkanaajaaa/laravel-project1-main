<x-admin.layout>
    <x-slot name="title">Guardian Management</x-slot>

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
            Guardian List
        </h1>

        <button id="openModalBtn"
            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 dark:bg-blue-500 dark:hover:bg-blue-600 rounded-lg shadow transition">
            + Add Guardian
        </button>
    </div>

    <!-- Table -->
    <div class="w-full overflow-x-auto">
        <div class="inline-block min-w-full overflow-hidden rounded-xl shadow border border-gray-300 dark:border-gray-700">
            <table id="guardianTable"
                class="min-w-full divide-y divide-gray-300 dark:divide-gray-700 text-sm">
                <thead class="bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Pekerjaan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Alamat</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Telepon</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Jenis Kelamin</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Action</th>
                    </tr>
                </thead>

                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($guardians as $guardian)
                        <tr class="hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-all">
                            <td class="px-4 py-4 font-medium text-gray-900 dark:text-gray-100">
                                {{ $loop->iteration + ($guardians->currentPage() - 1) * $guardians->perPage() }}
                            </td>
                            <td class="px-4 py-4 text-gray-800 dark:text-gray-300">{{ $guardian->nama }}</td>
                            <td class="px-4 py-4 text-gray-700 dark:text-gray-400">{{ $guardian->job }}</td>
                            <td class="px-4 py-4 text-gray-700 dark:text-gray-400">{{ $guardian->email }}</td>
                            <td class="px-4 py-4 max-w-[250px] truncate text-gray-700 dark:text-gray-400" title="{{ $guardian->address }}">
                                {{ $guardian->address }}
                            </td>
                            <td class="px-4 py-4 text-gray-700 dark:text-gray-400">{{ $guardian->phone }}</td>
                            <td class="px-4 py-4 text-gray-700 dark:text-gray-400">{{ $guardian->gender }}</td>
                            <td class="px-4 py-4 text-right relative">
                                <!-- Tombol titik tiga -->
                                <button class="menuBtn text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition"
                                    data-id="{{ $guardian->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v.01M12 12v.01M12 18v.01" />
                                    </svg>
                                </button>

                                <!-- Dropdown -->
                                <div
                                    class="menuDropdown hidden absolute right-0 mt-2 w-32 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-20">
                                    <button
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-emerald-100 dark:hover:bg-emerald-700/40 updateBtn"
                                        data-id="{{ $guardian->id }}">
                                        Update
                                    </button>
                                    <button
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-800/40 deleteBtn"
                                        data-id="{{ $guardian->id }}">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $guardians->links('pagination::tailwind') }}
        </div>

        <div class="mt-2 text-xs text-gray-500 dark:text-gray-400 text-center lg:hidden">
            ← Geser ke kanan untuk melihat kolom lainnya →
        </div>
    </div>

    <!-- Modal Add Guardian -->
    <div id="addGuardianModal"
         class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative transform transition-all duration-300 scale-100 opacity-100 animate-fade-in">
            <button id="closeModalBtn"
                class="absolute top-3 right-4 text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-2xl font-bold transition">
                &times;
            </button>

            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                Tambah Guardian
            </h2>

            @include('admin.guardian.form')
        </div>
    </div>

    <!-- Script -->
    <script>
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const modal = document.getElementById('addGuardianModal');
        const menuButtons = document.querySelectorAll('.menuBtn');
        const dropdowns = document.querySelectorAll('.menuDropdown');

        // Toggle dropdown titik tiga
        menuButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const dropdown = btn.nextElementSibling;

                // Tutup dropdown lain
                dropdowns.forEach(d => d.classList.add('hidden'));

                // Toggle dropdown yang diklik
                dropdown.classList.toggle('hidden');
            });
        });

        // Tutup dropdown saat klik di luar
        window.addEventListener('click', () => dropdowns.forEach(d => d.classList.add('hidden')));

        // Buka modal tambah
        openModalBtn.addEventListener('click', () => modal.classList.remove('hidden'));

        // Tutup modal
        closeModalBtn.addEventListener('click', () => modal.classList.add('hidden'));
        window.addEventListener('click', (e) => {
            if (e.target === modal) modal.classList.add('hidden');
        });

        // Contoh handler Update & Delete (nanti bisa diganti AJAX / redirect)
        document.querySelectorAll('.updateBtn').forEach(btn => {
            btn.addEventListener('click', () => alert('Update guardian ID: ' + btn.dataset.id));
        });

        document.querySelectorAll('.deleteBtn').forEach(btn => {
            btn.addEventListener('click', () => confirm('Yakin hapus guardian ID: ' + btn.dataset.id + '?'));
        });
    </script>
</x-admin.layout>
