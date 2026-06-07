<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100">
            Detail Surat
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label class="text-sm text-gray-500 dark:text-gray-400">
                            Nomor Surat
                        </label>

                        <p class="font-semibold text-gray-900 dark:text-white">
                            {{ $surat->nomor_surat }}
                        </p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-500 dark:text-gray-400">
                            Jenis Surat
                        </label>

                        <p class="font-semibold text-gray-900 dark:text-white">
                            {{ $surat->jenis_surat }}
                        </p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-500 dark:text-gray-400">
                            Pengirim
                        </label>

                        <p class="font-semibold text-gray-900 dark:text-white">
                            {{ $surat->pengirim->name ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-500 dark:text-gray-400">
                            Status
                        </label>

                        <p>
                            @if($surat->status == 'disetujui')

                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                                    Disetujui
                                </span>

                            @elseif($surat->status == 'ditolak')

                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                                    Ditolak
                                </span>

                            @elseif($surat->status == 'revisi')

                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                                    Revisi
                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm">
                                    {{ ucfirst($surat->status) }}
                                </span>

                            @endif
                        </p>
                    </div>

                </div>

                <hr class="my-6 border-gray-300 dark:border-gray-700">

                <div>

                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                        Isi Surat
                    </h3>

                    <div class="p-5 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 leading-relaxed">

                        {!! nl2br(e($surat->isi)) !!}

                    </div>

                </div>

                @if($surat->lampiran)

                    <div class="mt-6">

                        <a
                            href="{{ asset('storage/'.$surat->lampiran) }}"
                            target="_blank"
                            class="inline-block px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">

                            Download Lampiran

                        </a>

                    </div>

                @endif
                
                <hr class="my-6 border-gray-300 dark:border-gray-700">

                @if($reciveuser && $reciveuser->to_user_id == auth()->id())
                <div class="gap-3">
                    <div class="flex gap-3 justify-end">
                    <form
                        method="POST"
                        action="{{ route('surat.approve',$surat->id) }}">

                        @csrf

                        <button
                            type="submit"
                            class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">

                            Setujui Surat

                        </button>
                    </form>
                    <form method="POST" action="{{ route('disposisi.tolak', $surat->id) }}" class="inline">
                        @csrf
                        <button
                            type="submit"
                            class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">

                            Tolak Surat
                        </button>
                    </form>
                    <form method="POST" action="{{ route('disposisi.revisi', $surat->id) }}" class="inline">
                        @csrf
                        <button
                            type="submit"
                            class="px-5 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg">

                            Revisi Surat
                        </button>
                    </form>
                        @endif


                    <form method= "POST" action="{{ route('disposisi.teruskan', $surat->id) }}" class="inline">
                        @csrf
                        <button
                            type="submit"
                            class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

                            Teruskan

                        </button>
                    </form>
                </div>
                    <hr class="my-6 border-gray-300 dark:border-gray-700">
    
                    @foreach($approvals as $approval)
                        <div class="mt-4">
    
                            <h4 class="text-md font-semibold text-gray-900 dark:text-white mb-2">
                                {{ $approval->user->name }}
                            </h4>


                            {!! QrCode::size(150)->generate(
                                config('app.url') . '/surat/' . $approval->surat_id
                            ) !!}
    
                        </div>
    
                    @endforeach
                </div>

            </div>

        </div>

    </div>

</x-app-layout>