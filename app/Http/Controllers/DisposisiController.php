<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratDisposisi;
use App\Models\SuratHistory;
use App\Models\Surat;
use App\Models\User;

class DisposisiController extends Controller
{
    public function index()
    {
        $suratMasuk = SuratDisposisi::with([
            'surat',
            'fromUser'
        ])
        ->where('to_user_id', auth()->id())
        ->latest()
        ->paginate(10);
    
        return view(
            'surat.masuk',
            compact('suratMasuk')
        );
    }
    public function teruskan($id)
{
    $disposisi = SuratDisposisi::where('surat_id', $id)
    ->where('to_user_id', auth()->id())
    ->first();
    
    //dd($disposisi);
    $atasan = User::where(
        'secretary_id',
        auth()->id()
    )->first();

    if (!$atasan) {

        return back()
            ->with(
                'error',
                'Atasan tidak ditemukan'
            );
    }

    SuratDisposisi::create([
        'surat_id' => $disposisi->surat_id,
        'from_user_id' => auth()->id(),
        'to_user_id' => $atasan->id,
        'status' => 'diteruskan'
    ]);

    $disposisi->update([
        'status' => 'diteruskan'
    ]);

    SuratHistory::create([
        'surat_id' => $disposisi->surat_id,
        'user_id' => auth()->id(),
        'aksi' => 'Meneruskan Surat',
        'catatan' => 'Surat diteruskan'
    ]);

    Surat::where('id', $disposisi->surat_id)
        ->update([
            'status' => 'disposisi'
        ]);

    return back()
        ->with(
            'success',
            'Surat berhasil diteruskan'
        );
}
public function revisi(Request $request, $id)
{

    $disposisi =
        SuratDisposisi::findOrFail($id);

    $disposisi->update([
        'status' => 'revisi',
    ]);

    SuratHistory::create([
        'surat_id' => $disposisi->surat_id,
        'user_id' => auth()->id(),
        'aksi' => 'Revisi Surat',
    ]);

    return back()
        ->with(
            'success',
            'Revisi berhasil dikirim'
        );
}
public function tolak(Request $request, $id)
{
    $disposisi =
        SuratDisposisi::where('surat_id', $id)
        ->where('to_user_id', auth()->id())
        ->firstOrFail();

    $disposisi->update([
        'status' => 'ditolak',
    ]);

    SuratHistory::create([
        'surat_id' => $disposisi->surat_id,
        'user_id' => auth()->id(),
        'aksi' => 'Menolak Surat',
    ]);

    Surat::where('id', $disposisi->surat_id)
        ->update([
            'status' => 'ditolak'
        ]);

    return back()
        ->with(
            'success',
            'Surat ditolak'
        );
}
}