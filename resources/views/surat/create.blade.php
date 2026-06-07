<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Buat Surat Baru
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl">

                <form
                    action="{{ route('surat.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="p-6">

                    @csrf

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

                        {{-- Nomor Surat --}}
                        <div>

                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                                Nomor Surat
                            </label>

                            <input
                                type="text"
                                name="nomor_surat"
                                value="{{ old('nomor_surat') }}"
                                class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white"
                                placeholder="001/UNIBA/TI/VI/2026">

                        </div>

                        {{-- Jenis Surat --}}
                        <div>

                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                                Jenis Surat
                            </label>

                            <select
                                name="jenis_surat"
                                class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white">

                                <option value="">
                                    Pilih Jenis Surat
                                </option>

                                <option value="Undangan">
                                    Undangan
                                </option>

                                <option value="Permohonan">
                                    Permohonan
                                </option>

                                <option value="Keputusan">
                                    Keputusan
                                </option>

                                <option value="Edaran">
                                    Edaran
                                </option>

                                <option value="Tugas">
                                    Surat Tugas
                                </option>

                            </select>

                        </div>

                        {{-- Instansi --}}
                        <div class="md:col-span-2">

                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                                Nama Instansi / Organisasi
                            </label>

                            <input
                                type="text"
                                name="instansi"
                                value="{{ old('instansi') }}"
                                class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white"
                                placeholder="Universitas Bahaudin Mudhary Madura">

                        </div>

                        {{-- Tujuan --}}
                        <div class="md:col-span-2">

                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                                Tujuan Surat
                            </label>

                            <select
                                id="tujuan"
                                multiple
                                name="tujuan[]"
                                class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white">

                                @foreach($users as $user)

                                    <option value="{{ $user->id }}">
                                        {{ $user->name }}
                                    </option>

                                @endforeach

                            </select>

                            <small class="text-gray-500">
                                Tekan CTRL + Klik untuk memilih lebih dari satu tujuan
                            </small>

                        </div>

                        {{-- Isi Surat --}}
                        <div class="md:col-span-2">

                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                                Isi Surat
                            </label>

                            <textarea
                                name="isi"
                                rows="10"
                                class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white"
                                placeholder="Masukkan isi surat...">{{ old('isi') }}</textarea>

                        </div>

                        {{-- Lampiran --}}
                        <div class="md:col-span-2">

                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                                Lampiran
                            </label>

                            <input
                                type="file"
                                name="lampiran"
                                class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white">

                        </div>

                    </div>

                    <div class="mt-6 flex gap-3">

                        <button
                            type="submit"
                            class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">

                            Kirim Surat

                        </button>

                        <a
                            href="{{ route('surat.index') }}"
                            class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg">

                            Kembali

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    new TomSelect('#tujuan', {
        plugins: ['remove_button'],
        placeholder: 'Cari nama pengguna...',
        searchField: ['text'],
        maxOptions: 100,
        create: false
    });
});
</script><script>
document.addEventListener('DOMContentLoaded', function () {
    new TomSelect('#tujuan', {
        plugins: ['remove_button'],
        placeholder: 'Cari nama pengguna...',
        searchField: ['text'],
        maxOptions: 100,
        create: false
    });
});
</script>
</x-app-layout>