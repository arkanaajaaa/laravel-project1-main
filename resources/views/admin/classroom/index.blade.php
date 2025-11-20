<x-admin.layout>
    <x-slot name="title">Classroom Management</x-slot>

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
            Classroom List
        </h1>

        <button id="openModalBtn"
            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 dark:bg-blue-500 dark:hover:bg-blue-600 rounded-lg shadow transition">
            + Add Classroom
        </button>
    </div>

    <!-- Table -->
    <div class="w-full overflow-x-auto">
        <div
            class="inline-block min-w-full overflow-visible rounded-xl shadow border border-gray-300 dark:border-gray-700 pb-16">
            <table id="classroomTable"
                class="min-w-full divide-y divide-gray-300 dark:divide-gray-700 text-sm">
                <thead
                    class="bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700">
                    <tr>
                        <th
                            class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">
                            No
                        </th>
                        <th
                            class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">
                            Nama
                        </th>
                        <th
                            class="px-4 py-3 text-right text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody
                    class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($classrooms as $classroom)
                        <tr class="hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-all">
                            <td class="px-4 py-4 font-medium text-gray-900 dark:text-gray-100">
                                {{ $loop->iteration + ($classrooms->currentPage() - 1) * $classrooms->perPage() }}
                            </td>
                            <td class="px-4 py-4 text-gray-800 dark:text-gray-300">
                                {{ $classroom->name }}
                            </td>
                            <td class="px-4 py-4 text-right relative">
                                <!-- Tombol titik tiga -->
                                <button
                                    class="menuBtn text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition"
                                    data-id="{{ $classroom->id }}"
                                    data-name="{{ $classroom->name }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v.01M12 12v.01M12 18v.01" />
                                    </svg>
                                </button>

                                <!-- Dropdown -->
                                <div
                                    class="menuDropdown hidden absolute right-0 mt-2 w-32 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-[9999]">
                                    <button
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-emerald-100 dark:hover:bg-emerald-700/40 updateBtn"
                                        data-id="{{ $classroom->id }}"
                                        data-name="{{ $classroom->name }}">
                                        Update
                                    </button>
                                    <button
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-800/40 deleteBtn"
                                        data-id="{{ $classroom->id }}">
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
            {{ $classrooms->links('pagination::tailwind') }}
        </div>

        <div class="mt-2 text-xs text-gray-500 dark:text-gray-400 text-center lg:hidden">
            ← Geser ke kanan untuk melihat kolom lainnya →
        </div>
    </div>

    <!-- Modal Add Classroom -->
    <div id="addClassroomModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
        <div
            class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-md p-6 relative transform transition-all duration-300 scale-100 opacity-100 animate-fade-in">
            <button id="closeModalBtn"
                class="absolute top-3 right-4 text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-2xl font-bold transition">
                &times;
            </button>

            <h2
                class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                Tambah Classroom
            </h2>

            @include('admin.classroom.form')
        </div>
    </div>

    <!-- Include Modal Update -->
    @include('admin.classroom.update')

    <!-- Include Modal Delete -->
    @include('admin.classroom.delete')

    <!-- Script -->
    <script>
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const modalAdd = document.getElementById('addClassroomModal');

        const updateModal = document.getElementById('updateClassroomModal');
        const closeUpdateModalBtn = document.getElementById('closeUpdateModalBtn');
        const cancelUpdateBtn = document.getElementById('cancelUpdateBtn');
        const updateForm = document.getElementById('updateClassroomForm');

        const deleteModal = document.getElementById('deleteModal');
        const closeDeleteModalBtn = document.getElementById('closeDeleteModalBtn');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const deleteForm = document.getElementById('deleteClassroomForm');

        const menuButtons = document.querySelectorAll('.menuBtn');
        const dropdowns = document.querySelectorAll('.menuDropdown');

        // Toggle dropdown titik tiga
        menuButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const dropdown = btn.nextElementSibling;
                dropdowns.forEach(d => d.classList.add('hidden'));
                dropdown.classList.toggle('hidden');
            });
        });

        // Tutup dropdown saat klik di luar
        window.addEventListener('click', () => dropdowns.forEach(d => d.classList.add('hidden')));

        // Buka modal tambah
        openModalBtn.addEventListener('click', () => modalAdd.classList.remove('hidden'));

        // Tutup modal tambah
        closeModalBtn.addEventListener('click', () => modalAdd.classList.add('hidden'));
        window.addEventListener('click', (e) => {
            if (e.target === modalAdd) modalAdd.classList.add('hidden');
        });

        // Buka modal update
        document.querySelectorAll('.updateBtn').forEach(btn => {
            btn.addEventListener('click', e => {
                e.stopPropagation();
                const id = btn.dataset.id;
                const name = btn.dataset.name || '';

                updateModal.classList.remove('hidden');
                updateForm.action = `/admin/classroom/${id}`;
                document.getElementById('updateName').value = name;
            });
        });

        // Tutup modal update
        [closeUpdateModalBtn, cancelUpdateBtn].forEach(el => {
            el.addEventListener('click', () => updateModal.classList.add('hidden'));
        });

        // Tutup saat klik di luar modal update
        window.addEventListener('click', e => {
            if (e.target === updateModal) updateModal.classList.add('hidden');
        });

        // Buka modal delete
        document.querySelectorAll('.deleteBtn').forEach(btn => {
            btn.addEventListener('click', e => {
                e.stopPropagation();
                const id = btn.dataset.id;

                deleteModal.classList.remove('hidden');
                deleteForm.action = `/admin/classroom/${id}`;
            });
        });

        // Tutup modal delete
        [closeDeleteModalBtn, cancelDeleteBtn].forEach(el => {
            el.addEventListener('click', () => deleteModal.classList.add('hidden'));
        });

        // Tutup saat klik di luar modal delete
        window.addEventListener('click', e => {
            if (e.target === deleteModal) deleteModal.classList.add('hidden');
        });
    </script>
</x-admin.layout>
