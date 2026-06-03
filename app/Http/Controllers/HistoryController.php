<?php

namespace App\Http\Controllers;

use App\Models\SuratHistory;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = SuratHistory::with([
            'surat',
            'user'
        ])
        ->latest()
        ->paginate(15);

        return view(
            'history.index',
            compact('histories')
        );
    }

    public function show($id)
    {
        $history = SuratHistory::with([
            'surat',
            'user'
        ])
        ->findOrFail($id);

        return view(
            'history.show',
            compact('history')
        );
    }
}