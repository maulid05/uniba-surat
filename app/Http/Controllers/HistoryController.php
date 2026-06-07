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