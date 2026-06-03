<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $fillable = [
        'surat_id',
        'user_id',
        'qr_token',
        'status'
    ];
    public function surat()
    {
        return $this->belongsTo(
            Surat::class
        );
    }
    
    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }
    public function disposisi()
    {
        return $this->hasMany(
            SuratDisposisi::class
        );
    }
}
