<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Riwayat Surat
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto">

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">

                <table class="w-full">

                    <thead class="bg-gray-100 dark:bg-gray-700">

                        <tr>
                            <th class="p-3 text-left">No Surat</th>
                            <th class="p-3 text-left">User</th>
                            <th class="p-3 text-left">Aksi</th>
                            <th class="p-3 text-left">Catatan</th>
                            <th class="p-3 text-left">Tanggal</th>
                        </tr>

                    </thead>

                    <tbody>

                    @forelse($histories as $history)

                        <tr class="border-t dark:border-gray-700">

                            <td class="p-3 text-gray-900 dark:text-white">
                                {{ $history->surat->nomor_surat ?? '-' }}
                            </td>

                            <td class="p-3 text-gray-900 dark:text-white">
                                {{ $history->user->name ?? '-' }}
                            </td>

                            <td class="p-3 text-gray-900 dark:text-white">
                                {{ $history->aksi }}
                            </td>

                            <td class="p-3 text-gray-900 dark:text-white">
                                {{ $history->catatan }}
                            </td>

                            <td class="p-3 text-gray-900 dark:text-white">
                                {{ $history->created_at->format('d-m-Y H:i') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="p-4 text-center text-gray-500">

                                Belum ada riwayat

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-4">
                {{ $histories->links() }}
            </div>

        </div>

    </div>

</x-app-layout>