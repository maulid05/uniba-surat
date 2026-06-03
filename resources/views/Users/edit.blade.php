<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Edit User
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl">

                <form
                    method="POST"
                    action="{{ route('users.update', $user->id) }}"
                    class="p-6">

                    @csrf
                    @method('PUT')

                    @if ($errors->any())

                        <div class="mb-5 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded">

                            <ul class="list-disc ml-5">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        {{-- Nama --}}
                        <div>

                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                                Nama
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white"
                                required>

                        </div>

                        {{-- Email --}}
                        <div>

                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white"
                                required>

                        </div>

                        {{-- Password --}}
                        <div>

                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                                Password Baru
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white">

                            <small class="text-gray-500">
                                Kosongkan jika tidak ingin mengganti password
                            </small>

                        </div>

                        {{-- Role --}}
                        <div>

                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                                Role
                            </label>

                            <select
                                name="role"
                                class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white">

                                @foreach($roles as $role)

                                    <option
                                        value="{{ $role->name }}"
                                        {{ $user->hasRole($role->name) ? 'selected' : '' }}>

                                        {{ $role->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- Sekretaris --}}
                        <div class="md:col-span-2">

                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                                Sekretaris
                            </label>

                            <select
                                name="secretary_id"
                                class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white">

                                <option value="">
                                    Tidak Ada
                                </option>

                                @foreach($users as $item)

                                    <option
                                        value="{{ $item->id }}"
                                        {{ $user->secretary_id == $item->id ? 'selected' : '' }}>

                                        {{ $item->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="mt-6 flex gap-3">

                        <button
                            type="submit"
                            class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">

                            Update

                        </button>

                        <a
                            href="{{ route('users.index') }}"
                            class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg">

                            Kembali

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>