<x-app-layout>
    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">Manajemen SDM</p>
                    <h1 class="mt-1 text-3xl font-bold tracking-tight text-gray-900">Data Departemen</h1>
                    <p class="mt-2 text-gray-500">Kelola struktur departemen dan jumlah pegawai.</p>
                </div>
                <a href="{{ route('departments.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <span aria-hidden="true" class="text-lg leading-none">+</span>
                    Tambah Departemen
                </a>
            </div>

            @if (session('success'))
                <div role="status" class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div role="alert" class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm font-medium text-amber-800">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div role="alert" class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-gray-500">Total Departemen</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $departments->count() }}</p>
                    <p class="mt-1 text-sm text-gray-500">departemen terdaftar</p>
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-gray-500">Total Pegawai</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $departments->sum('employees_count') }}</p>
                    <p class="mt-1 text-sm text-gray-500">pegawai di seluruh departemen</p>
                </div>
            </div>

            <section class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
                <div class="flex flex-col gap-1 border-b border-gray-100 px-5 py-4 sm:px-6">
                    <h2 class="font-semibold text-gray-900">Daftar Departemen</h2>
                    <p class="text-sm text-gray-500">Kelola nama departemen dan data pegawai terkait.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[560px] text-left text-sm">
                        <thead class="bg-gray-50 text-xs uppercase tracking-wider text-gray-500">
                            <tr>
                                <th scope="col" class="px-5 py-4 font-semibold">No.</th>
                                <th scope="col" class="px-5 py-4 font-semibold">Nama Departemen</th>
                                <th scope="col" class="px-5 py-4 font-semibold">Jumlah Pegawai</th>
                                <th scope="col" class="px-5 py-4 text-center font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($departments as $department)
                                <tr class="transition hover:bg-gray-50">
                                    <td class="whitespace-nowrap px-5 py-4 text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="whitespace-nowrap px-5 py-4 font-semibold text-gray-900">{{ $department->name }}</td>
                                    <td class="whitespace-nowrap px-5 py-4">
                                        <span class="inline-flex rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                                            {{ $department->employees_count }} pegawai
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('departments.edit', $department) }}"
                                                class="rounded-lg border border-amber-200 bg-amber-50 px-3 py-2 font-medium text-amber-800 transition hover:bg-amber-100">
                                                Edit
                                            </a>
                                            <form action="{{ route('departments.destroy', $department) }}" method="POST"
                                                onsubmit="return confirm('Hapus departemen ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="rounded-lg border border-red-200 bg-red-50 px-3 py-2 font-medium text-red-700 transition hover:bg-red-100">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-14 text-center">
                                        <p class="font-semibold text-gray-900">Belum ada data departemen</p>
                                        <p class="mt-1 text-sm text-gray-500">Tambahkan departemen pertama untuk mengelompokkan pegawai.</p>
                                        <a href="{{ route('departments.create') }}"
                                            class="mt-4 inline-flex rounded-lg bg-indigo-600 px-4 py-2 font-semibold text-white transition hover:bg-indigo-700">
                                            + Tambah Departemen
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
