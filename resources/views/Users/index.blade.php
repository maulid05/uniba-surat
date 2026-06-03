<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Manajemen User
            </h2>

            <a href="{{ route('users.create') }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                Tambah User
            </a>
        </div>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden">

                <div class="p-4 border-b border-gray-200 dark:border-gray-700">

                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        Daftar Pengguna
                    </h3>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-gray-100 dark:bg-gray-700">

                            <tr>

                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    No
                                </th>

                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Nama
                                </th>

                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Email
                                </th>

                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Role
                                </th>

                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Sekretaris
                                </th>

                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                        @forelse($users as $user)

                            <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">

                                <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                                    {{ $user->name }}
                                </td>

                                <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                                    {{ $user->email }}
                                </td>

                                <td class="px-4 py-3">

                                    @forelse($user->roles as $role)

                                        <span class="px-2 py-1 bg-indigo-100 text-indigo-700 rounded text-xs">
                                            {{ $role->name }}
                                        </span>

                                    @empty

                                        <span class="text-red-500">
                                            Belum Ada Role
                                        </span>

                                    @endforelse

                                </td>

                                <td class="px-4 py-3 text-gray-800 dark:text-gray-200">

                                    {{ $user->secretary->name ?? '-' }}

                                </td>

                                <td class="px-4 py-3 text-center">

                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('users.edit',$user->id) }}"
                                           class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded">

                                            Edit

                                        </a>

                                        <form
                                            action="{{ route('users.destroy',$user->id) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                onclick="return confirm('Hapus user ini?')"
                                                class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded">

                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">

                                    Belum ada data user

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