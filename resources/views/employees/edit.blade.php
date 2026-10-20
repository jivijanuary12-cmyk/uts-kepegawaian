<x-app-layout>
    <div class="py-8">
        <div class="mx-auto max-w-3xl space-y-6 px-4 sm:px-6 lg:px-8">
            <div>
                <a href="{{ route('employees.index') }}" class="text-sm font-medium text-indigo-600 transition hover:text-indigo-800">
                    &larr; Kembali ke Data Pegawai
                </a>
                <p class="mt-5 text-sm font-semibold uppercase tracking-wider text-indigo-600">Manajemen SDM</p>
                <h1 class="mt-1 text-3xl font-bold tracking-tight text-gray-900">Edit Pegawai</h1>
                <p class="mt-2 text-gray-500">Perbarui informasi {{ $employee->name }}.</p>
            </div>

            @if ($errors->any())
                <div role="alert" class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('employees.update', $employee) }}" method="POST" class="space-y-6 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Pegawai</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $employee->name) }}" required
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div class="space-y-2">
                        <label for="position" class="block text-sm font-medium text-gray-700">Jabatan</label>
                        <input id="position" type="text" name="position" value="{{ old('position', $employee->position) }}" required
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div class="space-y-2">
                        <label for="salary" class="block text-sm font-medium text-gray-700">Gaji (Rp)</label>
                        <input id="salary" type="number" name="salary" value="{{ old('salary', $employee->salary) }}" min="1" step="0.01" required
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div class="space-y-2">
                        <label for="joined_at" class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                        <input id="joined_at" type="date" name="joined_at" value="{{ old('joined_at', $employee->joined_at) }}" required
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div class="space-y-2 sm:col-span-2">
                        <label for="department_id" class="block text-sm font-medium text-gray-700">Departemen</label>
                        <select id="department_id" name="department_id" required
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" @selected(old('department_id', $employee->department_id) == $department->id)>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex flex-col-reverse justify-end gap-3 border-t border-gray-100 pt-5 sm:flex-row">
                    <a href="{{ route('employees.index') }}"
                        class="inline-flex justify-center rounded-xl border border-gray-300 px-5 py-3 font-semibold text-gray-700 transition hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex justify-center rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
