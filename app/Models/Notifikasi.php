<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'pendaftaran_id',
        'mark_as_read',
    ];

    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class);
    }
}
