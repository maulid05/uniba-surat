<x-app-layout>



<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(!auth()->user()->hasRole('Admin'))
        <div class="mb-6">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                Selamat Datang, {{ auth()->user()->name }}
            </h3>

            <p class="text-gray-500 dark:text-gray-400">
                Sistem Surat Menyurat Universitas Bahaudin Mudhary Madura
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h4 class="text-gray-500 dark:text-gray-400 text-sm">
                    Total Surat
                </h4>

                <p class="text-3xl font-bold text-blue-600 mt-2">
                    {{ $totalSurat }}
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h4 class="text-gray-500 dark:text-gray-400 text-sm">
                    Surat Masuk
                </h4>

                <p class="text-3xl font-bold text-green-600 mt-2">
                    {{ $suratMasuk }}
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h4 class="text-gray-500 dark:text-gray-400 text-sm">
                    Menunggu Approval
                </h4>

                <p class="text-3xl font-bold text-yellow-500 mt-2">
                    {{ $approvalPending }}
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h4 class="text-gray-500 dark:text-gray-400 text-sm">
                    Surat Disetujui
                </h4>

                <p class="text-3xl font-bold text-purple-600 mt-2">
                    {{ $suratDisetujui }}
                </p>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">

            <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow rounded-xl p-6">

                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Aktivitas Terbaru
                    </h3>
                </div>

                <div class="space-y-4">

                    @forelse($histories as $history)

                        <div class="border-b border-gray-200 dark:border-gray-700 pb-3">

                            <div class="flex justify-between">

                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white">
                                        {{ $history->aksi }}
                                    </p>

                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $history->catatan }}
                                    </p>

                                    @if($history->user)
                                        <p class="text-xs text-blue-500 mt-1">
                                            {{ $history->user->name }}
                                        </p>
                                    @endif
                                </div>

                                <div class="text-xs text-gray-400">
                                    {{ $history->created_at->diffForHumans() }}
                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="text-center py-6 text-gray-500">
                            Belum ada aktivitas.
                        </div>

                    @endforelse

                </div>

            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">

                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Menu Cepat
                </h3>

                <div class="grid gap-3">

                    <a
                        href="{{ route('surat.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-lg transition">
                        Buat Surat
                    </a>

                    <a
                        href="{{ route('surat.index') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-center py-3 rounded-lg transition">
                        Daftar Surat
                    </a>

                    <a
                        href="{{ route('surat.masuk') }}"
                        class="bg-green-600 hover:bg-green-700 text-white text-center py-3 rounded-lg transition">
                        Surat Masuk
                    </a>

                    <a
                        href="{{ route('history.index') }}"
                        class="bg-gray-700 hover:bg-gray-800 text-white text-center py-3 rounded-lg transition">
                        Riwayat
                    </a>

                </div>

            </div>

        </div>
    </div>
    @else
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard Persuratan UNIBA
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Dashboard Admin Persuratan UNIBA
    </h2>
</x-slot>

<div class="py-6">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    
                <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                    <h3 class="text-sm text-gray-500 dark:text-gray-400">
                        Total User
                    </h3>
                    <p class="text-3xl font-bold text-indigo-600 mt-2">
                        {{ $totalUsers }}
                    </p>
                </div>
    
                <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                    <h3 class="text-sm text-gray-500 dark:text-gray-400">
                        Total Role
                    </h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">
                        {{ $totalRoles }}
                    </p>
                </div>
    
                <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                    <h3 class="text-sm text-gray-500 dark:text-gray-400">
                        Total Surat
                    </h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">
                        {{ $totalSurat }}
                    </p>
                </div>
    
                <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                    <h3 class="text-sm text-gray-500 dark:text-gray-400">
                        Surat Menunggu
                    </h3>
                    <p class="text-3xl font-bold text-yellow-500 mt-2">
                        {{ $pendingSurat }}
                    </p>
                </div>
    
            </div>
    
            {{-- Menu Cepat --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    
                <a href="{{ route('users.index') }}"
                    class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 hover:shadow-lg transition">
    
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-white">
                        Manajemen User
                    </h3>
    
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                        Kelola akun pengguna sistem.
                    </p>
    
                </a>
    
                <a href="{{ route('roles.index') }}"
                    class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 hover:shadow-lg transition">
    
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-white">
                        Manajemen Role
                    </h3>
    
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                        Atur hak akses dan role pengguna.
                    </p>
    
                </a>
    
                <a href="{{ route('surat.index') }}"
                    class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 hover:shadow-lg transition">
    
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-white">
                        Monitoring Surat
                    </h3>
    
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                        Lihat seluruh surat yang masuk.
                    </p>
    
                </a>
    
            </div>
    
            {{-- User Terbaru --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl">
    
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="font-semibold text-gray-800 dark:text-white">
                        User Terbaru
                    </h3>
                </div>
    
                <div class="overflow-x-auto">
    
                    <table class="min-w-full">
    
                        <thead class="bg-gray-100 dark:bg-gray-700">
    
                            <tr>
    
                                <th class="px-4 py-3 text-left">Nama</th>
                                <th class="px-4 py-3 text-left">Email</th>
                                <th class="px-4 py-3 text-left">Role</th>
    
                            </tr>
    
                        </thead>
    
                        <tbody>
    
                            @foreach($latestUsers as $user)
    
                                <tr class="border-t border-gray-200 dark:border-gray-700">
    
                                    <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                                        {{ $user->name }}
                                    </td>
    
                                    <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                                        {{ $user->email }}
                                    </td>
    
                                    <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                                        {{ $user->roles->pluck('name')->join(', ') }}
                                    </td>
    
                                </tr>
    
                            @endforeach
    
                        </tbody>
    
                    </table>
    
                </div>
    
            </div>
    
        </div>
    
    </div>
    </div>
    @endif

</div>


</x-app-layout>
