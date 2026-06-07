<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Approval Surat
            </h2>

        </div>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))

                <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-700">
                    {{ session('success') }}
                </div>

            @endif

            @if(session('error'))

                <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-700">
                    {{ session('error') }}
                </div>

            @endif

            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden">

                <div class="p-4 border-b border-gray-200 dark:border-gray-700">

                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        Surat Menunggu Approval
                    </h3>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-gray-100 dark:bg-gray-700">

                            <tr>

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
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                        @forelse($approvals as $item)

                            <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">

                                <td class="px-4 py-3 text-gray-800 dark:text-gray-200">

                                    {{ $item->surat->nomor_surat ?? '-' }}

                                </td>

                                <td class="px-4 py-3 text-gray-800 dark:text-gray-200">

                                    {{ $item->surat->jenis_surat ?? '-' }}

                                </td>

                                <td class="px-4 py-3 text-gray-800 dark:text-gray-200">

                                    {{ $item->surat->fromUser->name ?? '-' }}

                                </td>

                                <td class="px-4 py-3">
                                    @foreach ($dpp as $dpps)
                                    @if($dpps->status == 'menunggu')

                                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs">
                                            Menunggu
                                        </span>

                                    @elseif($dpps->status == 'disetujui')

                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">
                                            Disetujui
                                        </span>

                                    @elseif($dpps->status == 'ditolak')

                                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs">
                                            Ditolak
                                        </span>

                                    @elseif($dpps->status == 'revisi')

                                        <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs">
                                            Revisi
                                        </span>

                                    @else

                                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs">
                                            {{ ucfirst($dpps->status) }}
                                        </span>

                                    @endif
                                    
                                </td>
                                @endforeach

                                <td class="px-4 py-3 text-center">

                                    <div class="flex justify-center gap-2">

                                        <a
                                            href="{{ route('surat.show', $item->surat_id) }}"
                                            class="px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">

                                            Detail

                                        </a>

                                        @if($item->status == 'menunggu')

                                            <form
                                                action="{{ route('surat.approve', $item->surat_id) }}"
                                                method="POST">

                                                @csrf

                                                <button
                                                    type="submit"
                                                    onclick="return confirm('Setujui surat ini?')")
                                                    class="px-3 py-2 bg-green-600 hover:bg-green-700 text-white rounded">

                                                    Approve

                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">

                                    Tidak ada surat yang menunggu approval

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            @if(method_exists($approvals,'links'))

                <div class="mt-4">

                    {{ $approvals->links() }}

                </div>

            @endif

        </div>

    </div>

</x-app-layout>