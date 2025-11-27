<x-admin.layout>
    <x-slot name="title">Subject Management</x-slot>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
            Subject List
        </h1>

        <button id="openModalBtn"
            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 dark:bg-blue-500 dark:hover:bg-blue-600 rounded-lg shadow transition">
            + Add Subject
        </button>
    </div>

    <div class="w-full overflow-x-auto">
        <div class="inline-block min-w-full overflow-visible rounded-xl shadow border border-gray-300 dark:border-gray-700 pb-16">
            <table id="subjectTable" class="min-w-full divide-y divide-gray-300 dark:divide-gray-700 text-sm">
                <thead class="bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Deskripsi</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Action</th>
                    </tr>
                </thead>

                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($subjectsList as $subject)
                        <tr class="hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-all">
                            <td class="px-4 py-4 font-medium text-gray-900 dark:text-gray-100">{{ $loop->iteration }}</td>
                            <td class="px-4 py-4 text-gray-800 dark:text-gray-300">{{ $subject->name }}</td>
                            <td class="px-4 py-4 text-gray-700 dark:text-gray-400">{{ $subject->description }}</td>
                            <td class="px-4 py-4 text-right space-x-2">
                                <button class="updateBtn inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-500 dark:hover:bg-emerald-600 rounded-md transition"
                                    data-id="{{ $subject->id }}"
                                    data-name="{{ $subject->name }}"
                                    data-description="{{ $subject->description }}">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-2 text-xs text-gray-500 dark:text-gray-400 text-center lg:hidden">
            ← Geser ke kanan untuk melihat kolom lainnya →
        </div>
    </div>

    <div id="addSubjectModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative transform transition-all duration-300 scale-100 opacity-100 animate-fade-in">
            <button id="closeAddModalBtn" class="absolute top-3 right-4 text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-2xl font-bold transition">
                &times;
            </button>

            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                Tambah Subject
            </h2>

            @include('admin.subject.form')
        </div>
    </div>

    @include('admin.subject.update')

    <script>
        const openModalBtn = document.getElementById('openModalBtn');
        const addModal = document.getElementById('addSubjectModal');
        const closeAddModalBtn = document.getElementById('closeAddModalBtn');

        const updateModal = document.getElementById('updateSubjectModal');
        const closeUpdateModalBtn = document.getElementById('closeUpdateSubjectBtn');
        const cancelUpdateBtn = document.getElementById('cancelUpdateSubjectBtn');
        const updateForm = document.getElementById('updateSubjectForm');

        openModalBtn.addEventListener('click', () => addModal.classList.remove('hidden'));
        closeAddModalBtn.addEventListener('click', () => addModal.classList.add('hidden'));

        window.addEventListener('click', (e) => {
            if (e.target === addModal) addModal.classList.add('hidden');
        });

        document.querySelectorAll('.updateBtn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const id = btn.dataset.id;
                const name = btn.dataset.name;
                const description = btn.dataset.description;

                updateModal.classList.remove('hidden');
                updateForm.action = `/admin/subject/${id}`;

                document.getElementById('updateSubjectName').value = name;
                document.getElementById('updateSubjectDescription').value = description;
            });
        });

        [closeUpdateModalBtn, cancelUpdateBtn].forEach(el =>
            el.addEventListener('click', () => updateModal.classList.add('hidden'))
        );

        window.addEventListener('click', (e) => {
            if (e.target === updateModal) updateModal.classList.add('hidden');
        });
    </script>

</x-admin.layout>