<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\User;
use App\Models\SuratHistory;
use App\Models\SuratDisposisi;


class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surats = Surat::with([
            'pengirim',
            'disposisis'
        ])->latest()->paginate(10);

        return view('surat.index', compact('surats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('surat.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'jenis_surat' => 'required|string|max:255',
            'isi' => 'required',
            'tujuan' => 'required|array|min:1',
        ]);

        $lampiran = null;

        if ($request->hasFile('lampiran')) {
            $lampiran = $request->file('lampiran')
                ->store('surat', 'public');
        }

        $surat = Surat::create([
            'nomor_surat' => $request->nomor_surat,
            'jenis_surat' => $request->jenis_surat,
            'instansi' => $request->instansi,
            'bulan' => now()->format('m'),
            'tahun' => now()->format('Y'),
            'isi' => $request->isi,
            'lampiran' => $lampiran,
            'pengirim_id' => auth()->id(),
            'status' => 'terkirim',
        ]);

        foreach ($request->tujuan as $tujuanId) {

            $tujuan = User::findOrFail($tujuanId);

            $penerimaAwal = $tujuan->secretary_id
                ? $tujuan->secretary_id
                : $tujuan->id;

            SuratDisposisi::create([
                'surat_id' => $surat->id,
                'from_user_id' => auth()->id(),
                'to_user_id' => $penerimaAwal,
                'status' => 'menunggu',
            ]);
        }

        SuratHistory::create([
            'surat_id' => $surat->id,
            'user_id' => auth()->id(),
            'aksi' => 'Membuat Surat',
            'catatan' => 'Surat dibuat dan dikirim',
        ]);

        return redirect()
            ->route('surat.index')
            ->with('success', 'Surat berhasil dikirim');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $surat = Surat::with([
            'pengirim',
            'disposisis.toUser',
            'disposisis.fromUser',
            'histories.user',
            'approvals.user'
        ])->findOrFail($id);

        // dd($surat);
        $approvals = $surat->approvals()->with('user')->get();
        //dd($approvals->pluck('user.name'));

        $accepted = $approvals->where('user_id', auth()->id())->first();

        $reciveuser = $surat->disposisis()
            ->where('to_user_id', auth()->id())
            ->first();
        //dd($reciveuser->toUser->id);

        $secretarycheck = User::where('secretary_id', auth()->id())->get();
        //dd($secretarycheck->pluck('id', 'name'));

        return view('surat.show', compact('surat', 'approvals', 'accepted', 'reciveuser', 'secretarycheck'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $surat = Surat::findOrFail($id);

        return view('surat.edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $surat = Surat::findOrFail($id);

        $request->validate([
            'jenis_surat' => 'required',
            'isi' => 'required',
        ]);

        $surat->update([
            'jenis_surat' => $request->jenis_surat,
            'instansi' => $request->instansi,
            'isi' => $request->isi,
        ]);

        SuratHistory::create([
            'surat_id' => $surat->id,
            'user_id' => auth()->id(),
            'aksi' => 'Mengubah Surat',
            'catatan' => 'Data surat diperbarui',
        ]);

        return redirect()
            ->route('surat.show', $surat->id)
            ->with('success', 'Surat berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $surat = Surat::findOrFail($id);

        SuratHistory::create([
            'surat_id' => $surat->id,
            'user_id' => auth()->id(),
            'aksi' => 'Menghapus Surat',
            'catatan' => 'Surat dihapus',
        ]);

        $surat->delete();

        return redirect()
            ->route('surat.index')
            ->with('success', 'Surat berhasil dihapus');
    }
}