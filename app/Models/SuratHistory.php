<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratHistory extends Model
{
    protected $fillable = [
        'surat_id',
        'user_id',
        'aksi',
        'notes'
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
