<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = [
        'nomor_surat',
        'jenis_surat',
        'instansi',
        'bulan',
        'tahun',
        'isi',
        'lampiran',
        'pengirim_id',
        'status'
    ];

    public function pengirim()
    {
        return $this->belongsTo(User::class,'pengirim_id');
    }

    public function tujuan()
    {
        return $this->hasMany(SuratTujuan::class);
    }

    public function approvals()
    {
        return $this->hasMany(Approval::class);
    }

    public function histories()
    {
        return $this->hasMany(SuratHistory::class);
    }

    public function disposisis()
    {
        return $this->hasMany(
            SuratDisposisi::class
        );
    }
}