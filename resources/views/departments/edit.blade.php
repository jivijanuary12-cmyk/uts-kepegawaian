<x-app-layout>
    <div class="py-8">
        <div class="mx-auto max-w-3xl space-y-6 px-4 sm:px-6 lg:px-8">
            <div>
                <a href="{{ route('departments.index') }}" class="text-sm font-medium text-indigo-600 transition hover:text-indigo-800">
                    &larr; Kembali ke Data Departemen
                </a>
                <p class="mt-5 text-sm font-semibold uppercase tracking-wider text-indigo-600">Manajemen SDM</p>
                <h1 class="mt-1 text-3xl font-bold tracking-tight text-gray-900">Edit Departemen</h1>
                <p class="mt-2 text-gray-500">Perbarui nama departemen {{ $department->name }}.</p>
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

            <form action="{{ route('departments.update', $department) }}" method="POST" class="space-y-6 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
                @csrf
                @method('PUT')
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Departemen</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $department->name) }}" required
                        class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div class="flex flex-col-reverse justify-end gap-3 border-t border-gray-100 pt-5 sm:flex-row">
                    <a href="{{ route('departments.index') }}"
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
