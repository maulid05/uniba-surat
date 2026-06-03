<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratDisposisi extends Model
{
    protected $fillable = [
        'surat_id',
        'from_user_id',
        'to_user_id',
        'catatan',
        'status'    
    ];

    public function surat()
    {
        return $this->belongsTo(
            Surat::class
        );
    }
    
    public function fromUser()
    {
        return $this->belongsTo(
            User::class,
            'from_user_id'
        );
    }
    
    public function toUser()
    {
        return $this->belongsTo(
            User::class,
            'to_user_id'
        );
    }

}
