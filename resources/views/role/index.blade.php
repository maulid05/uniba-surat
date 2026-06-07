<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Manajemen Role
            </h2>

            <a href="{{ route('roles.create') }}"
                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                Tambah Role
            </a>
        </div>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden">

                <div class="p-4 border-b border-gray-200 dark:border-gray-700">

                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        Daftar Role
                    </h3>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-gray-100 dark:bg-gray-700">

                            <tr>

                                <th class="px-4 py-3 text-left">No</th>

                                <th class="px-4 py-3 text-left">
                                    Nama Role
                                </th>

                                <th class="px-4 py-3 text-center">
                                    Jumlah User
                                </th>

                                <th class="px-4 py-3 text-center">
                                    Dibuat
                                </th>

                                <th class="px-4 py-3 text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($roles as $role)

                                <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">

                                    <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-4 py-3">
                                        <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm">
                                            {{ $role->name }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-center text-gray-800 dark:text-gray-200">
                                        {{ $role->users_count }}
                                    </td>

                                    <td class="px-4 py-3 text-center text-gray-800 dark:text-gray-200">
                                        {{ $role->created_at->format('d M Y') }}
                                    </td>

                                    <td class="px-4 py-3 text-center space-x-2">

                                        <a href="{{ route('roles.show', $role->id) }}"
                                            class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded">
                                            Detail
                                        </a>

                                        <a href="{{ route('roles.edit', $role->id) }}"
                                            class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded">
                                            Edit
                                        </a>

                                        <form action="{{ route('roles.destroy', $role->id) }}"
                                            method="POST"
                                            class="inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                onclick="return confirm('Yakin hapus role ini?')"
                                                class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded">

                                                Hapus

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5"
                                        class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">

                                        Belum ada role

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>