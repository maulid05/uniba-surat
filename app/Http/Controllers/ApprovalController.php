<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use App\Models\Surat;
use App\Models\SuratHistory;
use Illuminate\Support\Str;

class ApprovalController extends Controller
{
    public function index()
    {
        $approvals = \App\Models\Approval::with([
            'surat',
            'user'
   
        ])
        ->latest()
        ->paginate(10);

        $dpp = \App\Models\SuratDisposisi::with([
            'surat',
            'fromUser',
            'toUser'
        ])
        ->where('to_user_id', auth()->id())
        ->latest()
        ->paginate(10);
    

        return view(
            'approval.index',
            compact('approvals', 'dpp')
        );
    }
    public function approve(Surat $surat)
    {
        // Cek apakah user sudah approve
        $cek = Approval::where('surat_id', $surat->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($cek) {
            return back()->with(
                'error',
                'Anda sudah melakukan approval surat ini.'
            );
        }

        // Generate token QR
        $token = (string) Str::uuid();

        // Simpan approval
        Approval::create([
            'surat_id'    => $surat->id,
            'user_id'     => auth()->id(),
            'qr_token'    => $token,
            'approved_at' => now(),
        ]);

        // Simpan riwayat
        SuratHistory::create([
            'surat_id' => $surat->id,
            'user_id'  => auth()->id(),
            'aksi'     => 'Approval Surat',
            'catatan'  => 'Surat telah disetujui',
        ]);

        // Hitung total approval
        $totalApprove = Approval::where(
            'surat_id',
            $surat->id
        )->count();

        /*
         * Jika masih menggunakan tabel surat_tujuans
         */
        if (method_exists($surat, 'tujuan')) {

            $totalTujuan = $surat->tujuan()->count();

            if (
                $totalTujuan > 0 &&
                $totalApprove >= $totalTujuan
            ) {
                $surat->update([
                    'status' => 'disetujui'
                ]);
            }
        }

        return back()->with(
            'success',
            'Approval berhasil.'
        );
    }

    public function verify($token)
    {
        $approval = Approval::with([
            'surat',
            'user'
        ])
        ->where('qr_token', $token)
        ->firstOrFail();

        return view(
            'verify',
            [
                'approval' => $approval,
                'surat' => $approval->surat
            ]
        );
    }
}