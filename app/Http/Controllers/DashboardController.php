<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Approval;
use App\Models\SuratHistory;
use App\Models\SuratDisposisi;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalRoles = Role::count();
        $totalSurat = Surat::count();
        $pendingSurat = Surat::where('status', 'pending')->count();

        $latestUsers = User::with('roles')
            ->latest()
            ->take(5)
            ->get();
        $totalSurat = Surat::count();

        $suratMasuk = SuratDisposisi::where(
            'to_user_id',
            auth()->id()
        )->where(function ($query) {
            $query->where('status', 'menunggu')
                ->orWhere('status', 'diteruskan')
                ->orWhere('status', 'revisi');
        })->count();

        $approvalPending = SuratDisposisi::where(
            'to_user_id',
            auth()->id()
        )
        ->where('status', 'menunggu')
        ->count();

        $suratDisetujui = Approval::count();

        $histories = SuratHistory::with([
            'user',
            'surat',
            'surat.disposisis'
        ])

        ->where(function ($query) {
            $query->where('user_id', auth()->id())
                ->orWhereHas('surat', function ($q) {
                    $q->whereHas('disposisis', function ($qq) {
                        $qq->where('to_user_id', auth()->id())
                        ->orWhere('from_user_id', auth()->id());
                    });
                });
        })

        ->latest()
        ->limit(10)
        ->get();

        return view('dashboard', compact(
            'totalSurat',
            'suratMasuk',
            'approvalPending',
            'suratDisetujui',
            'histories',
            'totalUsers',
            'totalRoles',
            'latestUsers',
            'pendingSurat'
        ));
    }
}