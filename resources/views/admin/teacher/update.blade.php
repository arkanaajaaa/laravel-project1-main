<!-- Modal Update Teacher -->
<div id="updateTeacherModal"
     class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative">

        <!-- Close Button -->
        <button id="closeUpdateTeacherBtn"
            class="absolute top-3 right-4 text-gray-400 hover:text-gray-700 
            dark:hover:text-gray-300 text-2xl font-bold transition">
            &times;
        </button>

        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
            Update Teacher
        </h2>

        <form id="updateTeacherForm" method="POST" action="">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- Nama -->
                <div>
                    <label class="block text-sm mb-1 text-gray-700 dark:text-gray-300">Nama</label>
                    <input id="updateTeacherName" name="name" type="text" required
                        class="w-full px-3 py-2 border rounded-lg bg-gray-50 dark:bg-gray-800 
                        text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Mata Pelajaran -->
                <div>
                    <label class="block text-sm mb-1 text-gray-700 dark:text-gray-300">Mata Pelajaran</label>
                    <select id="updateTeacherSubject" name="subject_id" required
                        class="w-full px-3 py-2 border rounded-lg bg-gray-50 dark:bg-gray-800 
                        text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-400">
                        <option value="">-- Pilih Mapel --</option>
                        @foreach ($subjectsList as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm mb-1 text-gray-700 dark:text-gray-300">Email</label>
                    <input id="updateTeacherEmail" name="email" type="email" required
                        class="w-full px-3 py-2 border rounded-lg bg-gray-50 dark:bg-gray-800 
                        text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Telepon -->
                <div>
                    <label class="block text-sm mb-1 text-gray-700 dark:text-gray-300">Telepon</label>
                    <input id="updateTeacherPhone" name="phone" type="text"
                        class="w-full px-3 py-2 border rounded-lg bg-gray-50 dark:bg-gray-800 
                        text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Alamat -->
                <div class="md:col-span-2">
                    <label class="block text-sm mb-1 text-gray-700 dark:text-gray-300">Alamat</label>
                    <textarea id="updateTeacherAddress" name="address" rows="3"
                        class="w-full px-3 py-2 border rounded-lg bg-gray-50 dark:bg-gray-800 
                        text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-400"></textarea>
                </div>

            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" id="cancelUpdateTeacherBtn"
                    class="px-4 py-2 text-sm bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 
                    dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 transition">
                    Batal
                </button>

                <button type="submit"
                    class="px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg 
                    focus:ring-2 focus:ring-blue-400 transition">
                    Update
                </button>
            </div>

        </form>
    </div>
</div>
