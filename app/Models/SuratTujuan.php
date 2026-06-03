<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratTujuan extends Model
{
    protected $fillable = [
        'surat_id',
        'user_id',
        'status'
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}