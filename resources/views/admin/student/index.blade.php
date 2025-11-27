<x-admin.layout>
    <x-slot name="title">Student Management</x-slot>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
            Student List
        </h1>

        <button id="openModalBtn"
            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 dark:bg-blue-500 dark:hover:bg-blue-600 rounded-lg shadow transition">
            + Add Student
        </button>
    </div>

    <div class="w-full overflow-x-auto">
        <div class="inline-block min-w-full overflow-visible rounded-xl shadow border border-gray-300 dark:border-gray-700 pb-16">
            <table id="studentTable" class="min-w-full divide-y divide-gray-300 dark:divide-gray-700 text-sm">
                <thead class="bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Kelas</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Alamat</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Telepon</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Jenis Kelamin</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Tanggal Lahir</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase">Action</th>
                    </tr>
                </thead>

                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($studentsList as $student)
                        <tr class="hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-all">
                            <td class="px-4 py-4 font-medium text-gray-900 dark:text-gray-100">
                                {{ $loop->iteration + ($studentsList->currentPage() - 1) * $studentsList->perPage() }}
                            </td>
                            <td class="px-4 py-4 text-gray-800 dark:text-gray-300">{{ $student->nama }}</td>
                            <td class="px-4 py-4 text-gray-800 dark:text-gray-300">{{ $student->email }}</td>
                            <td class="px-4 py-4 text-gray-800 dark:text-gray-300">{{ $student->classroom->name }}</td>
                            <td class="px-4 py-4 text-gray-800 dark:text-gray-300 max-w-[200px] truncate" title="{{ $student->address }}">
                                {{ $student->address }}
                            </td>
                            <td class="px-4 py-4 text-gray-800 dark:text-gray-300">{{ $student->phone }}</td>
                            <td class="px-4 py-4 text-gray-800 dark:text-gray-300">{{ $student->gender }}</td>
                            <td class="px-4 py-4 text-gray-800 dark:text-gray-300">{{ $student->date_of_birth }}</td>
                            <td class="px-4 py-4 text-right space-x-2">
                                <button class="updateBtn inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-500 dark:hover:bg-emerald-600 rounded-md transition"
                                    data-id="{{ $student->id }}"
                                    data-nama="{{ $student->nama }}"
                                    data-email="{{ $student->email }}"
                                    data-classroom="{{ $student->classroom_id }}"
                                    data-address="{{ $student->address }}"
                                    data-phone="{{ $student->phone }}"
                                    data-gender="{{ $student->gender }}"
                                    data-date="{{ $student->date_of_birth }}">
                                    Edit
                                </button>

                                <button class="deleteBtn inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-red-600 hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 rounded-md transition"
                                    data-id="{{ $student->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $studentsList->links('pagination::tailwind') }}
        </div>

        <div class="mt-2 text-xs text-gray-500 dark:text-gray-400 text-center lg:hidden">
            ← Geser ke kanan untuk melihat kolom lainnya →
        </div>
    </div>

    <div id="addStudentModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative transform transition-all duration-300 scale-100 opacity-100 animate-fade-in">
            <button id="closeModalBtn" class="absolute top-3 right-4 text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-2xl font-bold transition">
                &times;
            </button>

            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                Tambah Student
            </h2>

            @include('admin.student.form')
        </div>
    </div>

    @include('admin.student.update')
    @include('admin.student.delete')

    <script>
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const modalAdd = document.getElementById('addStudentModal');

        const updateModal = document.getElementById('updateStudentModal');
        const closeUpdateModalBtn = document.getElementById('closeUpdateStudentBtn');
        const cancelUpdateBtn = document.getElementById('cancelUpdateStudentBtn');
        const updateForm = document.getElementById('updateStudentForm');

        const deleteModal = document.getElementById('deleteModal');
        const closeDeleteModalBtn = document.getElementById('closeDeleteStudentBtn');
        const cancelDeleteBtn = document.getElementById('cancelDeleteStudentBtn');
        const deleteForm = document.getElementById('deleteStudentForm');

        openModalBtn.addEventListener('click', () => modalAdd.classList.remove('hidden'));
        closeModalBtn.addEventListener('click', () => modalAdd.classList.add('hidden'));
        window.addEventListener('click', (e) => {
            if (e.target === modalAdd) modalAdd.classList.add('hidden');
        });

        document.querySelectorAll('.updateBtn').forEach(btn => {
            btn.addEventListener('click', e => {
                e.stopPropagation();
                const id = btn.dataset.id;

                updateModal.classList.remove('hidden');
                updateForm.action = `/admin/student/${id}`;

                document.getElementById('updateStudentNama').value = btn.dataset.nama || '';
                document.getElementById('updateStudentEmail').value = btn.dataset.email || '';
                document.getElementById('updateStudentClassroom').value = btn.dataset.classroom || '';
                document.getElementById('updateStudentAddress').value = btn.dataset.address || '';
                document.getElementById('updateStudentPhone').value = btn.dataset.phone || '';
                document.getElementById('updateStudentGender').value = btn.dataset.gender || '';
                document.getElementById('updateStudentDOB').value = btn.dataset.date || '';
            });
        });

        [closeUpdateModalBtn, cancelUpdateBtn].forEach(el => {
            el.addEventListener('click', () => updateModal.classList.add('hidden'));
        });

        window.addEventListener('click', e => {
            if (e.target === updateModal) updateModal.classList.add('hidden');
        });

        document.querySelectorAll('.deleteBtn').forEach(btn => {
            btn.addEventListener('click', e => {
                e.stopPropagation();
                const id = btn.dataset.id;

                deleteModal.classList.remove('hidden');
                deleteForm.action = `/admin/student/${id}`;
            });
        });

        [closeDeleteModalBtn, cancelDeleteBtn].forEach(el => {
            el.addEventListener('click', () => deleteModal.classList.add('hidden'));
        });

        window.addEventListener('click', e => {
            if (e.target === deleteModal) deleteModal.classList.add('hidden');
        });
    </script>

</x-admin.layout>