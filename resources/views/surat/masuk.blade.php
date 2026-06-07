<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Surat Masuk
            </h2>
        </div>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden">

                <div class="p-4 border-b border-gray-200 dark:border-gray-700">

                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        Daftar Surat Masuk
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
                                    Dari
                                </th>

                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Jenis Surat
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

                        @forelse($suratMasuk as $item)

                            @if($item->status == 'menunggu' || $item->status == 'diteruskan' || $item->status == 'revisi')
                            <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">

                                <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-4 py-3 text-gray-800 dark:text-gray-200">

                                    {{ $item->surat->nomor_surat }}

                                    @if(is_null($item->dibaca_pada))
                                        <span class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-700 rounded-full">
                                            Baru
                                        </span>
                                    @endif

                                </td>

                                <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                                    {{ $item->fromUser->name ?? '-' }}
                                </td>

                                <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                                    {{ $item->surat->jenis_surat }}
                                </td>

                                <td class="px-4 py-3">

                                    @if($item->status == 'menunggu')

                                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs">
                                            Menunggu
                                        </span>

                                    @elseif($item->status == 'diteruskan')

                                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs">
                                            Diteruskan
                                        </span>

                                    @elseif($item->status == 'revisi')

                                        <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs">
                                            Revisi
                                        </span>

                                    @elseif($item->status == 'ditolak')

                                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs">
                                            Ditolak
                                        </span>

                                    @elseif($item->status == 'disetujui')

                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">
                                            Disetujui
                                        </span>

                                    @endif

                                </td>
                                
                                <td class="px-4 py-3 text-center">
                                    
                                    <a
                                    href="{{ route('surat.show',$item->surat_id) }}"
                                    class="px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded">
                                    
                                    Detail
                                    
                                </a>
                                
                            </td>
                            
                        </tr>
                        
                        @endif
                        @empty

                            <tr>

                                <td colspan="6"
                                    class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">

                                    Tidak ada surat masuk

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            @if(method_exists($suratMasuk,'links'))
                <div class="mt-4">
                    {{ $suratMasuk->links() }}
                </div>
            @endif

        </div>

    </div>

</x-app-layout>