<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Tambah Role
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl p-6">

                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf

                    {{-- Nama Role --}}
                    <div>
                        <x-input-label for="name" value="Nama Role" />

                        <x-text-input
                            id="name"
                            class="block mt-1 w-full"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus
                        />

                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="flex justify-end mt-6">

                        <a href="{{ route('roles.index') }}"
                           class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg mr-2">

                            Kembali

                        </a>

                        <x-primary-button>
                            Simpan Role
                        </x-primary-button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>