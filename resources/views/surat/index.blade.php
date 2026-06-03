<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Daftar Surat
            </h2>

            <a href="{{ route('surat.create') }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                Buat Surat
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
                        Data Surat
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
                                    Nomor Surat
                                </th>

                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Jenis Surat
                                </th>

                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Pengirim
                                </th>

                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Status
                                </th>

                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Approval
                                </th>

                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                        @forelse($surats->where('pengirim_id', auth()->id()) as $surat)

                            <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">

                                <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                                    {{ $surat->nomor_surat }}
                                </td>

                                <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                                    {{ $surat->jenis_surat }}
                                </td>

                                <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                                    {{ $surat->pengirim->name ?? '-' }}
                                </td>

                                <td class="px-4 py-3">

                                    @if($surat->status == 'disetujui')

                                        <span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs">
                                            Disetujui
                                        </span>

                                    @elseif($surat->status == 'ditolak')

                                        <span class="px-2 py-1 rounded bg-red-100 text-red-700 text-xs">
                                            Ditolak
                                        </span>

                                    @elseif($surat->status == 'revisi')

                                        <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-700 text-xs">
                                            Revisi
                                        </span>

                                    @else

                                        <span class="px-2 py-1 rounded bg-blue-100 text-blue-700 text-xs">
                                            {{ ucfirst($surat->status) }}
                                        </span>

                                    @endif

                                </td>

                                <td class="px-4 py-3 text-center text-gray-800 dark:text-gray-200">
                                    {{ $surat->approvals->count() }}
                                </td>

                                <td class="px-4 py-3 text-center">

                                    <a href="{{ route('surat.show',$surat->id) }}"
                                       class="px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded">

                                        Detail

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">

                                    Belum ada surat

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="mt-4">
                {{ $surats->links() }}
            </div>

        </div>

    </div>

</x-app-layout>