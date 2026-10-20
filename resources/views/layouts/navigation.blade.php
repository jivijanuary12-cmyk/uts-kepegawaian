
<nav x-data="{ open: false }" class="border-b border-gray-100 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ route('employees.index') }}"
                   class="text-lg font-bold text-indigo-700">
                    Sistem Kepegawaian
                </a>

                <div class="hidden items-center gap-6 sm:flex">
                    <a href="{{ route('employees.index') }}"
                       class="text-sm font-medium {{ request()->routeIs('employees.*') ? 'text-indigo-700' : 'text-gray-600 hover:text-indigo-700' }}">
                        Data Pegawai
                    </a>

                    <a href="{{ route('departments.index') }}"
                       class="text-sm font-medium {{ request()->routeIs('departments.*') ? 'text-indigo-700' : 'text-gray-600 hover:text-indigo-700' }}">
                        Departemen
                    </a>
                </div>
            </div>

            <div class="hidden items-center sm:flex">
                <span class="mr-4 text-sm text-gray-600">
                    {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="rounded-lg bg-red-50 px-4 py-2 text-sm font-semibold text-red-600 hover:bg-red-100">
                        Logout
                    </button>
                </form>
            </div>

            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                        class="rounded-md p-2 text-gray-600 hover:bg-gray-100">
                    <span x-show="!open">Menu</span>
                    <span x-show="open">Tutup</span>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" x-cloak class="border-t border-gray-100 px-4 py-3 sm:hidden">
        <a href="{{ route('employees.index') }}"
           class="block rounded px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
            Data Pegawai
        </a>

        <a href="{{ route('departments.index') }}"
           class="block rounded px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
            Departemen
        </a>

        <div class="mt-3 border-t border-gray-200 pt-3">
            <p class="px-3 py-2 text-sm text-gray-600">
                {{ Auth::user()->name }}
            </p>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full rounded px-3 py-2 text-left text-sm text-red-600 hover:bg-red-50">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>
